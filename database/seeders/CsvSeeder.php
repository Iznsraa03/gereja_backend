<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Church;
use App\Models\ChurchCategory;
use App\Models\Facility;
use Illuminate\Support\Str;

class CsvSeeder extends Seeder
{
    public function run(): void
    {
        // Truncate relevant tables
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('church_facility')->truncate();
        DB::table('activities')->truncate();
        DB::table('worship_schedules')->truncate();
        Church::truncate();
        Facility::truncate();
        ChurchCategory::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $csvFile = base_path('DATA GEREJA PERMANEN DI MAKASSAR - Sheet2.csv');
        $handle = fopen($csvFile, 'r');
        if (!$handle) {
            $this->command->error("Cannot open file: $csvFile");
            return;
        }

        fgetcsv($handle); // skip empty line
        fgetcsv($handle); // skip header

        $churches = [];
        $currentChurch = null;

        while (($row = fgetcsv($handle)) !== false) {
            if (trim($row[0]) !== '') {
                if ($currentChurch !== null) {
                    $churches[] = $currentChurch;
                }
                $currentChurch = [
                    'name' => trim($row[1]),
                    'address' => trim($row[2]) . ', Kel. ' . trim($row[3]) . ', Kec. ' . trim($row[4]),
                    'district' => trim($row[4]),
                    'facilities' => [],
                    'capacity' => (int) filter_var(trim($row[6]), FILTER_SANITIZE_NUMBER_INT), // Extract number
                    'pastors' => [],
                    'schedules' => [],
                    'activities' => [],
                    'lat' => str_replace(',', '.', trim($row[10])),
                    'lng' => str_replace(',', '.', trim($row[11]))
                ];
            }
            
            if ($currentChurch !== null) {
                if (trim($row[5]) !== '') $currentChurch['facilities'][] = trim($row[5]);
                if (trim($row[7]) !== '') $currentChurch['pastors'][] = trim($row[7]);
                if (trim($row[8]) !== '') $currentChurch['schedules'][] = trim($row[8]);
                if (trim($row[9]) !== '') $currentChurch['activities'][] = trim($row[9]);
            }
        }
        if ($currentChurch !== null) {
            $churches[] = $currentChurch;
        }
        fclose($handle);

        foreach ($churches as $c) {
            // Determine Category
            $catName = 'Lain-lain';
            if (stripos($c['name'], 'Advent') !== false) $catName = 'Gereja Advent';
            elseif (stripos($c['name'], 'Toraja') !== false) $catName = 'Gereja Toraja';
            elseif (stripos($c['name'], 'Pantekosta') !== false) $catName = 'Gereja Pantekosta';
            elseif (stripos($c['name'], 'Betel') !== false || stripos($c['name'], 'Bethel') !== false) $catName = 'Gereja Bethel';
            elseif (stripos($c['name'], 'Katolik') !== false) $catName = 'Gereja Katolik';

            $category = ChurchCategory::firstOrCreate(
                ['slug' => Str::slug($catName)],
                ['name' => $catName, 'is_active' => true]
            );

            // Assemble Description
            $desc = "Gereja ini melayani jemaat di daerah " . $c['district'] . ".\n";
            if (!empty($c['pastors'])) {
                $desc .= "Pengkhotbah / Pendeta: " . implode(', ', $c['pastors']);
            }

            // Create Church
            $church = Church::create([
                'church_category_id' => $category->id,
                'name' => $c['name'],
                'slug' => Str::slug($c['name']),
                'address' => $c['address'],
                'district' => $c['district'],
                'city' => 'Makassar',
                'province' => 'Sulawesi Selatan',
                'latitude' => $c['lat'] ? (float) $c['lat'] : null,
                'longitude' => $c['lng'] ? (float) $c['lng'] : null,
                'description' => $desc,
                'capacity' => $c['capacity'] ?: 0,
                'verification_status' => 'verified',
            ]);

            // Sync Facilities
            foreach ($c['facilities'] as $facName) {
                $facility = Facility::firstOrCreate(
                    ['slug' => Str::slug($facName)],
                    ['name' => $facName]
                );
                $church->facilities()->attach($facility->id);
            }

            // Insert Schedules
            foreach ($c['schedules'] as $idx => $sched) {
                $church->schedules()->create([
                    'title' => $sched,
                    'day_of_week' => 7, // Default Sunday for simplicity, can't easily parse day from "Pagi (08.00)"
                    'start_time' => '08:00:00', 
                    'end_time' => '10:00:00',
                    'language' => 'Indonesia',
                ]);
            }

            // Insert Activities
            foreach ($c['activities'] as $act) {
                $church->activities()->create([
                    'title' => $act,
                    'slug' => Str::slug($c['name'] . ' ' . $act),
                    'start_at' => now(),
                    'end_at' => now()->addHours(2),
                    'is_active' => true
                ]);
            }
        }

        $this->command->info("CSV Seeded Successfully! Added " . count($churches) . " churches.");
    }
}
