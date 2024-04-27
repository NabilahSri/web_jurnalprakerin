<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Industri;
use App\Models\Kelas;
use App\Models\Monitoring;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'username' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(),422);
        }
        $credential = $request->only('username','password');
        $token = auth()->guard('api')->attempt($credential);
        $user = auth()->guard('api')->user();
        $id_user = $user->id;
        $data['kelas'] = Kelas::all();
        $siswa = Siswa::where('id_user',$id_user)->with('kelas')->first();
        $login_token = tap(User::where([
            'username' =>$request->username
        ]))->update([
            'login_token' => $token
            ])->first();
        if (!$token) {
            return response()->json([
                'success' =>false,
                'message' => 'Username atau password anda salah!'
            ],404);
        }else{
            return response()->json([
                'success' => true,
                'user' => $user,
                'siswa' => $siswa,
                'token' => $token
            ],200);
        }
    }

    public function showId(Request $request,$id){
        $user = User::where([
            'login_token' =>$request->token
        ])->first();
        if ($request->token ==null || !$user) {
            return response()->json([
                'message' => 'Unauthorization User'
            ],401);
        }else{
            Kelas::all();
            $user = User::where('id', $id)->first();
            $id_user = $user->id;
            $siswa = Siswa::where('id_user',$id_user)->with('kelas')->first();
            if ($siswa) {
                $siswaWithFoto =[
                    'nisn' => $siswa->nisn,
                    'name' => $siswa->name,
                    'username' => $user->username,
                    'password' => $user->password,
                    'email' => $siswa->email,
                    'telp' => $siswa->telp,
                    'alamat' => $siswa->alamat,
                    'kelas' => $siswa->kelas->kelas,
                    'foto' => $siswa->foto ? asset('storage/' . $siswa->foto) : null,
                ];
                return response()->json([
                    'success' => true,
                    'user' => $siswaWithFoto
                ],200);
            }else{
                return response()->json([
                    'message' => 'User not found'
                ],404);
            }
        }
    }

    public function edit(Request $request,$id){
        $token = User::where([
            'login_token' => $request->token
        ])->first();
        if ($request->token == null || !$token) {
            return response()->json([
                'message' => 'Unauthorization User'
            ],401);
        } else{
            $validator = Validator::make($request->all(),[
                'username' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    $validator->errors()
                ],422);
            }
            $user = User::where('id', $id)->first();

            if (!$user) {
                return response()->json([
                    'message' => 'User not found'
                ],404);
            }else{
                $data = ['username' => $request->username];
                if (!empty($request->password)) {
                    $data['password'] = bcrypt($request->password);
                }
                $userUpdate = User::where('id',$id)->update($data);
                if ($userUpdate) {
                    $user = User::where('id',$id)->first();
                    return response()->json([
                        'success' => true,
                        'message' => 'Item updated successfully',
                        'data' => $user
                    ],200);
                }else{
                    return response()->json([
                        'message' => 'Failed to update user'
                    ], 500);
                }
            }
        }
    }

    public function editProfil(Request $request,$id){
        $token = User::where([
            'login_token' => $request->token
        ])->first();
        if ($request->token == null || !$token) {
            return response()->json([
                'message' => 'Unauthorization User'
            ],401);
        } else{
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'email' => 'required',
                'telp' => 'required',
                'alamat' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    $validator->errors()
                ],422);
            }
            $siswa = Siswa::where('id',$id)->first();
            if ($request->hasFile('foto')) {
                $filename = $request->file('foto')->storeAs('foto_siswa', $request->name . '.' . $request->file('foto')->getClientOriginalExtension());
                $photopath = $filename;
            }else{
                $photopath = $siswa->foto;
            }

            $siswa -> name = $request->name;
            $siswa -> email = $request->email;
            $siswa -> telp = $request->telp;
            $siswa -> alamat = $request->alamat;
            $siswa -> foto = $photopath;
            $siswa->save();

            if ($siswa) {
                $siswas = Siswa::where('id_user',$id)->first();
                return response()->json([
                    'success' => true,
                    'siswa' => $siswas,
                    ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => "Ubah data siswa gagal"
                ], 409);
            }
        }
    }

    public function logout(Request $request){
        if ($request->token == null) {
            return response()->json([
                'message' => 'Unauthorization User'
            ],401);
        }
        $user = User::where([
            'login_token' => $request->token
        ])->first();

        if (!$user){
            return response()->json([
                'success' => false,
                'message' => 'User failled signed out'
            ], 200);
        }
        $token = auth()->guard('api')->login($user);

        if ($user) {

            $logout_token = tap(User::where([
                'login_token' => $request->token,
            ]))->update([
                'login_token' => $token
            ])->first();

            auth()->guard('api')->logout($user);

            return response()->json([
                'success' => true,
                'message' => 'User successfully signed out'
            ], 200);
        }
    }
}
