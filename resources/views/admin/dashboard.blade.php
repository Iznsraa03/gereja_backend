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