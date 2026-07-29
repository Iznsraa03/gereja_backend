<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ChurchCategory;
use App\Models\Church;
use App\Models\Facility;
use App\Models\WorshipSchedule;
use App\Models\Activity;
use App\Models\Announcement;
use App\Models\Article;
use App\Models\ChurchImage;
use App\Models\Favorite;
use App\Models\NotificationPreference;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Users
        $admin = User::create([
            'name' => 'Admin Utama',
            'email' => 'admin@churchfinder.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'phone' => '081234567890',
            'is_active' => true,
        ]);

        $user = User::create([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
            'phone' => '089876543210',
            'is_active' => true,
        ]);

        // 2. Categories
        $categoriesData = [
            ['name' => 'Gereja Toraja', 'slug' => 'gereja-toraja', 'sort_order' => 1, 'description' => 'Jemaat-jemaat dalam naungan Gereja Toraja.'],
            ['name' => 'Gereja Katolik', 'slug' => 'gereja-katolik', 'sort_order' => 2, 'description' => 'Paroki dalam Keuskupan Agung Makassar.'],
            ['name' => 'Gereja Bethel Indonesia (GBI)', 'slug' => 'gbi', 'sort_order' => 3, 'description' => 'Jemaat GBI di wilayah Makassar.'],
            ['name' => 'Gereja Pentakosta di Indonesia (GPdI)', 'slug' => 'gpdi', 'sort_order' => 4, 'description' => 'Jemaat GPdI Kota Makassar.'],
            ['name' => 'HKBP', 'slug' => 'hkbp', 'sort_order' => 5, 'description' => 'Huria Kristen Batak Protestan.'],
            ['name' => 'Gereja Kibaid', 'slug' => 'gereja-kibaid', 'sort_order' => 6, 'description' => 'Gereja Kerapatan Injili Bangsa Indonesia.'],
            ['name' => 'Gereja Kristen Indonesia (GKI)', 'slug' => 'gki', 'sort_order' => 7, 'description' => 'Jemaat GKI di Makassar.'],
        ];

        $categories = [];
        foreach ($categoriesData as $cat) {
            $categories[$cat['slug']] = ChurchCategory::create($cat);
        }

        // 3. Facilities
        $facilitiesData = [
            ['name' => 'Ruang Utama Ber-AC', 'slug' => 'ac', 'icon_name' => 'snowflake'],
            ['name' => 'Parkir Luas', 'slug' => 'parkir-luas', 'icon_name' => 'local_parking'],
            ['name' => 'Akses Disabilitas & Kursi Roda', 'slug' => 'akses-disabilitas', 'icon_name' => 'accessible'],
            ['name' => 'Ruang Sekolah Minggu / Anak', 'slug' => 'sekolah-minggu', 'icon_name' => 'child_care'],
            ['name' => 'Fasilitas Live Streaming', 'slug' => 'live-streaming', 'icon_name' => 'videocam'],
            ['name' => 'Sound System & LED Screen', 'slug' => 'sound-led', 'icon_name' => 'speaker'],
            ['name' => 'Kantin / Cafeteria', 'slug' => 'kantin', 'icon_name' => 'restaurant'],
        ];

        $facilities = [];
        foreach ($facilitiesData as $fac) {
            $facilities[$fac['slug']] = Facility::create($fac);
        }

        // 4. Churches Data
        $churchesData = [
            [
                'category_slug' => 'gereja-katolik',
                'name' => 'Gereja Katedral Makassar (Hati Kudus Yesus)',
                'slug' => 'katedral-makassar',
                'address' => 'Jl. Kajaolalido No. 14, Baru, Kec. Ujung Pandang',
                'district' => 'Ujung Pandang',
                'city' => 'Makassar',
                'province' => 'Sulawesi Selatan',
                'postal_code' => '90111',
                'latitude' => -5.1373520,
                'longitude' => 119.4121400,
                'description' => 'Gereja Katedral Makassar adalah gereja katolik tertua di Keuskupan Agung Makassar, berlokasi di pusat kota Makassar.',
                'worship_guide' => 'Pintu gereja dibuka 30 menit sebelum misa dimulai. Harap berpakain sopan.',
                'phone' => '0411-3614123',
                'email' => 'katedralmakassar@gmail.com',
                'website_url' => 'https://katedralmakassar.org',
                'capacity' => 1200,
                'verification_status' => 'verified',
                'verified_at' => now(),
                'verified_by' => $admin->id,
                'schedules' => [
                    ['title' => 'Misa Sabtu Sore', 'day_of_week' => 6, 'start_time' => '18:00:00', 'end_time' => '19:30:00', 'language' => 'Indonesia'],
                    ['title' => 'Misa Minggu Pagi I', 'day_of_week' => 7, 'start_time' => '06:30:00', 'end_time' => '08:00:00', 'language' => 'Indonesia'],
                    ['title' => 'Misa Minggu Pagi II', 'day_of_week' => 7, 'start_time' => '08:30:00', 'end_time' => '10:00:00', 'language' => 'Indonesia'],
                    ['title' => 'Misa Minggu Sore', 'day_of_week' => 7, 'start_time' => '17:00:00', 'end_time' => '18:30:00', 'language' => 'Indonesia'],
                ],
                'facility_slugs' => ['ac', 'parkir-luas', 'akses-disabilitas', 'sekolah-minggu', 'live-streaming', 'sound-led'],
            ],
            [
                'category_slug' => 'gereja-toraja',
                'name' => 'Gereja Toraja Jemaat Makassar',
                'slug' => 'gt-jemaat-makassar',
                'address' => 'Jl. Gunung Bawakaraeng No. 1, Pisang Utara, Kec. Ujung Pandang',
                'district' => 'Ujung Pandang',
                'city' => 'Makassar',
                'province' => 'Sulawesi Selatan',
                'postal_code' => '90115',
                'latitude' => -5.1345100,
                'longitude' => 119.4182300,
                'description' => 'Salah satu jemaat Gereja Toraja terbesar di Makassar dengan berbagai pelayanan kategorial.',
                'worship_guide' => 'Wajib menjaga ketertiban selama ibadah berlangsung.',
                'phone' => '0411-3622411',
                'email' => 'gtjemaatmakassar@gmail.com',
                'capacity' => 800,
                'verification_status' => 'verified',
                'verified_at' => now(),
                'verified_by' => $admin->id,
                'schedules' => [
                    ['title' => 'Ibadah Subuh', 'day_of_week' => 7, 'start_time' => '06:00:00', 'end_time' => '07:30:00', 'language' => 'Bahasa Toraja'],
                    ['title' => 'Ibadah Umum Pagi', 'day_of_week' => 7, 'start_time' => '09:00:00', 'end_time' => '11:00:00', 'language' => 'Indonesia'],
                    ['title' => 'Ibadah Pemuda (PPGT)', 'day_of_week' => 7, 'start_time' => '17:00:00', 'end_time' => '19:00:00', 'language' => 'Indonesia'],
                ],
                'facility_slugs' => ['ac', 'parkir-luas', 'sekolah-minggu', 'sound-led', 'kantin'],
            ],
            [
                'category_slug' => 'gbi',
                'name' => 'GBI Rayon 5 Makassar (My Home)',
                'slug' => 'gbi-rayon-5-makassar',
                'address' => 'Jl. Gunung Latimojong No. 129, Maradekaya, Kec. Makassar',
                'district' => 'Makassar',
                'city' => 'Makassar',
                'province' => 'Sulawesi Selatan',
                'postal_code' => '90141',
                'latitude' => -5.1432000,
                'longitude' => 119.4215000,
                'description' => 'Gereja kontemporer dengan pujian penyembahan yang dinamis dan pelayanan pemuda yang aktif.',
                'worship_guide' => 'Hadir 15 menit sebelum ibadah. Ruang serbaguna tersedia untuk fellowship.',
                'phone' => '0411-872391',
                'email' => 'info@gbirayon5.org',
                'website_url' => 'https://gbirayon5.org',
                'capacity' => 1500,
                'verification_status' => 'verified',
                'verified_at' => now(),
                'verified_by' => $admin->id,
                'schedules' => [
                    ['title' => 'Ibadah Umum 1', 'day_of_week' => 7, 'start_time' => '08:00:00', 'end_time' => '10:00:00', 'language' => 'Indonesia'],
                    ['title' => 'Ibadah Umum 2', 'day_of_week' => 7, 'start_time' => '10:30:00', 'end_time' => '12:30:00', 'language' => 'Indonesia'],
                    ['title' => 'Youth Celebration', 'day_of_week' => 6, 'start_time' => '18:30:00', 'end_time' => '20:30:00', 'language' => 'Indonesia'],
                ],
                'facility_slugs' => ['ac', 'parkir-luas', 'akses-disabilitas', 'sekolah-minggu', 'live-streaming', 'sound-led', 'kantin'],
            ],
            [
                'category_slug' => 'hkbp',
                'name' => 'HKBP Makassar',
                'slug' => 'hkbp-makassar',
                'address' => 'Jl. Sammulun No. 17, Tabaringan, Kec. Ujung Tanah',
                'district' => 'Ujung Tanah',
                'city' => 'Makassar',
                'province' => 'Sulawesi Selatan',
                'postal_code' => '90161',
                'latitude' => -5.1215000,
                'longitude' => 119.4150000,
                'description' => 'Pusat peribadatan warga HKBP di Makassar.',
                'worship_guide' => 'Menggunakan Bahasa Batak pada sesi pagi dan Bahasa Indonesia pada sesi siang.',
                'phone' => '0411-314562',
                'capacity' => 600,
                'verification_status' => 'verified',
                'verified_at' => now(),
                'verified_by' => $admin->id,
                'schedules' => [
                    ['title' => 'Ibadah Pagi (Bahasa Batak)', 'day_of_week' => 7, 'start_time' => '08:00:00', 'end_time' => '10:00:00', 'language' => 'Batak'],
                    ['title' => 'Ibadah Siang (Bahasa Indonesia)', 'day_of_week' => 7, 'start_time' => '10:30:00', 'end_time' => '12:00:00', 'language' => 'Indonesia'],
                ],
                'facility_slugs' => ['ac', 'parkir-luas', 'sekolah-minggu'],
            ],
            [
                'category_slug' => 'gereja-katolik',
                'name' => 'Gereja Katolik St. Franciscus Xaverius Tanjung Bunga',
                'slug' => 'st-franciscus-tanjung-bunga',
                'address' => 'Jl. Metro Tanjung Bunga, Kec. Tamalate',
                'district' => 'Tamalate',
                'city' => 'Makassar',
                'province' => 'Sulawesi Selatan',
                'postal_code' => '90224',
                'latitude' => -5.1585000,
                'longitude' => 119.3980000,
                'description' => 'Paroki di kawasan berkembang Tanjung Bunga Makassar.',
                'worship_guide' => 'Misa Kudus diselenggarakan dengan khidmat.',
                'phone' => '0411-811234',
                'capacity' => 700,
                'verification_status' => 'verified',
                'verified_at' => now(),
                'verified_by' => $admin->id,
                'schedules' => [
                    ['title' => 'Misa Minggu Pagi', 'day_of_week' => 7, 'start_time' => '07:30:00', 'end_time' => '09:00:00', 'language' => 'Indonesia'],
                    ['title' => 'Misa Minggu Sore', 'day_of_week' => 7, 'start_time' => '17:30:00', 'end_time' => '19:00:00', 'language' => 'Indonesia'],
                ],
                'facility_slugs' => ['ac', 'parkir-luas', 'akses-disabilitas', 'sound-led'],
            ],
            [
                'category_slug' => 'gpdi',
                'name' => 'GPdI Maranatha Makassar',
                'slug' => 'gpdi-maranatha-makassar',
                'address' => 'Jl. Lanto Dg. Pasewang No. 34, Maricaya, Kec. Makassar',
                'district' => 'Makassar',
                'city' => 'Makassar',
                'province' => 'Sulawesi Selatan',
                'postal_code' => '90142',
                'latitude' => -5.1468000,
                'longitude' => 119.4162000,
                'description' => 'Gereja Pentakosta dengan fokus persekutuan doa dan puji-pujian.',
                'worship_guide' => 'Doa Fajar diselenggarakan setiap hari Sabtu pukul 05:00 WITA.',
                'phone' => '0411-851239',
                'capacity' => 500,
                'verification_status' => 'verified',
                'verified_at' => now(),
                'verified_by' => $admin->id,
                'schedules' => [
                    ['title' => 'Ibadah Raya 1', 'day_of_week' => 7, 'start_time' => '07:00:00', 'end_time' => '09:00:00', 'language' => 'Indonesia'],
                    ['title' => 'Ibadah Raya 2', 'day_of_week' => 7, 'start_time' => '09:30:00', 'end_time' => '11:30:00', 'language' => 'Indonesia'],
                ],
                'facility_slugs' => ['ac', 'sekolah-minggu', 'sound-led'],
            ]
        ];

        $createdChurches = [];
        foreach ($churchesData as $cData) {
            $catId = $categories[$cData['category_slug']]->id;
            $schedules = $cData['schedules'];
            $facilitySlugs = $cData['facility_slugs'];

            unset($cData['category_slug'], $cData['schedules'], $cData['facility_slugs']);
            $cData['church_category_id'] = $catId;

            $church = Church::create($cData);
            $createdChurches[] = $church;

            // Attach Schedules
            foreach ($schedules as $sched) {
                $sched['church_id'] = $church->id;
                WorshipSchedule::create($sched);
            }

            // Attach Facilities
            $facIds = array_map(fn($slug) => $facilities[$slug]->id, $facilitySlugs);
            $church->facilities()->attach($facIds);

            // Dummy Images
            ChurchImage::create([
                'church_id' => $church->id,
                'image_path' => "images/churches/{$church->slug}-cover.jpg",
                'caption' => 'Tampak Depan ' . $church->name,
                'is_cover' => true,
                'sort_order' => 1
            ]);
        }

        // 5. Activities
        Activity::create([
            'church_id' => $createdChurches[0]->id,
            'title' => 'Retreat Pemuda & Remaja 2026',
            'slug' => 'retreat-pemuda-2026',
            'description' => 'Kegiatan pembinaan rohani pemuda di Malino selama 3 hari 2 malam.',
            'location_name' => 'Malino Highlands, Gowa',
            'start_at' => now()->addDays(10)->setHour(8),
            'end_at' => now()->addDays(12)->setHour(16),
            'image_path' => 'images/activities/retreat.jpg',
            'registration_url' => 'https://forms.gle/sample123',
            'is_active' => true,
        ]);

        Activity::create([
            'church_id' => $createdChurches[2]->id,
            'title' => 'Bakti Sosial & Pengobatan Gratis',
            'slug' => 'baksos-kesehatan-2026',
            'description' => 'Pelayanan kesehatan dan pembagian sembako gratis untuk masyarakat sekitar.',
            'location_name' => 'Halaman GBI Rayon 5 Makassar',
            'start_at' => now()->addDays(5)->setHour(9),
            'end_at' => now()->addDays(5)->setHour(14),
            'is_active' => true,
        ]);

        // 6. Announcements
        Announcement::create([
            'church_id' => $createdChurches[0]->id,
            'title' => 'Himbauan Parkir Jemaat Ibadah Minggu',
            'content' => 'Mengingat keterbatasan lahan parkir, jemaat dihimbau untuk menggunakan transportasi publik atau memarkir kendaraan di kantong parkir resmi.',
            'starts_at' => now()->subDays(2),
            'ends_at' => now()->addMonth(),
            'priority' => 'normal',
            'is_active' => true,
        ]);

        Announcement::create([
            'church_id' => null, // Pengumuman umum
            'title' => 'Donor Darah Bersama Antar Gereja Makassar',
            'content' => 'Diundang seluruh jemaat se-Kota Makassar untuk berpartisipasi dalam aksi donor darah di Katedral Makassar.',
            'starts_at' => now()->subDay(),
            'ends_at' => now()->addDays(7),
            'priority' => 'high',
            'is_active' => true,
        ]);

        // 7. Articles
        Article::create([
            'author_id' => $admin->id,
            'title' => 'Panduan Menemukan Gereja dan Komunitas Rohani di Kota Makassar',
            'slug' => 'panduan-menemukan-gereja-makassar',
            'excerpt' => 'Makassar memiliki berbagai pilihan jemaat gereja dari berbagai denominasi yang hangat dan menyambut jemaat baru.',
            'content' => "Kota Makassar merupakan kota metropolitan yang kaya akan keberagaman. Bagi warga baru maupun wisatawan yang berada di Makassar, menemukan tempat ibadah yang sesuai adalah hal penting.\n\nAplikasi Church Finder Makassar hadir untuk memudahkan Anda menemukan lokasi gereja terdekat lengkap dengan jadwal ibadah dan fasilitas yang tersedia.",
            'thumbnail_path' => 'images/articles/panduan.jpg',
            'status' => 'published',
            'published_at' => now()->subDays(3),
        ]);

        // 8. Dummy Favorites & Reminders for test user
        Favorite::create([
            'user_id' => $user->id,
            'church_id' => $createdChurches[0]->id,
        ]);

        $firstSchedule = WorshipSchedule::where('church_id', $createdChurches[0]->id)->first();
        if ($firstSchedule) {
            NotificationPreference::create([
                'user_id' => $user->id,
                'worship_schedule_id' => $firstSchedule->id,
                'reminder_minutes' => 30,
                'is_active' => true
            ]);
        }
    }
}
