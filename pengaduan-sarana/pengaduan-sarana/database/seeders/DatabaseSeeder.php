<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Administrator',
            'email'    => 'admin@sekolah.id',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        User::create([
            'name'     => 'Siswa Demo',
            'email'    => 'siswa@sekolah.id',
            'password' => Hash::make('password'),
            'role'     => 'siswa',
        ]);

        $categories = [
            ['name' => 'Fasilitas Kelas',      'description' => 'Pengaduan terkait fasilitas di dalam kelas seperti meja, kursi, papan tulis, dll.'],
            ['name' => 'Toilet & Kebersihan',  'description' => 'Pengaduan terkait kebersihan toilet dan lingkungan sekolah.'],
            ['name' => 'Laboratorium',         'description' => 'Pengaduan terkait peralatan dan fasilitas laboratorium.'],
            ['name' => 'Perpustakaan',         'description' => 'Pengaduan terkait koleksi buku dan fasilitas perpustakaan.'],
            ['name' => 'Lapangan & Olahraga',  'description' => 'Pengaduan terkait lapangan olahraga dan peralatan olahraga.'],
            ['name' => 'Jaringan & Teknologi', 'description' => 'Pengaduan terkait wifi, komputer, dan infrastruktur teknologi.'],
            ['name' => 'Kantin',               'description' => 'Pengaduan terkait kebersihan dan kualitas makanan di kantin.'],
            ['name' => 'Lain-lain',            'description' => 'Pengaduan lain yang tidak termasuk kategori di atas.'],
        ];

        foreach ($categories as $cat) {
            Category::create(array_merge($cat, ['is_active' => true]));
        }
    }
}
