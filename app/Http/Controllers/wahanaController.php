<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wahana;
use App\gambar_wahana as Gambar;
use App\pengaturan;

class wahanaController extends Controller
{
    public function detailWahana($slug){
        $wahana = Wahana::with(['getGambar' => function($query){
            return $query->first();
        }])->where('urlslug',$slug)->first();
        $gambar = Gambar::where('wahana',$wahana->id)->get();
        $firstimages = Gambar::where('wahana',$wahana->id)->first();
        return view('wahana', compact('wahana','gambar','firstimages','pengaturan'));
    }
    public function katalog(){
        $wahana = Wahana::with(['getGambar' => function($query){
            // return $query->latest();
        }])->latest()->get();
        $pengaturan = $this->pengaturan;
        return view('katalog', compact('wahana','pengaturan'));
    }
}
