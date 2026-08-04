@extends('admin.layout')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Manage Churches</h1>
    <a href="/admin/churches/create" class="bg-blue-600 text-white px-4 py-2 rounded shadow text-sm font-medium hover:bg-indigo-500 transition-colors duration-200">+ Add Church</a>
</div>
<div class="bg-slate-900 border border-slate-800 shadow-xl rounded overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-800 border-b border-slate-700">
            <tr>
                <th class="p-3 text-left font-medium text-slate-400 uppercase tracking-wider text-xs">ID</th>
                <th class="p-3 text-left font-medium text-slate-400 uppercase tracking-wider text-xs">Image</th>
                <th class="p-3 text-left font-medium text-slate-400 uppercase tracking-wider text-xs">Name</th>
                <th class="p-3 text-left font-medium text-slate-400 uppercase tracking-wider text-xs">Category</th>
                <th class="p-3 text-left font-medium text-slate-400 uppercase tracking-wider text-xs">Status</th>
                <th class="p-3 text-left font-medium text-slate-400 uppercase tracking-wider text-xs">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-800">
            @foreach($churches as $item)
            <tr class="hover:bg-slate-800/50 transition-colors">
                <td class="p-3 text-slate-300">{{ $item->id }}</td>
                <td class="p-3">
                    @if($item->main_image_path)
                        <img src="{{ asset('storage/' . $item->main_image_path) }}" class="w-12 h-12 rounded object-cover border border-slate-700">
                    @else
                        <div class="w-12 h-12 rounded bg-slate-800 border border-slate-700 flex items-center justify-center text-xs text-slate-500">None</div>
                    @endif
                </td>
                <td class="p-3 font-medium text-white">{{ $item->name }}</td>
                <td class="p-3 text-slate-300">{{ $item->category->name ?? '-' }}</td>
                <td class="p-3">
                    @if($item->verification_status === 'verified')
                        <span class="px-2 py-1 text-xs rounded bg-emerald-900/50 text-emerald-400 border border-emerald-800">Verified</span>
                    @else
                        <span class="px-2 py-1 text-xs rounded bg-slate-800 text-slate-400 border border-slate-700">Draft</span>
                    @endif
                </td>
                <td class="p-3">
                    <div class="flex gap-3">
                        <a href="/admin/churches/{{ $item->id }}/edit" class="text-indigo-400 hover:text-indigo-300 transition-colors">Edit</a>
                        <form action="/admin/churches/{{ $item->id }}" method="POST" onsubmit="return confirm('Delete this church?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-400 hover:text-red-300 transition-colors">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $churches->links() }}</div>
@endsection