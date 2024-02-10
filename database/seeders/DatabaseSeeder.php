<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Absensi;
use App\Models\Guru;
use App\Models\Industri;
use App\Models\Kegiatan;
use App\Models\Kelas;
use App\Models\Monitoring;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'username' => 'testAdmin',
            'password' => bcrypt('12341234'),
            'level' => 'admin'
        ]);

        User::create([
            'username' => 'testPemonitoring',
            'password' => bcrypt('12341234'),
            'level' => 'pemonitor'
        ]);

        Guru::create([
            'name' =>'Nindi',
            'email' => 'nindi@gmail.com',
            'telp' => '098765432123',
            'alamat' => 'Tasikmalaya',
            'id_user' =>'2'
        ]);

        User::create([
            'username' => 'testSiswa',
            'password' => bcrypt('12341234'),
            'level' => 'siswa'
        ]);

        Kelas::create([
            'kelas' => 'XII RPL 1'
        ]);

        Kelas::create([
           'kelas' => 'XII RPL 2'
        ]);

        Siswa::create([
            'nisn' => '0098765432123456',
            'name' =>'Yolanda',
            'email' => 'yolanda@gmail.com',
            'telp' => '098765439993',
            'alamat' => 'Tasikmalaya',
            'id_user' =>'3',
            'id_kelas' => '2'
        ]);

        Industri::create([
            'name' =>'PT. Makerindo Prima Solusi',
            'owner' => 'Bpk. ',
            'alamat' => 'Bandung',
            'telp' => '098765439993',
            'email' => 'makerindo@gmail.com',
        ]);

        Monitoring::create([
            'id_guru' => '1',
            'id_industri' => '1',
            'id_siswa' => '1'
        ]);

        Absensi::create([
            'tanggal' => Carbon::now('Asia/Jakarta'),
            'jam_masuk' => '07:00:00',
            'jam_masuk' => '17:00:00',
            'status' => 'hadir',
            'alamat' => 'Bandung',
            'id_siswa' => '1'
        ]);

        Kegiatan::create([
            'deskripsi' => 'Membuat halaman login',
            'durasi' => '60',
            'id_absensi' => '1'
        ]);

        Kegiatan::create([
            'deskripsi' => 'Membuat halaman utama',
            'durasi' => '240',
            'id_absensi' => '1'
        ]);


        // \App\Models\User::factory()->create([
        //     'name' => 'Test Admin',
        //     'email' => 'testAdmin@gmail.com',
        //     'username' => 'testAdmin',
        //     'telp' => '089999999999',
        //     'alamat' => 'tasikmalaya',
        //     'password' => bcrypt('12341234'),
        //     'level' => 'admin'
        // ]);

        //  \App\Models\User::factory()->create([
        //     'name' => 'Test Siswa',
        //     'email' => 'testSiswa@gmail.com',
        //     'username' => 'testSiswa',
        //     'telp' => '087654333333',
        //     'alamat' => 'tasikmalaya',
        //     'password' => bcrypt('12341234'),
        //     'level' => 'siswa'
        // ]);

        //  \App\Models\User::factory()->create([
        //     'name' => 'Test Pemonitoring',
        //     'email' => 'testPemonitoring@gmail.com',
        //     'username' => 'testPemonitoring',
        //     'telp' => '085555555555',
        //     'alamat' => 'tasikmalaya',
        //     'password' => bcrypt('12341234'),
        //     'level' => 'pemonitor'
        // ]);
    }
}
