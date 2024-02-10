<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdministratorController extends Controller
{
    public function show(){
        $data['admin'] = User::where('level','admin')->get();
        return view('pages.administrator',$data);
    }

    public function create(Request $request){
        User::create([
            'username' => $request->username,
            'password'=> bcrypt($request->password),
            'level' =>'admin'
        ]);

        return redirect('/users/administrator');
    }

    public function delete(Request $req){
        User::where('id', $req->id)->delete();
        return redirect('/users/administrator');
    }

    public function edit(Request $request, $id)
    {
        $user = User::find($id);
        $userData = [
            'username' => $request->username,
            'level' =>'admin'
        ];
        if (!empty($request->password)) {
            $userData['password'] = bcrypt($request->password);
        }

        User::where('id', $id)->update($userData);

        return redirect('/users/administrator');
    }
}
