<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Kelas;
use App\Models\Siswa;

class LaporanController extends Controller
{
    public function show(){
        $data['kelas'] = Kelas::all();
        $data['siswa'] = Siswa::with('kelas')->get();
        $data['absensi'] = Absensi::with('siswa')->get();
        return view('pages.laporan',$data);
    }

    public function showKegiatan(){
        $data['kelas'] = Kelas::all();
        $data['siswa'] = Siswa::with('kelas')->get();
        $data['absensi'] = Absensi::with('siswa')->get();
        return view('pages.laporanKegiatan',$data);
    }
}
