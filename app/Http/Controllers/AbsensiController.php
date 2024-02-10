<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Guru;
use App\Models\Kegiatan;
use App\Models\Kelas;
use App\Models\Monitoring;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    public function show(){
        if (Auth::user()->level == 'admin') {
            $data['kelas'] = Kelas::all();
            $data['siswa'] = Siswa::with('kelas')->get();
            $data['absensi'] = Absensi::with('siswa')->get();
        }else{
            $data['user'] = User::where('id', Auth::user()->id)->get();
            $userId = $data['user'][0]->id;

            $data['guru'] = Guru::where('id_user', $userId)->first();
            $idguru = $data['guru']->id;

            $data['monitoring'] = Monitoring::where('id_guru',$idguru)->get();
            $data['kelas'] = Kelas::all();
            $data['siswa'] = Siswa::with('kelas')->get();
            $data['absensi'] = Absensi::with(['siswa' => function($query) use ($idguru) {
                        $query->whereHas('monitoring', function($query) use ($idguru) {
                            $query->where('id_guru', $idguru);
                        })
                        ->with('kelas');
                    }])
                    ->whereHas('siswa.monitoring', function($query) use ($idguru) {
                        $query->where('id_guru', $idguru);
                    })
                    ->get();
                    // Add null check before accessing the `name` property
            // $data['absensi'] = $data['absensi']->map(function ($absensi) {
            //     $siswa = $absensi->siswa ?? new Siswa; // Initialize the $siswa object here
            //     $siswa->name = $siswa->name ?? 'N/A'; // Add null check here
            //     $kelas = $absensi->kelas ?? new Kelas;
            //     $kelas->kelas = $kelas->kelas ?? 'N/A';
            //     return $absensi;
            // });

        }
        return view('pages.kehadiran',$data);
    }
}
