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
            'alamat' => 'Jl. Garut - Tasikmalaya, Cikunten, Kec. Singaparna, Kabupaten Tasikmalaya, Jawa Barat 46414',
            'latitude' => '-7.360720567177067',
            'longitude' => '108.10579888093392',
            'telp' => '098765439993',
            'email' => 'makerindo@gmail.com',
        ]);

        Monitoring::create([
            'id_guru' => '1',
            'id_industri' => '1',
            'id_siswa' => '1'
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
