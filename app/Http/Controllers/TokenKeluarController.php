<?php

namespace App\Http\Controllers;

use App\Models\Industri;
use App\Models\TokenKeluar;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TokenKeluarController extends Controller
{
    public function showToken(Request $request) {
        $user = auth()->user()->id;
        $industri = Industri::where('id_user',$user)->first();
        $data['token'] = TokenKeluar::where('id_industri',$industri->id)->orderBy('created_at','desc')->get();
        return view('pages.token_keluar',$data);
    }

    public function saveToken(Request $request){
        $carbon = Carbon::now('Asia/Jakarta')->addMinute(30);
        $token_length = 5;
        $token = '';
        for ($i = 0; $i < $token_length; $i++) {
            $token .= mt_rand(0, 9); // Menghasilkan angka acak antara 0 dan 9
        }
        $user = auth()->user()->id;
        $industri = Industri::where('id_user',$user)->first();
        TokenKeluar::create([
            'token_keluar' => $token,
            'kadaluarsa_pada' => $carbon,
            'id_industri'=>$industri->id
        ]);
        return redirect('token/tokenKeluar');
    }
}
