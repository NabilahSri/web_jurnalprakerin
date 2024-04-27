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
