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