<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PemonitoringController extends Controller
{
    public function show(){
        $data['user'] = User::where('level','pemonitor')->get();
        $data['guru'] = Guru::with('user')->get();
        return view('pages.pemonitoring',$data);
    }

    public function create(Request $request){
         if ($request->hasFile('foto')) {
            $photoPath = $request->file('foto')->storeAs('foto_guru', $request->name . '.' . $request->file('foto')->getClientOriginalExtension());
        } else {
            $photoPath = null;
        }
        Guru::create([
            'name' => $request->name,
            'email' => $request->email,
            'telp' => $request->telp,
            'alamat' => $request->alamat,
            'foto' => $photoPath,
            'id_user' => $request->id_user
        ]);

        return redirect('/users/pemonitoring');
    }

    public function delete(Request $req){
        $user = Guru::find($req->id);

        $deleted = Guru::where('id', $req->id)->delete();

        if ($deleted) {
            if ($user->foto) {
                Storage::delete('foto_guru/' . $user->foto);
            }
        }

        return redirect('/users/pemonitoring');
    }

    public function edit(Request $request, $id)
    {
        $user = Guru::find($id);
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'telp' => $request->telp,
            'alamat' => $request->alamat,
            'id_user' => $request->id_user
        ];

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($user->foto) {
                Storage::delete($user->foto);
            }

            // Simpan foto baru ke direktori penyimpanan yang sesuai
            $photoPath = $request->file('foto')->storeAs('foto_guru', $request->name . '.' . $request->file('foto')->getClientOriginalExtension());

            // Update path foto di database
            $userData['foto'] = $photoPath;
        }

        Guru::where('id', $id)->update($userData);

        return redirect('/users/pemonitoring');
    }
}
