@extends('admin.layout')
@section('content')
<h1 class="text-2xl font-bold mb-6">Add New Church</h1>
<form action="/admin/churches" method="POST" enctype="multipart/form-data" class="bg-slate-900 border border-slate-700 bg-slate-950 text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 border-slate-800 shadow-xl p-6 rounded-lg shadow-sm border border-slate-700 bg-slate-950 text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 max-w-2xl">
    @csrf
    <div class="grid grid-cols-2 gap-4 mb-4">
        <div><label class="block text-sm font-medium mb-1">Name</label><input type="text" name="name" class="w-full border border-slate-700 bg-slate-950 text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 rounded p-2" required></div>
        <div><label class="block text-sm font-medium mb-1">Slug</label><input type="text" name="slug" class="w-full border border-slate-700 bg-slate-950 text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 rounded p-2" required></div>
    </div>
    <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Category</label>
        <select name="church_category_id" class="w-full border border-slate-700 bg-slate-950 text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 rounded p-2" required>
            <option value="">Select Category</option>
            @foreach($categories as $cat) <option value="{{$cat->id}}">{{$cat->name}}</option> @endforeach
        </select>
    </div>
    <div class="mb-4"><label class="block text-sm font-medium mb-1">Address</label><textarea name="address" class="w-full border border-slate-700 bg-slate-950 text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 rounded p-2" required></textarea></div>
    <div class="grid grid-cols-2 gap-4 mb-4">
        <div><label class="block text-sm font-medium mb-1">Latitude</label><input type="text" name="latitude" class="w-full border border-slate-700 bg-slate-950 text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 rounded p-2" required></div>
        <div><label class="block text-sm font-medium mb-1">Longitude</label><input type="text" name="longitude" class="w-full border border-slate-700 bg-slate-950 text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 rounded p-2" required></div>
    </div>
    <div class="grid grid-cols-2 gap-4 mb-6">
        <div>
            <label class="block text-sm font-medium mb-1">Status</label>
            <select name="verification_status" class="w-full border border-slate-700 bg-slate-950 text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 rounded p-2" required>
                <option value="draft">Draft</option><option value="verified">Verified</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Main Image</label>
            <input type="file" name="main_image" accept="image/*" class="w-full border border-slate-700 bg-slate-950 text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 rounded p-1.5 text-sm file:mr-4 file:py-1 file:px-3 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-600 file:text-white hover:file:bg-indigo-700 cursor-pointer">
        </div>
    </div>
    <button type="submit" class="bg-indigo-600 text-white font-medium shadow-lg shadow-indigo-500/20 px-6 py-2 rounded hover:bg-indigo-500 transition-colors duration-200">Save Church</button>
</form>
@endsection