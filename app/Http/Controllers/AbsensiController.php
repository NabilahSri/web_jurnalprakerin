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
            $data['absensi'] = Absensi::with('siswa')->orderBy('created_at','desc')->get();
        }else{
            $data['user'] = User::where('id', Auth::user()->id)->first();
            $userId = $data['user']->id;

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
                    ->orderBy('created_at','desc')
                    ->get();

        }
        return view('pages.kehadiran',$data);
    }
}
