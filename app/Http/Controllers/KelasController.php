<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function show(){
        $data['kelas'] = Kelas::all();
        return view('pages.kelas',$data);
    }

    public function create(Request $request){
        Kelas::create([
            'kelas' => $request->kelas,
        ]);

        return redirect('/kelas');
    }

    public function delete(Request $req){
        Kelas::where('id', $req->id)->delete();
        return redirect('/kelas');
    }

    public function edit(Request $request, $id)
    {
        $userData = [
            'kelas' => $request->kelas,
        ];

        Kelas::where('id', $id)->update($userData);

        return redirect('/kelas');
    }
}
