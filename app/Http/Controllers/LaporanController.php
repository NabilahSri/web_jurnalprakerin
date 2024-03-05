<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Guru;
use App\Models\Kegiatan;
use App\Models\Kelas;
use App\Models\Monitoring;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function show(){
        if (Auth::user()->level == 'admin') {
            $data['kelas'] = Kelas::all();
            $data['siswa'] = Siswa::with('kelas')->get();
            $data['absensi'] = Absensi::with('siswa')->get();
        }else{
            $id_userpemonitor = Auth::user()->id;
            $pemonitoring = Guru::where('id_user',$id_userpemonitor)->first();
            $monitoring = Monitoring::where('id_guru', $pemonitoring->id)->first();

            if ($monitoring) {
                $data['siswa'] = Siswa::where('id', $monitoring->id_siswa)->with('kelas')->get();
                $data['kelas'] = Kelas::whereIn('id', $data['siswa']->pluck('id_kelas'))->get();
                $data['absensi'] = Absensi::whereIn('id_siswa', $data['siswa']->pluck('id'))->with('siswa')->get();
            } else {
                $data['siswa'] = [];
                $data['kelas'] = [];
                $data['absensi'] = [];
            }
        }
        return view('pages.laporan',$data);
    }

    public function showKegiatan(){
       if (Auth::user()->level == 'admin') {
            $data['kelas'] = Kelas::all();
            $data['siswa'] = Siswa::with('kelas')->get();
            $data['absensi'] = Absensi::with('siswa')->get();
        }else{
            $id_userpemonitor = Auth::user()->id;
            $pemonitoring = Guru::where('id_user',$id_userpemonitor)->first();
            $monitoring = Monitoring::where('id_guru', $pemonitoring->id)->first();

            if ($monitoring) {
                $data['siswa'] = Siswa::where('id', $monitoring->id_siswa)->with('kelas')->get();
                $data['kelas'] = Kelas::whereIn('id', $data['siswa']->pluck('id_kelas'))->get();
                $data['absensi'] = Absensi::whereIn('id_siswa', $data['siswa']->pluck('id'))->with('siswa')->get();
            } else {
                $data['siswa'] = [];
                $data['kelas'] = [];
                $data['absensi'] = [];
            }
        }
        return view('pages.laporanKegiatan',$data);
    }

    public function actionKegiatan(Request $request){
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');
        $idKelas = $request->input('id_kelas');

        $data['kelas'] = Kelas::where('id',$idKelas)->first();
        $id_kelas = $data['kelas']->id;

        $data['siswa'] = Siswa::where('id_kelas',$id_kelas)->get();
        $id_siswa = $data['siswa']->pluck('id');

        $data['absensi'] = Absensi::whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir])
                            ->whereIn('id_siswa', $id_siswa)
                            ->get();
        $id_absen = $data['absensi']->pluck('id');

        $data['kegiatan'] = Kegiatan::where('id_kelas', $id_kelas)
                            ->whereIn('id_absensi', $id_absen)
                            ->select('id_siswa', DB::raw('SUM(durasi) as total_durasi_menit'))
                            ->groupBy('id_siswa')
                            ->with('siswa')
                            ->get();

        // Mengubah total durasi menit ke jam dan menit
        foreach ($data['kegiatan'] as $kegiatan) {
            $jam = floor($kegiatan->total_durasi_menit / 60);
            $menit = $kegiatan->total_durasi_menit % 60;
            $kegiatan->total_durasi = "{$jam} jam {$menit} menit";
        }
         return view('pages.laporanKegiatan_table', compact('data'));
    }

    public function actionKehadiran(Request $request){
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');
        $idKelas = $request->input('id_kelas');

        $data['kelas'] = Kelas::where('id',$idKelas)->first();
        $id_kelas = $data['kelas']->id;

        $data['siswa'] = Siswa::where('id_kelas',$id_kelas)->get();
        $id_siswa = $data['siswa']->pluck('id');

        $data['absensi'] = Absensi::whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir])
                            ->whereIn('id_siswa', $id_siswa)
                            ->groupBy('id_siswa')
                            ->with('siswa')
                            ->get();
        return view('pages.laporan_table', compact('data'));
    }
}
