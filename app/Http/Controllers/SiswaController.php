<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    public function show(){
        $data['user'] = User::where('level','siswa')->get();
        $data['kelas'] = Kelas::all();
        $data['siswa'] = Siswa::with('user')->with('kelas')->get();
        return view('pages.siswa',$data);
    }

    public function create(Request $request){
         if ($request->hasFile('foto')) {
            $photoPath = $request->file('foto')->storeAs('foto_siswa', $request->name . '.' . $request->file('foto')->getClientOriginalExtension());
        } else {
            $photoPath = null;
        }
        Siswa::create([
            'nisn' => $request->nisn,
            'name' => $request->name,
            'email' => $request->email,
            'telp' => $request->telp,
            'alamat' => $request->alamat,
            'foto' => $photoPath,
            'id_user' => $request->id_user,
            'id_kelas' => $request->id_kelas
        ]);

        return redirect('/users/siswa');
    }

    public function delete(Request $req){
        $user = Siswa::find($req->id);

        $deleted = Siswa::where('id', $req->id)->delete();

        if ($deleted) {
            if ($user->foto) {
                Storage::delete('foto_siswa/' . $user->foto);
            }
        }

        return redirect('/users/siswa');
    }

    public function edit(Request $request, $id)
    {
        $user = Siswa::find($id);
        $userData = [
            'nisn' => $request->nisn,
            'name' => $request->name,
            'email' => $request->email,
            'telp' => $request->telp,
            'alamat' => $request->alamat,
            'id_user' => $request->id_user,
            'id_kelas' => $request->id_kelas
        ];

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($user->foto) {
                Storage::delete($user->foto);
            }

            // Simpan foto baru ke direktori penyimpanan yang sesuai
            $photoPath = $request->file('foto')->storeAs('foto_siswa', $request->name . '.' . $request->file('foto')->getClientOriginalExtension());

            // Update path foto di database
            $userData['foto'] = $photoPath;
        }

        Siswa::where('id', $id)->update($userData);

        return redirect('/users/siswa');
    }
}
