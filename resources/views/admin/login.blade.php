@extends('admin.layout')
@section('content')
<div class="max-w-md mx-auto bg-slate-900 border border-slate-700 bg-slate-950 text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 border-slate-800 shadow-xl p-8 border border-slate-700 bg-slate-950 text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 rounded-lg shadow-sm mt-20">
    <div class="flex justify-center mb-6">
        <img src="{{ asset('logo/LOGO.jpeg') }}" alt="Logo" class="w-16 h-16 object-cover rounded-2xl shadow-lg">
    </div>
    <h2 class="text-2xl font-bold mb-6 text-center">Admin Login</h2>
    <form action="/admin-panel/login" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Email</label>
            <input type="email" name="email" class="w-full border border-slate-700 bg-slate-950 text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 rounded p-2" required>
        </div>
        <div class="mb-6">
            <label class="block text-sm font-medium mb-1">Password</label>
            <input type="password" name="password" class="w-full border border-slate-700 bg-slate-950 text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 rounded p-2" required>
        </div>
        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-indigo-500 transition-colors duration-200 font-medium">Login</button>
    </form>
</div>
@endsection