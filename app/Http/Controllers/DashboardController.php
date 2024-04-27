<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Industri;
use App\Models\Kelas;
use App\Models\Monitoring;
use App\Models\Siswa;
use App\Models\Token;
use App\Models\User;
use Illuminate\Contracts\Queue\Monitor;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function show(){
       if (auth()->user()->level == 'admin') {
            $data['kelas'] = Kelas::all()->count();
            $data['industri'] = Industri::all()->count();
            $data['siswa'] = Siswa::all()->count();
            $data['guru'] = Guru::all()->count();
            $data['admin'] = User::where('level','admin')->count();
       }
       if (auth()->user()->level == 'pemonitor') {
            $id_user = auth()->user()->id;
            $data['guru'] = Guru::where('id_user',$id_user)->first();
            $id_guru = $data['guru']->id;
            $data['monitoring'] = Monitoring::where('id_guru',$id_guru)->count();
       }
       if (auth()->user()->level == 'industri') {
            $id_user = auth()->user()->id;
            $data['industri'] = Industri::where('id_user',$id_user)->first();
            $id_industri = $data['industri']->id;
            $data['token'] = Token::where('id_industri',$id_industri)->count();
       }
        return view('pages.dashboard',$data);
    }
}
