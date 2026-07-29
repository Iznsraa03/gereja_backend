<?php

$dir = __DIR__ . '/app/Http/Controllers/Admin';
if (!is_dir($dir)) mkdir($dir, 0755, true);

$adminAuth = <<<'PHP'
<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin() {
        return view('admin.login');
    }
    public function login(Request $request) {
        $credentials = $request->validate(['email' => 'required|email', 'password' => 'required']);
        if (Auth::attempt($credentials) && Auth::user()->role === 'admin') {
            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard');
        }
        Auth::logout();
        return back()->withErrors(['email' => 'The provided credentials do not match our records or you are not an admin.'])->onlyInput('email');
    }
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }
}
PHP;

$dashboard = <<<'PHP'
<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Church;
use App\Models\ChurchCategory;

class DashboardController extends Controller
{
    public function index() {
        $stats = [
            'churches' => Church::count(),
            'categories' => ChurchCategory::count(),
            'verified' => Church::where('verification_status', 'verified')->count()
        ];
        return view('admin.dashboard', compact('stats'));
    }
}
PHP;

$church = <<<'PHP'
<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Church;
use App\Models\ChurchCategory;

class ChurchController extends Controller
{
    public function index() {
        $churches = Church::with('category')->paginate(15);
        return view('admin.churches.index', compact('churches'));
    }
    public function create() {
        $categories = ChurchCategory::all();
        return view('admin.churches.form', compact('categories'));
    }
    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|string', 'church_category_id' => 'required|exists:church_categories,id',
            'slug' => 'required|unique:churches', 'address' => 'required',
            'latitude' => 'required|numeric', 'longitude' => 'required|numeric',
            'verification_status' => 'required|in:draft,verified,rejected'
        ]);
        if ($data['verification_status'] === 'verified') {
            $data['verified_at'] = now();
            $data['verified_by'] = $request->user()->id;
        }
        Church::create($data);
        return redirect('/admin/churches')->with('success', 'Church added successfully.');
    }
}
PHP;

file_put_contents("$dir/AuthController.php", $adminAuth);
file_put_contents("$dir/DashboardController.php", $dashboard);
file_put_contents("$dir/ChurchController.php", $church);

$viewDir = __DIR__ . '/resources/views/admin';
if (!is_dir("$viewDir/churches")) mkdir("$viewDir/churches", 0755, true);

$layout = <<<'HTML'
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Church Finder</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">
    <div class="min-h-screen flex flex-col">
        @auth
        <nav class="bg-blue-600 text-white p-4 flex justify-between shadow-md">
            <a href="/admin/dashboard" class="font-bold text-xl">Church Finder Admin</a>
            <div class="flex gap-4 items-center">
                <a href="/admin/churches" class="hover:underline">Churches</a>
                <form action="/admin/logout" method="POST" class="inline">
                    @csrf <button type="submit" class="hover:underline">Logout</button>
                </form>
            </div>
        </nav>
        @endauth
        <main class="flex-grow p-6">
            @if(session('success')) <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div> @endif
            @if($errors->any()) <div class="bg-red-100 text-red-700 p-3 rounded mb-4"><ul>@foreach($errors->all() as $e) <li>{{$e}}</li> @endforeach</ul></div> @endif
            @yield('content')
        </main>
    </div>
</body>
</html>
HTML;

$login = <<<'HTML'
@extends('admin.layout')
@section('content')
<div class="max-w-md mx-auto bg-white p-8 border rounded-lg shadow-sm mt-20">
    <h2 class="text-2xl font-bold mb-6 text-center">Admin Login</h2>
    <form action="/admin/login" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Email</label>
            <input type="email" name="email" class="w-full border rounded p-2" required>
        </div>
        <div class="mb-6">
            <label class="block text-sm font-medium mb-1">Password</label>
            <input type="password" name="password" class="w-full border rounded p-2" required>
        </div>
        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 font-medium">Login</button>
    </form>
</div>
@endsection
HTML;

