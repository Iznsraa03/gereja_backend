@extends('admin.layout')
@section('content')
<h2 class='text-2xl font-bold mb-6'>Edit Article</h2>
<form action='/admin/articles/{{ $item->id }}' method='POST' class='bg-slate-900 border border-slate-700 bg-slate-950 text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 border-slate-800 shadow-xl p-6 rounded shadow max-w-2xl'>
    @csrf @method('PUT')
    <div class='mb-4'><label class='block mb-1'>Title</label><input type='text' name='title' value='{{ $item->title }}' class='w-full border border-slate-700 bg-slate-950 text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 p-2 rounded'></div>
<div class='mb-4'><label class='block mb-1'>Slug</label><input type='text' name='slug' value='{{ $item->slug }}' class='w-full border border-slate-700 bg-slate-950 text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 p-2 rounded'></div>
<div class='mb-4'><label class='block mb-1'>Excerpt</label><textarea name='excerpt' class='w-full border border-slate-700 bg-slate-950 text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 p-2 rounded'>{{ $item->excerpt }}</textarea></div>
<div class='mb-4'><label class='block mb-1'>Content</label><textarea name='content' class='w-full border border-slate-700 bg-slate-950 text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 p-2 rounded'>{{ $item->content }}</textarea></div>
<div class='mb-4'><label class='block mb-1'>Status</label><input type='text' name='status' value='{{ $item->status }}' class='w-full border border-slate-700 bg-slate-950 text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 p-2 rounded'></div>
<div class='mb-4'><label class='block mb-1'>Published at</label><input type='datetime-local' name='published_at' value='{{ $item->published_at }}' class='w-full border border-slate-700 bg-slate-950 text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 p-2 rounded'></div>

    <button type='submit' class='bg-indigo-600 text-white font-medium shadow-lg shadow-indigo-500/20 px-4 py-2 rounded hover:bg-indigo-500 transition-colors duration-200'>Update</button>
    <a href='/admin/articles' class='ml-4 text-slate-400 hover:underline'>Cancel</a>
</form>
@endsection
