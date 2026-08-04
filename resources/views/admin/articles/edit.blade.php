@extends('admin.layout')
@section('content')
<h2 class='text-2xl font-bold mb-6'>Edit Article</h2>
<form action='/admin/articles/{{ $item->id }}' method='POST' class='bg-white p-6 rounded shadow max-w-2xl'>
    @csrf @method('PUT')
    <div class='mb-4'><label class='block mb-1'>Title</label><input type='text' name='title' value='{{ $item->title }}' class='w-full border p-2 rounded'></div>
<div class='mb-4'><label class='block mb-1'>Slug</label><input type='text' name='slug' value='{{ $item->slug }}' class='w-full border p-2 rounded'></div>
<div class='mb-4'><label class='block mb-1'>Excerpt</label><textarea name='excerpt' class='w-full border p-2 rounded'>{{ $item->excerpt }}</textarea></div>
<div class='mb-4'><label class='block mb-1'>Content</label><textarea name='content' class='w-full border p-2 rounded'>{{ $item->content }}</textarea></div>
<div class='mb-4'><label class='block mb-1'>Status</label><input type='text' name='status' value='{{ $item->status }}' class='w-full border p-2 rounded'></div>
<div class='mb-4'><label class='block mb-1'>Published at</label><input type='datetime-local' name='published_at' value='{{ $item->published_at }}' class='w-full border p-2 rounded'></div>

    <button type='submit' class='bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700'>Update</button>
    <a href='/admin/articles' class='ml-4 text-gray-500 hover:underline'>Cancel</a>
</form>
@endsection