$dash = <<<'HTML'
@extends('admin.layout')
@section('content')
<h1 class="text-3xl font-bold mb-6">Dashboard</h1>
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h3 class="text-gray-500 text-sm font-medium">Total Churches</h3>
        <p class="text-3xl font-bold mt-2">{{ $stats['churches'] }}</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h3 class="text-gray-500 text-sm font-medium">Verified Churches</h3>
        <p class="text-3xl font-bold mt-2">{{ $stats['verified'] }}</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h3 class="text-gray-500 text-sm font-medium">Categories</h3>
        <p class="text-3xl font-bold mt-2">{{ $stats['categories'] }}</p>
    </div>
</div>
@endsection
HTML;

$churches_index = <<<'HTML'
@extends('admin.layout')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Manage Churches</h1>
    <a href="/admin/churches/create" class="bg-blue-600 text-white px-4 py-2 rounded shadow text-sm font-medium hover:bg-blue-700">+ Add Church</a>
</div>
<div class="bg-white rounded-lg shadow overflow-hidden border">
    <table class="w-full text-left text-sm">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="p-4 font-semibold text-gray-600">Name</th>
                <th class="p-4 font-semibold text-gray-600">Category</th>
                <th class="p-4 font-semibold text-gray-600">Status</th>
                <th class="p-4 font-semibold text-gray-600 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @forelse($churches as $church)
            <tr>
                <td class="p-4">{{ $church->name }}</td>
                <td class="p-4">{{ $church->category->name ?? '-' }}</td>
                <td class="p-4"><span class="px-2 py-1 rounded-full text-xs {{ $church->verification_status == 'verified' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">{{ $church->verification_status }}</span></td>
                <td class="p-4 text-right"><a href="#" class="text-blue-600 hover:underline">Edit</a></td>
            </tr>
            @empty
            <tr><td colspan="4" class="p-4 text-center text-gray-500">No churches found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $churches->links() }}</div>
@endsection
HTML;

$churches_form = <<<'HTML'
@extends('admin.layout')
@section('content')
<h1 class="text-2xl font-bold mb-6">Add New Church</h1>
<form action="/admin/churches" method="POST" class="bg-white p-6 rounded-lg shadow-sm border max-w-2xl">
    @csrf
    <div class="grid grid-cols-2 gap-4 mb-4">
        <div><label class="block text-sm font-medium mb-1">Name</label><input type="text" name="name" class="w-full border rounded p-2" required></div>
        <div><label class="block text-sm font-medium mb-1">Slug</label><input type="text" name="slug" class="w-full border rounded p-2" required></div>
    </div>
    <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Category</label>
        <select name="church_category_id" class="w-full border rounded p-2" required>
            <option value="">Select Category</option>
            @foreach($categories as $cat) <option value="{{$cat->id}}">{{$cat->name}}</option> @endforeach
        </select>
    </div>
    <div class="mb-4"><label class="block text-sm font-medium mb-1">Address</label><textarea name="address" class="w-full border rounded p-2" required></textarea></div>
    <div class="grid grid-cols-2 gap-4 mb-4">
        <div><label class="block text-sm font-medium mb-1">Latitude</label><input type="text" name="latitude" class="w-full border rounded p-2" required></div>
        <div><label class="block text-sm font-medium mb-1">Longitude</label><input type="text" name="longitude" class="w-full border rounded p-2" required></div>
    </div>
    <div class="mb-6">
        <label class="block text-sm font-medium mb-1">Status</label>
        <select name="verification_status" class="w-full border rounded p-2" required>
            <option value="draft">Draft</option><option value="verified">Verified</option>
        </select>
    </div>
    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 font-medium">Save Church</button>
</form>
@endsection
HTML;

file_put_contents("$viewDir/layout.blade.php", $layout);
file_put_contents("$viewDir/login.blade.php", $login);
file_put_contents("$viewDir/dashboard.blade.php", $dash);
file_put_contents("$viewDir/churches/index.blade.php", $churches_index);
file_put_contents("$viewDir/churches/form.blade.php", $churches_form);

echo "Admin Controllers and Views created.\n";
