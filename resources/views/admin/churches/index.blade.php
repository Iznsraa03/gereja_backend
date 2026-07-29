@extends('admin.layout')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Manage Churches</h1>
    <a href="/admin/churches/create" class="bg-blue-600 text-white px-4 py-2 rounded shadow text-sm font-medium hover:bg-blue-700">+ Add Church</a>
</div>
<div class="bg-white rounded-lg shadow overflow-hidden border">
    <table class="w-full text-left text-sm">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="p-4 font-semibold text-gray-600">Name</th>
                <th class="p-4 font-semibold text-gray-600">Category</th>
                <th class="p-4 font-semibold text-gray-600">Status</th>
                <th class="p-4 font-semibold text-gray-600 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @forelse($churches as $church)
            <tr>
                <td class="p-4">{{ $church->name }}</td>
                <td class="p-4">{{ $church->category->name ?? '-' }}</td>
                <td class="p-4"><span class="px-2 py-1 rounded-full text-xs {{ $church->verification_status == 'verified' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">{{ $church->verification_status }}</span></td>
                <td class="p-4 text-right"><a href="#" class="text-blue-600 hover:underline">Edit</a></td>
            </tr>
            @empty
            <tr><td colspan="4" class="p-4 text-center text-gray-500">No churches found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $churches->links() }}</div>
@endsection