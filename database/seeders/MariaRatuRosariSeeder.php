<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Church;
use App\Models\ChurchCategory;
use App\Models\Facility;
use App\Models\WorshipSchedule;
use App\Models\Activity;
use Illuminate\Support\Str;

class MariaRatuRosariSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Get or create category 'Gereja Katolik'
        $category = ChurchCategory::firstOrCreate(
            ['slug' => 'gereja-katolik'],
            ['name' => 'Gereja Katolik', 'is_active' => true, 'description' => 'Paroki dalam Keuskupan Agung Makassar.']
        );

        // 2. Create or update Church
        $church = Church::updateOrCreate(
            ['slug' => 'gereja-katolik-paroki-maria-ratu-rosari-kare'],
            [
                'church_category_id' => $category->id,
                'name' => 'Gereja Katolik Paroki Maria Ratu Rosari Kare',
                'address' => 'Jl. Perintis Kemerdekaan Km. 11, Kec. Tamalanrea',
                'district' => 'Tamalanrea',
                'city' => 'Makassar',
                'province' => 'Sulawesi Selatan',
                'postal_code' => '90245',
                'latitude' => -5.1147000,
                'longitude' => 119.4932000,
                'description' => "Paroki Maria Ratu Rosari Kare dinaungi oleh Keuskupan Agung Makassar.\nPastor: RP. KAITANUS SALEKY, CICM",
                'capacity' => 1000,
                'verification_status' => 'verified',
                'is_active' => true,
            ]
        );

        // 3. Attach Facilities
        $facilityNames = [
            'Gedung Gereja',
            'Basement Gereja',
            'Aula Pastoral',
            'Ruang Pembinaan',
            'Kapel di Basement',
            'Alat Musik',
            'Halaman Tempat Parkir',
            'WC Pria & WC Wanita'
        ];

        $facilityIds = [];
        foreach ($facilityNames as $facName) {
            $facility = Facility::firstOrCreate(
                ['slug' => Str::slug($facName)],
                ['name' => $facName]
            );
            $facilityIds[] = $facility->id;
        }

        $church->facilities()->syncWithoutDetaching($facilityIds);

        // 4. Schedules
        $church->schedules()->delete();

        $schedules = [
            [
                'title' => 'Misa Sabtu Sore',
                'day_of_week' => 6, // Sabtu
                'start_time' => '18:00:00',
                'end_time' => '19:30:00',
                'language' => 'Indonesia',
                'preacher_name' => 'RP. KAITANUS SALEKY, CICM'
            ],
            [
                'title' => 'Misa Minggu Pagi I',
                'day_of_week' => 7, // Minggu
                'start_time' => '06:00:00',
                'end_time' => '07:30:00',
                'language' => 'Indonesia',
                'preacher_name' => 'RP. KAITANUS SALEKY, CICM'
            ],
            [
                'title' => 'Misa Minggu Pagi II',
                'day_of_week' => 7, // Minggu
                'start_time' => '08:30:00',
                'end_time' => '10:00:00',
                'language' => 'Indonesia',
                'preacher_name' => 'RP. KAITANUS SALEKY, CICM'
            ],
            [
                'title' => 'Misa Minggu Sore',
                'day_of_week' => 7, // Minggu
                'start_time' => '18:00:00',
                'end_time' => '19:30:00',
                'language' => 'Indonesia',
                'preacher_name' => 'RP. KAITANUS SALEKY, CICM'
            ],
            [
                'title' => 'Misa Harian (Senin - Jumat)',
                'day_of_week' => 1, // Senin-Jumat
                'start_time' => '06:00:00',
                'end_time' => '07:00:00',
                'language' => 'Indonesia',
                'description' => 'Misa harian setiap hari Senin s/d Jumat',
                'preacher_name' => 'RP. KAITANUS SALEKY, CICM'
            ]
        ];

        foreach ($schedules as $sched) {
            $church->schedules()->create($sched);
        }

        // 5. Activities
        $church->activities()->delete();

        $activities = [
            [
                'title' => 'Pembinaan Anak Sekolah Minggu',
                'slug' => Str::slug($church->name . ' pembinaan anak sekolah minggu'),
                'description' => 'Kegiatan pembinaan iman anak sekolah minggu setiap hari Minggu.',
                'start_at' => now()->next('Sunday')->setHour(9),
                'is_active' => true
            ],
            [
                'title' => 'Pelajaran Agama untuk Anak-anak',
                'slug' => Str::slug($church->name . ' pelajaran agama anak'),
                'description' => 'Pelajaran agama untuk anak-anak setiap hari Sabtu.',
                'start_at' => now()->next('Saturday')->setHour(15),
                'is_active' => true
            ],
            [
                'title' => 'Kelompok Kerahiman',
                'slug' => Str::slug($church->name . ' kelompok kerahiman'),
                'description' => 'Persekutuan dan doa bersama Kelompok Kerahiman Illahi.',
                'start_at' => now()->next('Saturday')->setHour(16),
                'is_active' => true
            ],
            [
                'title' => 'Kelompok OMK (Orang Muda Katolik)',
                'slug' => Str::slug($church->name . ' kelompok omk'),
                'description' => 'Kegiatan dan persekutuan Orang Muda Katolik (OMK).',
                'start_at' => now()->next('Saturday')->setHour(17),
                'is_active' => true
            ],
            [
                'title' => 'Kelompok Legio Maria',
                'slug' => Str::slug($church->name . ' kelompok legio maria'),
                'description' => 'Rapat dan doa presidium Legio Maria.',
                'start_at' => now()->next('Saturday')->setHour(18),
                'is_active' => true
            ]
        ];

        foreach ($activities as $act) {
            $church->activities()->create($act);
        }

        if (isset($this->command)) {
            $this->command->info("Data Gereja Katolik Paroki Maria Ratu Rosari Kare berhasil ditambahkan!");
        }
    }
}
