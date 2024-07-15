<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KegiatanController extends Controller
{
    public function show(Request $request,$id){
        $user = User::where([
            'login_token' =>$request->token
        ])->first();
        if ($request->token ==null || !$user) {
            return response()->json([
                'message' => 'Unauthorization User'
            ],401);
        }else{
            $user = User::where('id', $id)->first();
            $id_user = $user->id;
            $siswa = Siswa::where('id_user',$id_user)->first();
            $id_siswa = $siswa->id;
            $kegiatan = Kegiatan::where('id_siswa',$id_siswa)->orderBy('created_at','desc')->get();
            return response()->json([
                'kegiatan' => $kegiatan
            ],200);
        }
    }

    public function showIdKegiatan(Request $request,$id){
        $user = User::where([
            'login_token' =>$request->token
        ])->first();
        if ($request->token ==null || !$user) {
            return response()->json([
                'message' => 'Unauthorization User'
            ],401);
        }else{
            $kegiatan = Kegiatan::where('id',$id)->first();
            return response()->json([
                'kegiatan' => $kegiatan
            ],200);
        }
    }

    public function add(Request $request){
        $token = User::where([
            'login_token' => $request->token
        ])->first();
        if ($request->token == null || !$token) {
            return response()->json([
                'message' => 'Unauthorization User'
            ],401);
        }else{
            $validator = Validator::make($request->all(),[
                'deskripsi' => 'required',
                'durasi' => 'required',
                'id_absensi' => 'required',
                'id_siswa' => 'required',
                'id_kelas' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    $validator->errors()
                ],422);
            }
            $kegiatan = Kegiatan::create([
                'deskripsi' => $request->deskripsi,
                'durasi' => $request->durasi,
                'id_absensi' => $request->id_absensi,
                'id_siswa' => $request->id_siswa,
                'id_kelas' => $request->id_kelas,
            ]);
            if ($request->hasFile('foto')) {
                $filename = $request->file('foto')->storeAs('foto_kegiatan', $request->id_absensi . '_' . $request->id_siswa . '.' . $request->file('foto')->getClientOriginalExtension());

                $kegiatan->foto = $filename;
                $kegiatan->save();
            }
            if ($kegiatan) {
                return response()->json([
                    'success' => true,
                    'kegiatan' => $kegiatan,
                    ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => "Upload kegiatan gagal"
                ], 409);
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
        }else{
            $validator = Validator::make($request->all(),[
                'deskripsi' => 'required',
                'durasi' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    $validator->errors()
                ],422);
            }
            $kegiatan = Kegiatan::where('id',$id)->first();
            if ($request->hasFile('foto')) {
                $filename = $request->file('foto')->storeAs('foto_kegiatan', $request->id_absensi . '_' . $request->id_siswa . '.' . $request->file('foto')->getClientOriginalExtension());
                $photopath = $filename;
            }else{
                $photopath = $kegiatan->foto;
            }
            $kegiatan->deskripsi = $request->deskripsi;
            $kegiatan->durasi = $request->durasi;
            $kegiatan->foto = $photopath;
            $kegiatan->save();
            if ($kegiatan) {
                $kegiatans = Kegiatan::where('id',$id)->first();
                return response()->json([
                    'success' => true,
                    'kegiatan' => $kegiatans,
                    ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => "Ubah kegiatan gagal"
                ], 409);
            }
        }
    }

    public function delete(Request $request,$id){
        $token = User::where([
            'login_token' => $request->token
        ])->first();
        if ($request->token == null || !$token) {
            return response()->json([
                'message' => 'Unauthorization User'
            ],401);
        }else{
            Kegiatan::where('id',$id)->delete();
            return response()->json([
                'success'=>true,
                'message'=>'Berhasil menghapus data'
            ],200);
        }
    }
}
