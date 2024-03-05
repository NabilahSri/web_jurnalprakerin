<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PemonitoringController extends Controller
{
    public function show(){
        $data['user'] = User::where('level','pemonitor')->get();
        $data['guru'] = Guru::with('user')->get();
        return view('pages.pemonitoring',$data);
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(),[
            'username' => 'Required|unique:users',
            'name' => 'Required',
            'email' => 'Required|email',
            'telp' => 'Required|min:12',
            'alamat' => 'Required',
        ]);
        if ($validator->fails()) {
            return back()->with('error',$validator->messages()->all()[0])->withInput();
        }
         if ($request->hasFile('foto')) {
            $photoPath = $request->file('foto')->storeAs('foto_guru', $request->name . '.' . $request->file('foto')->getClientOriginalExtension());
        } else {
            $photoPath = null;
        }
        User::create([
            'username' => $request->username,
            'password' => bcrypt('12341234'),
            'level' => 'pemonitor'
        ]);
        $user = User::where('username',$request->username)->first();
        $user_id = $user->id;
        Guru::create([
            'name' => $request->name,
            'email' => $request->email,
            'telp' => $request->telp,
            'alamat' => $request->alamat,
            'foto' => $photoPath,
            'id_user' => $user_id
        ]);

        return redirect('/users/pemonitoring')->with('success','Data berhasil disimpan');
    }

    public function delete(Request $req,$id){
        $guru = Guru::find($id);

        $deleted = Guru::where('id', $id)->delete();

        if ($deleted) {
            if ($guru->foto) {
                Storage::delete('foto_guru/' . $guru->foto);
            }
            $user = User::find($guru->id_user);
            $user->delete();
        }

        return redirect('/users/pemonitoring')->with('success','Data berhasil dihapus');
    }

    public function edit(Request $request, $id)
    {
        $guru = Guru::find($id);
        if ($request->hasFile('foto')) {
            $photoPath = $request->file('foto')->storeAs('foto_guru', $request->name . '.' . $request->file('foto')->getClientOriginalExtension());
        } else {
            $photoPath = $guru->foto;
        }
        $user = User::find($guru->id_user);
        $user->username = $request->username;
        if (!empty($request->password)) {
            $user->password = bcrypt($request->password);
        }
        $user->level = 'pemonitor';
        $user->save();
        $guru->name = $request->name;
        $guru->email = $request->email;
        $guru->telp = $request->telp;
        $guru->alamat = $request->alamat;
        $guru->foto = $photoPath;
        $guru->save();

        return redirect('/users/pemonitoring')->with('success','Data berhasil diupdate');
    }
}
