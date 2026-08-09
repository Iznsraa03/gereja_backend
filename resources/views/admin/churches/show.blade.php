@extends('admin.layout')
@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold">Detail Gereja</h1>
    <a href="/admin-panel/churches" class="text-slate-400 hover:text-white transition-colors">← Kembali</a>
</div>

<div class="bg-slate-900 border border-slate-800 rounded-lg overflow-hidden shadow-xl">
    <div class="p-6 md:p-8">
        <div class="flex flex-col md:flex-row gap-8">
            <div class="w-full md:w-1/3">
                @if($church->main_image_path)
                    <img src="{{ asset('storage/' . $church->main_image_path) }}" alt="{{ $church->name }}" class="w-full rounded-lg object-cover aspect-video border border-slate-700">
                @else
                    <div class="w-full aspect-video rounded-lg bg-slate-800 border border-slate-700 flex items-center justify-center text-slate-500">
                        Tidak ada gambar
                    </div>
                @endif
                
                <div class="mt-6 flex flex-col gap-3">
                    <a href="/admin-panel/churches/{{ $church->id }}/edit" class="text-center bg-indigo-600 hover:bg-indigo-500 text-white py-2 rounded transition-colors font-medium">Edit Data</a>
                </div>
            </div>
            
            <div class="w-full md:w-2/3 space-y-6">
                <div>
                    <h2 class="text-3xl font-bold text-white mb-2">{{ $church->name }}</h2>
                    <div class="flex items-center gap-3">
                        <span class="bg-slate-800 text-slate-300 px-3 py-1 rounded text-sm border border-slate-700">{{ $church->category->name ?? 'Tanpa Kategori' }}</span>
                        
                        @if($church->verification_status === 'verified')
                            <span class="px-3 py-1 text-sm rounded bg-emerald-900/50 text-emerald-400 border border-emerald-800">Verified</span>
                        @elseif($church->verification_status === 'rejected')
                            <span class="px-3 py-1 text-sm rounded bg-red-900/50 text-red-400 border border-red-800">Ditolak</span>
                        @else
                            <span class="px-3 py-1 text-sm rounded bg-amber-900/50 text-amber-400 border border-amber-800">Pending</span>
                        @endif
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-slate-800">
                    <div>
                        <p class="text-sm text-slate-400 mb-1">Slug URL</p>
                        <p class="text-slate-100 font-mono text-sm bg-slate-950 p-2 rounded border border-slate-800">{{ $church->slug }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-400 mb-1">Didaftarkan Oleh</p>
                        <p class="text-slate-100">{{ $church->submitted_by ? 'User ID: ' . $church->submitted_by : 'Admin' }}</p>
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-800">
                    <p class="text-sm text-slate-400 mb-1">Alamat Lengkap</p>
                    <p class="text-slate-200">{{ $church->address }}</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-slate-800">
                    <div>
                        <p class="text-sm text-slate-400 mb-1">Latitude</p>
                        <p class="text-slate-100 font-mono">{{ $church->latitude }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-400 mb-1">Longitude</p>
                        <p class="text-slate-100 font-mono">{{ $church->longitude }}</p>
                    </div>
                </div>
                
                @if($church->verification_status === 'verified')
                <div class="pt-4 border-t border-slate-800 text-sm text-slate-400">
                    Diverifikasi pada: {{ $church->verified_at }} oleh Admin ID: {{ $church->verified_by }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
