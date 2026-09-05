<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            RolePermissionSeeder::class,
            BookDataSeeder::class,
        ]);

        // Create admin user
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@perpustakaan.com',
            'password' => 'password',
            'role' => 'admin',
        ]);
        $admin->assignRole('admin');

        // Create petugas user
        $petugas = User::factory()->create([
            'name' => 'Petugas',
            'email' => 'petugas@perpustakaan.com',
            'password' => 'password',
            'role' => 'petugas',
        ]);
        $petugas->assignRole('petugas');

        // Create siswa user
        $siswa = User::factory()->create([
            'name' => 'Siswa',
            'email' => 'siswa@perpustakaan.com',
            'password' => 'password',
            'role' => 'siswa',
        ]);
        $siswa->assignRole('siswa');
    }
}
