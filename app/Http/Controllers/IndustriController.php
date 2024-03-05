<?php

namespace App\Http\Controllers;

use App\Models\Industri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IndustriController extends Controller
{
    public function show(){
        $data['industri'] = Industri::all();
        return view('pages.industri',$data);
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'Required',
            'owner' => 'Required',
            'latitude' => 'Required',
            'longitude' => 'Required',
            'alamat' => 'Required',
            'telp' => 'Required|min:12',
            'email' => 'Required|email',
        ]);
        if ($validator->fails()) {
            return back()->with('error',$validator->messages()->all()[0])->withInput();
        }
        Industri::create([
            'name' => $request->name,
            'owner' => $request->owner,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'alamat' => $request->alamat,
            'telp' => $request->telp,
            'email' => $request->email,
        ]);

        return redirect('/industri')->with('success','Data berhasil disimpan');
    }

    public function delete(Request $req){
        Industri::where('id', $req->id)->delete();
        return redirect('/industri')->with('success','Data berhasil dihapus');
    }

    public function edit(Request $request, $id)
    {
        $userData = [
            'name' => $request->name,
            'owner' => $request->owner,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'alamat' => $request->alamat,
            'telp' => $request->telp,
            'email' => $request->email,
        ];

        Industri::where('id', $id)->update($userData);

        return redirect('/industri')->with('success','Data berhasil diupdate');
    }
}
