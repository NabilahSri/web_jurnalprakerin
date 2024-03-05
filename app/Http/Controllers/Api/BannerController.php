<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\User;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function show(Request $request){
        $user = User::where([
            'login_token' =>$request->token
        ])->first();
        if ($request->token ==null || !$user) {
            return response()->json([
                'message' => 'Unauthorization User'
            ],401);
        }else{
            $banner = Banner::all();
            foreach ($banner as $banners) {
                if ($banners->gambar) {
                    $banners->gambar = $banners->gambar ? asset('storage/' . $banners->gambar) : null;
                }
            }
            return response()->json([
                'banner' => $banner
            ]);

            return response()->json([
                'banners' =>$banners
            ],200);
        }
    }
}
