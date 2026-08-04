@extends('admin.layout')
@section('content')
<div class='flex justify-between items-center mb-6'>
    <h2 class='text-2xl font-bold'>Manage Activitys</h2>
    <a href='/admin/activities/create' class='bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700'>Add New</a>
</div>
<div class='bg-white rounded shadow overflow-hidden'>
    <table class='w-full'>
        <thead class='bg-gray-200'>
            <tr>
                <th class='p-3 text-left'>ID</th>
                <th class='p-3 text-left'>Church id</th>
                <th class='p-3 text-left'>Title</th>
                <th class='p-3 text-left'>Slug</th>
                <th class='p-3 text-left'>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr class='border-b hover:bg-gray-50'>
                <td class='p-3'>{{ $item->id }}</td>
                <td class='p-3'>{{ $item->church_id }}</td>
                <td class='p-3'>{{ $item->title }}</td>
                <td class='p-3'>{{ $item->slug }}</td>
                <td class='p-3 flex gap-2'>
                    <a href='/admin/activities/{{ $item->id }}/edit' class='text-blue-500 hover:underline'>Edit</a>
                    <form action='/admin/activities/{{ $item->id }}' method='POST' onsubmit='return confirm("Delete this item?")'>
                        @csrf @method('DELETE')
                        <button type='submit' class='text-red-500 hover:underline'>Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class='mt-4'>{{ $data->links() }}</div>
@endsection
