<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class FormulirController extends Controller
{
    public function show(Request $request,$id_siswa){
        $user = User::where([
            'login_token' =>$request->token
        ])->first();
        if ($request->token ==null || !$user) {
            return response()->json([
                'message' => 'Unauthorization User'
            ],401);
        }else{
            $absensi = Absensi::where('id_siswa', $id_siswa)->get();
            return response()->json([
                'absensi' => $absensi
            ],200);
        }
    }

    // public function filter(Request $request){
    //     $user = User::where([
    //         'login_token' => $request->token
    //     ])->first();

    //     if ($request->token ==null || !$user) {
    //         return response()->json([
    //             'message' => 'Unauthorization User'
    //         ],401);
    //     }

    //     $validator = Validator::make($request->all(), [
    //         'dari_tanggal' => 'required',
    //         'sampai_tanggal' => 'required',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json($validator->errors(), 422);
    //     }

    //     $absensi = Absensi::where('id_siswa', $user->siswa->id)
    //         ->whereBetween('tanggal', [$request->dari_tanggal, $request->sampai_tanggal])
    //         ->get();

    //     return response()->json([
    //         'absensi' => $absensi
    //     ], 200);
    // }

    public function add(Request $request){
        $user = User::where([
            'login_token' =>$request->token
        ])->first();
        if ($request->token ==null || !$user) {
            return response()->json([
                'message' => 'Unauthorization User'
            ],401);
        }else{
            $validator = Validator::make($request->all(), [
                'tanggal' => 'required',
                'status' => 'required',
                'id_siswa' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $absen = Absensi::create([
                'tanggal' => $request->tanggal,
                'status' => $request->status,
                'catatan' => $request->catatan,
                'id_siswa' => $request->id_siswa
            ]);
            if ($request->hasFile('bukti')) {
                $filename = $request->file('bukti')->storeAs('bukti', $request->tanggal . '_' . $request->id_siswa . '.' . $request->file('bukti')->getClientOriginalExtension());

                $absen->bukti = $filename;
                $absen->save();
            }

            if ($absen) {
                return response()->json([
                    'success' => true,
                    'absen' => $absen,
                    ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => "Upload kehadiran gagal"
                ], 409);
            }
        }
    }

    public function validasiAbsen(Request $request){
        $user = User::where([
            'login_token' =>$request->token
        ])->first();
        if ($request->token ==null || !$user) {
            return response()->json([
                'message' => 'Unauthorization User'
            ],401);
        }else{
            $user_id = auth()->guard('api')->user();
            $id_user = $user_id->id;
            $siswa = Siswa::where('id_user',$id_user)->first();
            $id_siswa = $siswa->id;
            $absensi = Absensi::where('id_siswa', $id_siswa)
                    ->where('tanggal', Carbon::today('Asia/Jakarta'))
                    ->first();
            if (!$absensi) {
                return response()->json([
                    'message' => 'Absensi masuk belum dilakukan hari ini'
                ], 400);
            }
        }
    }
}
