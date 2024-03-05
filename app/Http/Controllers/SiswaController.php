<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{
    public function show(){
        $data['user'] = User::where('level','siswa')->get();
        $data['kelas'] = Kelas::all();
        $data['siswa'] = Siswa::with('user')->with('kelas')->get();

        return view('pages.siswa',$data);
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(),[
            'username' => 'Required|unique:users',
            'nisn' => 'Required',
            'name' => 'Required',
            'email' => 'Required|email',
            'telp' => 'Required|min:12',
            'alamat' => 'Required',
            'id_kelas' => 'Required',
        ]);
        if ($validator->fails()) {
            return back()->with('error',$validator->messages()->all()[0])->withInput();
        }
         if ($request->hasFile('foto')) {
            $photoPath = $request->file('foto')->storeAs('foto_siswa', $request->name . '.' . $request->file('foto')->getClientOriginalExtension());
        } else {
            $photoPath = null;
        }
        User::create([
            'username' => $request->username,
            'password' => bcrypt('12341234'),
            'level' => 'siswa'
        ]);
        $user = User::where('username',$request->username)->first();
        $user_id = $user->id;
        Siswa::create([
            'nisn' => $request->nisn,
            'name' => $request->name,
            'email' => $request->email,
            'telp' => $request->telp,
            'alamat' => $request->alamat,
            'foto' => $photoPath,
            'id_user' => $user_id,
            'id_kelas' => $request->id_kelas
        ]);

        return redirect('/users/siswa')->with('success','Data berhasil disimpan');
    }

    public function delete(Request $req,$id){
        $siswa = Siswa::find($id);
        $deleted = Siswa::where('id', $id)->delete();

        if ($deleted) {
            if ($siswa->foto) {
                Storage::delete('foto_siswa/' . $siswa->foto);
            }
            $user = User::find($siswa->id_user);
            $user->delete();
        }

        return redirect('/users/siswa')->with('success','Data berhasil dihapus');
    }

    public function edit(Request $request, $id)
    {
        $siswa = Siswa::find($id);
        if ($request->hasFile('foto')) {
            $photoPath = $request->file('foto')->storeAs('foto_siswa', $request->name . '.' . $request->file('foto')->getClientOriginalExtension());
        } else {
            $photoPath = $siswa->foto;
        }
        $user = User::find($siswa->id_user);
        $user->username = $request->username;
        if (!empty($request->password)) {
            $user->password = bcrypt($request->password);
        }
        $user->level = 'siswa';
        $user->save();
        $siswa->nisn = $request->nisn;
        $siswa->name = $request->name;
        $siswa->email = $request->email;
        $siswa->telp = $request->telp;
        $siswa->alamat = $request->alamat;
        $siswa->foto = $photoPath;
        $siswa->id_kelas = $request->id_kelas;
        $siswa->save();

        return redirect('/users/siswa')->with('success','Data berhasil diupdate');
    }
}
