<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    public function show(){
        $data['akun'] = User::whereIn('level',['siswa','pemonitor'])->get();
        return view('pages.akun',$data);
    }

    public function create(Request $request){
        User::create([
            'username' => $request->username,
            'password'=> bcrypt($request->password),
            'level' => $request->level
        ]);

        return redirect('/akun');
    }

    public function delete(Request $req){
        User::where('id', $req->id)->delete();
        return redirect('/akun');
    }

    public function edit(Request $request, $id)
    {
        $userData = [
            'username' => $request->username,
            'level' => $request->level
        ];
        if (!empty($request->password)) {
            $userData['password'] = bcrypt($request->password);
        }

        User::where('id', $id)->update($userData);

        return redirect('/akun');
    }
}
