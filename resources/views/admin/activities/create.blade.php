@extends('admin.layout')
@section('content')
<h2 class='text-2xl font-bold mb-6'>Add New Activity</h2>
<form action='/admin/activities' method='POST' class='bg-white p-6 rounded shadow max-w-2xl'>
    @csrf
    <div class='mb-4'><label class='block mb-1'>Church id</label><input type='number' name='church_id' class='w-full border p-2 rounded'></div>
<div class='mb-4'><label class='block mb-1'>Title</label><input type='text' name='title' class='w-full border p-2 rounded'></div>
<div class='mb-4'><label class='block mb-1'>Slug</label><input type='text' name='slug' class='w-full border p-2 rounded'></div>
<div class='mb-4'><label class='block mb-1'>Location name</label><input type='text' name='location_name' class='w-full border p-2 rounded'></div>
<div class='mb-4'><label class='block mb-1'>Start at</label><input type='datetime-local' name='start_at' class='w-full border p-2 rounded'></div>
<div class='mb-4'><label class='block mb-1'>End at</label><input type='datetime-local' name='end_at' class='w-full border p-2 rounded'></div>
<div class='mb-4'><label class='flex items-center gap-2'><input type='checkbox' name='is_active' value='1'> Is active</label></div>

    <button type='submit' class='bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700'>Save</button>
    <a href='/admin/activities' class='ml-4 text-gray-500 hover:underline'>Cancel</a>
</form>
@endsection
