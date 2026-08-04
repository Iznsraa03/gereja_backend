@extends('admin.layout')
@section('content')
<h2 class='text-2xl font-bold mb-6'>Add New Facility</h2>
<form action='/admin/facilities' method='POST' class='bg-slate-900 border border-slate-700 bg-slate-950 text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 border-slate-800 shadow-xl p-6 rounded shadow max-w-2xl'>
    @csrf
    <div class='mb-4'><label class='block mb-1'>Name</label><input type='text' name='name' class='w-full border border-slate-700 bg-slate-950 text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 p-2 rounded'></div>
<div class='mb-4'><label class='block mb-1'>Slug</label><input type='text' name='slug' class='w-full border border-slate-700 bg-slate-950 text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 p-2 rounded'></div>
<div class='mb-4'><label class='block mb-1'>Icon name</label><input type='text' name='icon_name' class='w-full border border-slate-700 bg-slate-950 text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 p-2 rounded'></div>

    <button type='submit' class='bg-indigo-600 text-white font-medium shadow-lg shadow-indigo-500/20 px-4 py-2 rounded hover:bg-indigo-500 transition-colors duration-200'>Save</button>
    <a href='/admin/facilities' class='ml-4 text-slate-400 hover:underline'>Cancel</a>
</form>
@endsection
