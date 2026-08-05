<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChurchResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nama_gereja' => $this->name,
            'slug' => $this->slug,
            'alamat' => $this->address,
            'kecamatan' => $this->district,
            'kategori' => $this->category ? $this->category->name : null,
            'fasilitas' => $this->whenLoaded('facilities', function () {
                return $this->facilities->pluck('name');
            }),
            'kapasitas' => $this->capacity > 0 ? $this->capacity . ' Orang' : null,
            'deskripsi' => $this->description, // Berisi nama pengkhotbah juga berdasarkan CsvSeeder
            'jadwal_ibadah' => $this->whenLoaded('schedules', function () {
                return $this->schedules->map(function ($s) {
                    return [
                        'judul' => $s->title,
                        'waktu' => $s->start_time . ($s->end_time ? ' - ' . $s->end_time : ''),
                        'pengkhotbah' => $s->preacher_name,
                    ];
                });
            }),
            'kegiatan_gereja' => $this->whenLoaded('activities', function () {
                return $this->activities->map(function ($a) {
                    return [
                        'judul' => $a->title,
                        'deskripsi' => $a->description,
                        'mulai' => $a->start_at,
                    ];
                });
            }),
            'gambar' => $this->whenLoaded('images', function () {
                return $this->images->map(function ($img) {
                    return url('storage/' . $img->image_path);
                });
            }),
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'distance_km' => $this->when(isset($this->distance), function () {
                return round($this->distance, 2);
            }),
        ];
    }
}
