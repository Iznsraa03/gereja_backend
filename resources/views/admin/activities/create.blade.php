@extends('admin.layout')
@section('content')
<h2 class='text-2xl font-bold mb-6'>Add New Activity</h2>
<form action='/admin/activities' method='POST' class='bg-slate-900 border border-slate-700 bg-slate-950 text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 border-slate-800 shadow-xl p-6 rounded shadow max-w-2xl'>
    @csrf
    <div class='mb-4'><label class='block mb-1'>Church id</label><input type='number' name='church_id' class='w-full border border-slate-700 bg-slate-950 text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 p-2 rounded'></div>
<div class='mb-4'><label class='block mb-1'>Title</label><input type='text' name='title' class='w-full border border-slate-700 bg-slate-950 text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 p-2 rounded'></div>
<div class='mb-4'><label class='block mb-1'>Slug</label><input type='text' name='slug' class='w-full border border-slate-700 bg-slate-950 text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 p-2 rounded'></div>
<div class='mb-4'><label class='block mb-1'>Location name</label><input type='text' name='location_name' class='w-full border border-slate-700 bg-slate-950 text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 p-2 rounded'></div>
<div class='mb-4'><label class='block mb-1'>Start at</label><input type='datetime-local' name='start_at' class='w-full border border-slate-700 bg-slate-950 text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 p-2 rounded'></div>
<div class='mb-4'><label class='block mb-1'>End at</label><input type='datetime-local' name='end_at' class='w-full border border-slate-700 bg-slate-950 text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 p-2 rounded'></div>
<div class='mb-4'><label class='flex items-center gap-2'><input type='checkbox' name='is_active' value='1'> Is active</label></div>

    <button type='submit' class='bg-indigo-600 text-white font-medium shadow-lg shadow-indigo-500/20 px-4 py-2 rounded hover:bg-indigo-500 transition-colors duration-200'>Save</button>
    <a href='/admin/activities' class='ml-4 text-slate-400 hover:underline'>Cancel</a>
</form>
@endsection
