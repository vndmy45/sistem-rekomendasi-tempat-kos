<?php

namespace Database\Seeders;

use App\Models\Kos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kos_list = [
            [
                'nama' => 'Edy Surya Kost',
                'harga' => 450000,
                'rating' => 4,
                'jarak' => 0.3,
                'gambar' => 'kos/edy-surya-1.jpg',
                'additional_images' => json_encode([
                    'kos/edy-surya-2.jpg',
                    'kos/edy-surya-3.jpg'
                ]),
                'alamat' => 'Jl. Soekarno Hatta No. 123, Banyuwangi',
                'deskripsi' => 'Kost nyaman dekat kampus dengan fasilitas lengkap. Lingkungan aman dan tenang, cocok untuk mahasiswa.',
                'status' => 'tersedia',
                'phone' => '0821-4438-0133',
                'views' => 150
            ],
            [
                'nama' => 'Green House Kost',
                'harga' => 550000,
                'rating' => 5,
                'jarak' => 0.5,
                'gambar' => 'kos/green-house-1.jpg',
                'additional_images' => json_encode([
                    'kos/green-house-2.jpg',
                    'kos/green-house-3.jpg'
                ]),
                'alamat' => 'Jl. Ahmad Yani No. 45, Banyuwangi',
                'deskripsi' => 'Kost exclusive dengan taman yang asri. Fasilitas premium dan lokasi strategis.',
                'status' => 'tersedia',
                'phone' => '0822-3456-7890',
                'views' => 200
            ],
            [
                'nama' => 'Putri Ayu Kost',
                'harga' => 400000,
                'rating' => 4,
                'jarak' => 0.8,
                'gambar' => 'kos/putri-ayu-1.jpg',
                'additional_images' => json_encode([
                    'kos/putri-ayu-2.jpg',
                    'kos/putri-ayu-3.jpg'
                ]),
                'alamat' => 'Jl. Diponegoro No. 78, Banyuwangi',
                'deskripsi' => 'Kost khusus putri dengan sistem keamanan 24 jam. Dekat dengan pusat kuliner dan mall.',
                'status' => 'tersedia',
                'phone' => '0823-4567-8901',
                'views' => 180
            ],
            [
                'nama' => 'Griya Indah Kost',
                'harga' => 600000,
                'rating' => 5,
                'jarak' => 1.2,
                'gambar' => 'kos/griya-indah-1.jpg',
                'additional_images' => json_encode([
                    'kos/griya-indah-2.jpg',
                    'kos/griya-indah-3.jpg'
                ]),
                'alamat' => 'Jl. Gatot Subroto No. 90, Banyuwangi',
                'deskripsi' => 'Kost premium dengan fasilitas hotel. AC, TV Cable, dan WiFi kecepatan tinggi tersedia.',
                'status' => 'tersedia',
                'phone' => '0824-5678-9012',
                'views' => 250
            ],
            [
                'nama' => 'Bintang Kost',
                'harga' => 350000,
                'rating' => 3,
                'jarak' => 1.5,
                'gambar' => 'kos/bintang-1.jpg',
                'additional_images' => json_encode([
                    'kos/bintang-2.jpg',
                    'kos/bintang-3.jpg'
                ]),
                'alamat' => 'Jl. Imam Bonjol No. 112, Banyuwangi',
                'deskripsi' => 'Kost ekonomis dengan fasilitas standar. Cocok untuk mahasiswa dengan budget terbatas.',
                'status' => 'tersedia',
                'phone' => '0825-6789-0123',
                'views' => 120
            ]
        ];

        foreach ($kos_list as $kos) {
            Kos::create($kos);
        }
    }
}
