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