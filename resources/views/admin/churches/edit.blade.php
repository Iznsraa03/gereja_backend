@extends('admin.layout')
@section('content')
<h1 class="text-2xl font-bold mb-6">Edit Church: {{ $church->name }}</h1>
<form action="/admin/churches/{{ $church->id }}" method="POST" enctype="multipart/form-data" class="bg-slate-900 border border-slate-700 shadow-xl p-6 rounded-lg max-w-2xl">
    @csrf
    @method('PUT')
    
    @if($church->main_image_path)
    <div class="mb-6">
        <label class="block text-sm font-medium mb-2 text-slate-400">Current Main Image</label>
        <img src="{{ asset('storage/' . $church->main_image_path) }}" alt="{{ $church->name }}" class="w-full h-48 object-cover rounded border border-slate-700">
    </div>
    @endif
    
    <div class="grid grid-cols-2 gap-4 mb-4">
        <div>
            <label class="block text-sm font-medium mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name', $church->name) }}" class="w-full border border-slate-700 bg-slate-950 text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 rounded p-2" required>
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Slug</label>
            <input type="text" name="slug" value="{{ old('slug', $church->slug) }}" class="w-full border border-slate-700 bg-slate-950 text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 rounded p-2" required>
        </div>
    </div>
    <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Category</label>
        <select name="church_category_id" class="w-full border border-slate-700 bg-slate-950 text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 rounded p-2" required>
            <option value="">Select Category</option>
            @foreach($categories as $cat) 
                <option value="{{$cat->id}}" {{ $church->church_category_id == $cat->id ? 'selected' : '' }}>{{$cat->name}}</option> 
            @endforeach
        </select>
    </div>
    <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Address</label>
        <textarea name="address" class="w-full border border-slate-700 bg-slate-950 text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 rounded p-2" required>{{ old('address', $church->address) }}</textarea>
    </div>
    <div class="grid grid-cols-2 gap-4 mb-4">
        <div>
            <label class="block text-sm font-medium mb-1">Latitude</label>
            <input type="text" name="latitude" value="{{ old('latitude', $church->latitude) }}" class="w-full border border-slate-700 bg-slate-950 text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 rounded p-2" required>
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Longitude</label>
            <input type="text" name="longitude" value="{{ old('longitude', $church->longitude) }}" class="w-full border border-slate-700 bg-slate-950 text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 rounded p-2" required>
        </div>
    </div>
    <div class="grid grid-cols-2 gap-4 mb-6">
        <div>
            <label class="block text-sm font-medium mb-1">Status</label>
            <select name="verification_status" class="w-full border border-slate-700 bg-slate-950 text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 rounded p-2" required>
                <option value="draft" {{ $church->verification_status == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="verified" {{ $church->verification_status == 'verified' ? 'selected' : '' }}>Verified</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Update Main Image</label>
            <input type="file" name="main_image" accept="image/*" class="w-full border border-slate-700 bg-slate-950 text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 rounded p-1.5 text-sm file:mr-4 file:py-1 file:px-3 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-600 file:text-white hover:file:bg-indigo-700 cursor-pointer">
        </div>
    </div>
    <button type="submit" class="bg-indigo-600 text-white font-medium shadow-lg shadow-indigo-500/20 px-6 py-2 rounded hover:bg-indigo-500 transition-colors duration-200">Update Church</button>
</form>
@endsection
