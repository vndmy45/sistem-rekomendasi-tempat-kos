<?php

namespace Database\Seeders;

use App\Models\Fasilitas;
use App\Models\Kos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FasilitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fasilitas_list = [
            ['nama' => 'WiFi'],
            ['nama' => 'AC'],
            ['nama' => 'Kamar Mandi Dalam'],
            ['nama' => 'Kasur'],
            ['nama' => 'Lemari'],
            ['nama' => 'Meja Belajar'],
            ['nama' => 'Dapur Bersama'],
            ['nama' => 'Parkir Motor'],
            ['nama' => 'Parkir Mobil'],
            ['nama' => 'CCTV'],
            ['nama' => 'TV'],
            ['nama' => 'Laundry']
        ];

        // Create fasilitas
        foreach ($fasilitas_list as $fasilitas) {
            Fasilitas::create($fasilitas);
        }

        // Attach random fasilitas to each kos
        $all_fasilitas = Fasilitas::all();
        Kos::all()->each(function ($kos) use ($all_fasilitas) {
            // Get 4-8 random fasilitas for each kos
            $random_fasilitas = $all_fasilitas->random(rand(4, 8));
            $kos->fasilitas()->attach($random_fasilitas);
        });
    }
}
