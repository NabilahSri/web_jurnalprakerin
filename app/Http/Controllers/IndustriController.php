<?php

namespace App\Http\Controllers;

use App\Models\Industri;
use Illuminate\Http\Request;

class IndustriController extends Controller
{
    public function show(){
        $data['industri'] = Industri::all();
        return view('pages.industri',$data);
    }

    public function create(Request $request){
        Industri::create([
            'name' => $request->name,
            'owner' => $request->owner,
            'alamat' => $request->alamat,
            'telp' => $request->telp,
            'email' => $request->email,
        ]);

        return redirect('/industri');
    }

    public function delete(Request $req){
        Industri::where('id', $req->id)->delete();
        return redirect('/industri');
    }

    public function edit(Request $request, $id)
    {
        $userData = [
            'name' => $request->name,
            'owner' => $request->owner,
            'alamat' => $request->alamat,
            'telp' => $request->telp,
            'email' => $request->email,
        ];

        Industri::where('id', $id)->update($userData);

        return redirect('/industri');
    }
}
