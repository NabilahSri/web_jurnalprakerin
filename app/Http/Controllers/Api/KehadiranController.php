<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Industri;
use App\Models\Kegiatan;
use App\Models\Monitoring;
use App\Models\Siswa;
use App\Models\Token;
use App\Models\TokenKeluar;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
// use Carbon\Carbon;


function getDistanceBetweenPoints($lat1, $lon1, $lat2, $lon2) {
    $theta = $lon1 - $lon2;
    $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
    $miles = acos($miles);
    $miles = rad2deg($miles);
    $miles = $miles * 60 * 1.1515;
    $feet  = $miles * 5280;
    $yards = $feet / 3;
    $kilometers = $miles * 1.609344;
    $meters = $kilometers * 1000;
    return compact('miles','feet','yards','kilometers','meters');
}

class KehadiranController extends Controller
{
    public function absensi(Request $request){
        $user_id = auth()->guard('api')->user();
        $id_user = $user_id->id;
        $siswa = Siswa::where('id_user',$id_user)->first();
        $id_siswa = $siswa->id;
        $monitoring = Monitoring::where('id_siswa',$id_siswa)->first();
        $id_industri = $monitoring->id_industri;
        $industri = Industri::where('id',$id_industri)->first();
        $latitude = $industri->latitude;
        $longitude = $industri->longitude;
        $alamat = $industri->alamat;

        $point1 = ([
            "latitude" => $latitude,
            "longitude" => $longitude
        ]);
        $point2 = ([
            "latitude" => $request->latitude,
            "longitude" => $request->longitude
        ]);
        $distance = getDistanceBetweenPoints($point1['latitude'], $point1['longitude'], $point2['latitude'], $point2['longitude']);
        $distances = $distance['meters'];

        $user = User::where([
            'login_token' =>$request->token
        ])->first();
        if ($request->token ==null || !$user) {
            return response()->json([
                'message' => 'Unauthorization User'
            ],401);
        }else{

            $mode = $request->mode;
            $tokenMasuk = Token::orderBy('created_at','desc')->first();
            $currentTime = Carbon::now('Asia/Jakarta');

            if ($mode == "Lokasi") {
                if ($distances > 500) {
                    return response()->json([
                        'message' => 'Anda berada di luar zona kehadiran',
                        'latitude' => $point2['latitude'],
                        'longitude' => $point2['longitude'],
                        'distances' => $distances,
                    ], 403);
                }
            }

            if ($mode == "Token") {
                if ($request->token_masuk != $tokenMasuk->token_masuk) {
                    return response()->json([
                        'message' => 'Token tidak sesuai!'
                    ], 401);
                }

                if ($currentTime > $tokenMasuk->kadaluarsa_pada) {
                    return response()->json([
                        'message' => 'Token expired!'
                    ], 404);
                }
            }

                $absensiMasuk = Absensi::where('id_siswa', $id_siswa)
                    ->where('tanggal', $request->tanggal)
                    ->first();

                // if ($absensiMasuk && $absensiMasuk->jam_masuk) {
                //     return response()->json([
                //         'message' => 'Anda sudah melakukan absensi masuk hari ini'
                //     ], 400);
                // }

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
                    'jam_masuk' => $request->jam_masuk,
                    'status' => $request->status,
                    'id_siswa' => $request->id_siswa
                ]);
                if ($absen) {
                    return response()->json([
                        'success' => true,
                        'absen' => $absen,
                        'distances' => $distances,
                        'absensiMasuk' => $absensiMasuk
                    ], 201);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => "Upload kehadiran gagal"
                    ], 409);
                }

        }
    }

    public function absensiPulang(Request $request)
    {
        $user_id = auth()->guard('api')->user();
        $id_user = $user_id->id;
        $siswa = Siswa::where('id_user',$id_user)->first();
        $id_siswa = $siswa->id;
        $monitoring = Monitoring::where('id_siswa',$id_siswa)->first();
        $id_industri = $monitoring->id_industri;
        $industri = Industri::where('id',$id_industri)->first();
        $latitude = $industri->latitude;
        $longitude = $industri->longitude;
        $alamat = $industri->alamat;

        $point1 = ([
            "latitude" => $latitude,
            "longitude" => $longitude
        ]);
        $point2 = ([
            "latitude" => $request->latitude,
            "longitude" => $request->longitude
        ]);
        $distance = getDistanceBetweenPoints($point1['latitude'], $point1['longitude'], $point2['latitude'], $point2['longitude']);
        $distances = $distance['meters'];

        $user = User::where([
            'login_token' => $request->token
        ])->first();
        if ($request->token == null || !$user) {
            return response()->json([
                'message' => 'Unauthorization User'
            ], 401);
        }else{
            $mode = $request->mode;
            $tokenMasuk = TokenKeluar::orderBy('created_at','desc')->first();
            $currentTime = Carbon::now('Asia/Jakarta');

            if ($mode == "Lokasi") {
                if ($distances > 500) {
                    return response()->json([
                        'message' => 'Anda berada di luar zona kehadiran',
                        'latitude' => $point2['latitude'],
                        'longitude' => $point2['longitude'],
                        'distances' => $distances,
                    ], 403);
                }
            }

            if ($mode == "Token") {
                if ($request->token_masuk != $tokenMasuk->token_masuk) {
                    return response()->json([
                        'message' => 'Token tidak sesuai!'
                    ], 401);
                }

                if ($currentTime > $tokenMasuk->kadaluarsa_pada) {
                    return response()->json([
                        'message' => 'Token expired!'
                    ], 404);
                }
            }

                $validator = Validator::make($request->all(), [
                    'jam_pulang' => 'required',
                ]);
                if ($validator->fails()) {
                    return response()->json($validator->errors(), 422);
                }
                $absensi = Absensi::where('id_siswa', $id_siswa)
                    ->where('tanggal', $request->tanggal)
                    ->first();
                if (!$absensi) {
                    return response()->json([
                        'message' => 'Absensi masuk belum dilakukan hari ini'
                    ], 400);
                }
                $absenPulang = Absensi::where('id_siswa', $id_siswa)
                        ->where('tanggal', $request->tanggal)
                        ->update([
                            'jam_pulang' => $request->jam_pulang
                        ]);
                if ($absenPulang) {
                    return response()->json([
                        'message' => 'Absensi pulang berhasil diupdate',
                        'absensi' => $absenPulang
                    ], 200);
                }else {
                    return response()->json([
                        'success' => false,
                        'message' => "Absen pulang gagal di update"
                    ], 409);
                }
        }

    }

    public function dashboard(Request $request,$id){
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
            $siswa = Siswa::where('id_user',$id_user)->with('kelas')->first();
            $id_siswa = $siswa->id;
            $Kehadiran_hadir = Absensi::where('id_siswa',$id_siswa)->where('status','hadir')->count();
            $Kehadiran_izin = Absensi::where('id_siswa',$id_siswa)->where('status','izin')->count();
            $Kehadiran_sakit = Absensi::where('id_siswa',$id_siswa)->where('status','sakit')->count();
            $kegiatan = Kegiatan::where('id_siswa',$id_siswa)->get();
            $total_menit = $kegiatan->sum('durasi');
            $total_jam = floor($total_menit / 60);
            $remaining_menit = $total_menit % 60;
            if ($siswa) {
                $siswaWithFoto =[
                    'name' => $siswa->name,
                    'kelas' => $siswa->kelas->kelas,
                    'foto' => $siswa->foto ? asset('storage/' . $siswa->foto) : null,
                ];
                return response()->json([
                    'siswa'=>$siswaWithFoto,
                    'hadir'=>$Kehadiran_hadir,
                    'izin'=>$Kehadiran_izin,
                    'sakit'=>$Kehadiran_sakit,
                    'total_jam_kerja' => [
                        'jam' => $total_jam,
                        'menit' => $remaining_menit,
                    ],
                ],200);
            }else{
                return response()->json([
                    'message' => 'User not found'
                ],404);
            }

        }
    }

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
            $kehadiran = Absensi::where('id_siswa',$id_siswa)->where('status','hadir')->orderBy('tanggal','desc')->get();
            return response()->json([
                'kehadiran' => $kehadiran
            ],200);
        }
    }
}
