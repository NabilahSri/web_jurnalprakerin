<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function show(){
        $data['banner'] = Banner::all();
        return view('pages.banner',$data);
    }


    public function create(Request $request){

         if ($request->hasFile('gambar')) {
            $photoPath = $request->file('gambar')->storeAs('gambar_banner', $request->name . '.' . $request->file('gambar')->getClientOriginalExtension());
        } else {
            $photoPath = null;
        }
        $tanggal = Carbon::now('Asia/Jakarta');
        Banner::create([
            'name' => $request->name,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $tanggal,
            'gambar' => $photoPath,
        ]);

        return redirect('/banner');
    }

    public function delete(Request $req){
        $banner = Banner::find($req->id);

        $deleted = Banner::where('id', $req->id)->delete();

        if ($deleted) {
            if ($banner->gambar) {
                Storage::delete('gambar_banner/' . $banner->gambar);
            }
        }
        return redirect('/banner');
    }

    public function edit(Request $request, $id)
    {
        $tanggal = Carbon::now('Asia/Jakarta');
        $banner = Banner::find($id);
        $bannerData = [
            'name' => $request->name,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $tanggal,
        ];

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($banner->gambar) {
                Storage::delete($banner->gambar);
            }

            // Simpan gambar baru ke direktori penyimpanan yang sesuai
            $photoPath = $request->file('gambar')->storeAs('gambar_banner', $request->name . '.' . $request->file('gambar')->getClientOriginalExtension());

            // Update path gambar di database
            $bannerData['gambar'] = $photoPath;
        }

        Banner::where('id', $id)->update($bannerData);
        return redirect('/banner');
    }
}
