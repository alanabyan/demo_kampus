<?php

namespace Database\Seeders;

use App\Models\Materi;
use App\Models\Nilai;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create(['name' => 'Admin Kampus', 'email' => 'admin@kampus.test', 'password' => 'password', 'role' => 'admin']);
        $dosen = User::create(['name' => 'Dosen Budi', 'email' => 'dosen@kampus.test', 'password' => 'password', 'role' => 'dosen']);
        $mhs = User::create(['name' => 'Mahasiswa Sari', 'email' => 'mahasiswa@kampus.test', 'password' => 'password', 'role' => 'mahasiswa']);

        $materi = Materi::create(['judul' => 'Pemrograman Web', 'deskripsi' => 'Dasar Laravel', 'dosen_id' => $dosen->id]);
        Nilai::create(['mahasiswa_id' => $mhs->id, 'materi_id' => $materi->id, 'nilai' => 85]);
    }
}
