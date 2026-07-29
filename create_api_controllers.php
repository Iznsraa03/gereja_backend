<?php

$dir = __DIR__ . '/app/Http/Controllers/Api/V1';
if (!is_dir($dir)) mkdir($dir, 0755, true);

$authController = <<<'PHP'
<?php
namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request) {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6'
        ]);
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        return response()->json([
            'success' => true,
            'message' => 'Registrasi berhasil',
            'data' => [
                'user' => $user,
                'token' => $user->createToken('auth')->plainTextToken
            ]
        ]);
    }
    public function login(Request $request) {
        $request->validate(['email' => 'required|email', 'password' => 'required']);
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['success' => false, 'message' => 'Kredensial tidak valid'], 401);
        }
        $user->update(['last_login_at' => now()]);
        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'data' => [
                'user' => $user,
                'token' => $user->createToken('auth')->plainTextToken
            ]
        ]);
    }
    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['success' => true, 'message' => 'Logout berhasil']);
    }
}
PHP;

$churchController = <<<'PHP'
<?php
namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Church;

class ChurchController extends Controller
{
    public function index(Request $request) {
        $query = Church::with(['category', 'images'])->where('is_active', true)->where('verification_status', 'verified');
        if ($request->search) {
            $query->where('name', 'like', "%{$request->search}%");
        }
        if ($request->category_id) {
            $query->where('church_category_id', $request->category_id);
        }
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diambil',
            'data' => $query->paginate(15)
        ]);
    }

    public function nearby(Request $request) {
        $request->validate(['latitude' => 'required|numeric', 'longitude' => 'required|numeric']);
        $query = Church::with(['category', 'images'])
            ->where('is_active', true)
            ->where('verification_status', 'verified')
            ->closeTo($request->latitude, $request->longitude);
            
        if ($request->search) $query->where('name', 'like', "%{$request->search}%");
        if ($request->category_id) $query->where('church_category_id', $request->category_id);
        
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diambil',
            'data' => $query->paginate(15)
        ]);
    }

    public function show($slug) {
        $church = Church::with(['category', 'schedules', 'facilities', 'images', 'activities', 'announcements'])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->where('verification_status', 'verified')
            ->firstOrFail();
            
        return response()->json([
            'success' => true,
            'message' => 'Detail gereja berhasil diambil',
            'data' => $church
        ]);
    }
}
PHP;

$favoriteController = <<<'PHP'
<?php
namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function index(Request $request) {
        $favorites = $request->user()->favorites()->with(['church.category', 'church.images'])->paginate(15);
        return response()->json(['success' => true, 'data' => $favorites]);
    }
    public function toggle(Request $request, $churchId) {
        $user = $request->user();
        $fav = Favorite::where('user_id', $user->id)->where('church_id', $churchId)->first();
        if ($fav) {
            $fav->delete();
            return response()->json(['success' => true, 'message' => 'Dihapus dari favorit']);
        }
        Favorite::create(['user_id' => $user->id, 'church_id' => $churchId]);
        return response()->json(['success' => true, 'message' => 'Ditambahkan ke favorit']);
    }
}
PHP;

$reminderController = <<<'PHP'
<?php
namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NotificationPreference;

class ReminderController extends Controller
{
    public function index(Request $request) {
        $reminders = NotificationPreference::with('schedule.church')
            ->where('user_id', $request->user()->id)->get();
        return response()->json(['success' => true, 'data' => $reminders]);
    }
    public function toggle(Request $request, $scheduleId) {
        $user = $request->user();
        $pref = NotificationPreference::where('user_id', $user->id)->where('worship_schedule_id', $scheduleId)->first();
        if ($pref) {
            $pref->delete();
            return response()->json(['success' => true, 'message' => 'Pengingat dihapus']);
        }
        $minutes = $request->input('reminder_minutes', 30);
        NotificationPreference::create(['user_id' => $user->id, 'worship_schedule_id' => $scheduleId, 'reminder_minutes' => $minutes]);
        return response()->json(['success' => true, 'message' => 'Pengingat dibuat']);
    }
}
PHP;

$categoryController = <<<'PHP'
<?php
namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use App\Models\ChurchCategory;

class CategoryController extends Controller
{
    public function index() {
        return response()->json(['success' => true, 'data' => ChurchCategory::where('is_active', true)->orderBy('sort_order')->get()]);
    }
}
PHP;

$articleController = <<<'PHP'
<?php
namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index() {
        return response()->json(['success' => true, 'data' => Article::where('status', 'published')->paginate(10)]);
    }
    public function show($slug) {
        return response()->json(['success' => true, 'data' => Article::where('slug', $slug)->where('status', 'published')->firstOrFail()]);
    }
}
PHP;

file_put_contents("$dir/AuthController.php", $authController);
file_put_contents("$dir/ChurchController.php", $churchController);
file_put_contents("$dir/FavoriteController.php", $favoriteController);
file_put_contents("$dir/ReminderController.php", $reminderController);
file_put_contents("$dir/CategoryController.php", $categoryController);
file_put_contents("$dir/ArticleController.php", $articleController);

echo "API Controllers created.\n";
