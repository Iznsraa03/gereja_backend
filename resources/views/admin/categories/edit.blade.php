@extends('admin.layout')
@section('content')
<h2 class='text-2xl font-bold mb-6'>Edit Category</h2>
<form action='/admin/categories/{{ $item->id }}' method='POST' class='bg-slate-900 border border-slate-700 bg-slate-950 text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 border-slate-800 shadow-xl p-6 rounded shadow max-w-2xl'>
    @csrf @method('PUT')
    <div class='mb-4'><label class='block mb-1'>Name</label><input type='text' name='name' value='{{ $item->name }}' class='w-full border border-slate-700 bg-slate-950 text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 p-2 rounded'></div>
<div class='mb-4'><label class='block mb-1'>Slug</label><input type='text' name='slug' value='{{ $item->slug }}' class='w-full border border-slate-700 bg-slate-950 text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 p-2 rounded'></div>
<div class='mb-4'><label class='block mb-1'>Description</label><textarea name='description' class='w-full border border-slate-700 bg-slate-950 text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 p-2 rounded'>{{ $item->description }}</textarea></div>
<div class='mb-4'><label class='block mb-1'>Sort order</label><input type='number' name='sort_order' value='{{ $item->sort_order }}' class='w-full border border-slate-700 bg-slate-950 text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 p-2 rounded'></div>
<div class='mb-4'><label class='flex items-center gap-2'><input type='checkbox' name='is_active' value='1' {{ $item->is_active ? 'checked' : '' }}> Is active</label></div>

    <button type='submit' class='bg-indigo-600 text-white font-medium shadow-lg shadow-indigo-500/20 px-4 py-2 rounded hover:bg-indigo-500 transition-colors duration-200'>Update</button>
    <a href='/admin/categories' class='ml-4 text-slate-400 hover:underline'>Cancel</a>
</form>
@endsection
