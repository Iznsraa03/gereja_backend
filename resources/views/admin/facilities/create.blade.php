@extends('admin.layout')
@section('content')
<h2 class='text-2xl font-bold mb-6'>Add New Facility</h2>
<form action='/admin/facilities' method='POST' class='bg-white p-6 rounded shadow max-w-2xl'>
    @csrf
    <div class='mb-4'><label class='block mb-1'>Name</label><input type='text' name='name' class='w-full border p-2 rounded'></div>
<div class='mb-4'><label class='block mb-1'>Slug</label><input type='text' name='slug' class='w-full border p-2 rounded'></div>
<div class='mb-4'><label class='block mb-1'>Icon name</label><input type='text' name='icon_name' class='w-full border p-2 rounded'></div>

    <button type='submit' class='bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700'>Save</button>
    <a href='/admin/facilities' class='ml-4 text-gray-500 hover:underline'>Cancel</a>
</form>
@endsection
