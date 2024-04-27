<?php

namespace App\Http\Controllers;

use App\Models\Industri;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IndustriController extends Controller
{
    public function show(){
        $data['user'] = User::all();
        $data['industri'] = Industri::with('user')->get();
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
        User::create([
            'username' => $request->username,
            'password' => bcrypt('12341234'),
            'level' => 'industri'
        ]);
        $user = User::where('username',$request->username)->first();
        $user_id = $user->id;
        Industri::create([
            'name' => $request->name,
            'owner' => $request->owner,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'alamat' => $request->alamat,
            'telp' => $request->telp,
            'id_user' => $user_id,
            'email' => $request->email,
        ]);

        return redirect('/industri')->with('success','Data berhasil disimpan');
    }

    public function delete(Request $req,$id){
        $industri = Industri::find($id);
        $deleted = Industri::where('id',$id)->delete();
        if ($deleted) {
            $industri = Industri::find($industri->id_user);
            $industri->delete();
        }
        return redirect('/industri')->with('success','Data berhasil dihapus');
    }

    public function edit(Request $request, $id)
    {

        $industri = Industri::find($id);
        $user = User::find($industri->id_user);
        $user->username = $request->username;
        if (!empty($request->password)) {
            $user->password = bcrypt($request->password);
        }
        $user->level = 'industri';
        $user->save();
        $industri->name = $request->name;
        $industri->owner = $request->owner;
        $industri->latitude = $request->latitude;
        $industri->longitude = $request->longitude;
        $industri->alamat = $request->alamat;
        $industri->telp = $request->telp;
        $industri->email = $request->email;
        $industri->save();

        return redirect('/industri')->with('success','Data berhasil diupdate');
    }
}
