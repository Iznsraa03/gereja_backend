@extends('admin.layout')
@section('content')
<div class='flex justify-between items-center mb-6'>
    <h2 class='text-2xl font-bold'>Manage Announcements</h2>
    <a href='/admin/announcements/create' class='bg-indigo-600 text-white font-medium shadow-lg shadow-indigo-500/20 px-4 py-2 rounded shadow hover:bg-indigo-500 transition-colors duration-200'>Add New</a>
</div>
<div class='bg-slate-900 border border-slate-700 bg-slate-950 text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 border-slate-800 shadow-xl rounded shadow overflow-hidden'>
    <table class='w-full text-sm'>
        <thead class='bg-slate-800 border-b border-slate-800 border-slate-700'>
            <tr>
                <th class='p-3 text-left font-medium text-slate-400 uppercase tracking-wider text-xs'>ID</th>
                <th class='p-3 text-left font-medium text-slate-400 uppercase tracking-wider text-xs'>Church id</th>
                <th class='p-3 text-left font-medium text-slate-400 uppercase tracking-wider text-xs'>Title</th>
                <th class='p-3 text-left font-medium text-slate-400 uppercase tracking-wider text-xs'>Content</th>
                <th class='p-3 text-left font-medium text-slate-400 uppercase tracking-wider text-xs'>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr class='border-b border-slate-800 hover:bg-slate-800/50'>
                <td class='p-3'>{{ $item->id }}</td>
                <td class='p-3'>{{ $item->church_id }}</td>
                <td class='p-3'>{{ $item->title }}</td>
                <td class='p-3'>{{ $item->content }}</td>
                <td class='p-3 flex gap-2'>
                    <a href='/admin/announcements/{{ $item->id }}/edit' class='text-indigo-400 transition-colors duration-200 hover:underline'>Edit</a>
                    <form action='/admin/announcements/{{ $item->id }}' method='POST' onsubmit='return confirm("Delete this item?")'>
                        @csrf @method('DELETE')
                        <button type='submit' class='text-red-400 transition-colors duration-200 hover:underline'>Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class='mt-4'>{{ $data->links() }}</div>
@endsection
