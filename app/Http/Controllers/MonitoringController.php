<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Industri;
use App\Models\Kelas;
use App\Models\Monitoring;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MonitoringController extends Controller
{
    public function show(){
        if (Auth::user()->level == 'admin') {
            $data['guru'] = Guru::all();
            $data['kelas'] = Kelas::all();
            $data['siswa'] = Siswa::with('kelas')->get();
            $data['industri'] = Industri::all();
            $data['monitoring'] = Monitoring::with('guru')->with('industri')->with('siswa')->groupBy('id_industri')->get();
        }else{
            $data['user'] = User::where('id', Auth::user()->id)->get();
            $userId = $data['user'][0]->id;
            $data['guru'] = Guru::where('id_user', $userId)->first();
            $idguru = $data['guru']->id;
            $data['kelas'] = Kelas::all();
            $data['siswa'] = Siswa::with('kelas')->get();
            $data['industri'] = Industri::all();
            $data['monitoring'] = Monitoring::where('id_guru',$idguru)->with('guru')->with('industri')->with('siswa')->groupBy('id_industri')->get();
        }
        return view('pages.monitoring',$data);
    }


    public function create(Request $request){

        foreach ($request->id_siswa as $id_siswa) {
            Monitoring::create([
                'id_guru' => $request->id_guru,
                'id_industri' => $request->id_industri,
                'id_siswa' => $id_siswa,
            ]);
        }

        return redirect('/monitoring');
    }

    public function delete(Request $req){
        Monitoring::where('id_industri', $req->id_industri)->delete();
        return redirect('/monitoring');
    }

    public function edit(Request $request, $id)
    {
        Monitoring::where('id_industri', $request->id_industri)->delete();

       foreach ($request->id_siswa as $id_siswa) {
            Monitoring::create([
                'id_guru' => $request->id_guru,
                'id_industri' => $request->id_industri,
                'id_siswa' => $id_siswa,
            ]);
        }

        return redirect('/monitoring');
    }
}
