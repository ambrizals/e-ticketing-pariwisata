<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pengunjung;
use Datatables;

class PengunjungController extends Controller
{
    public function index(){
        return view('admin.pengunjung.index');
    }
    public function store(Request $request){
        $item = Pengunjung::create($request->all());
        if (!$item){
            return Response::json('error', 500);
        } else {
            return Response::json('success', 200);
        }
    }
    public function show($id){

    }
    public function update(Request $request, $id){

    }
    public function destroy($id){

    }
    public function daftarPengunjung() {

    }
}
