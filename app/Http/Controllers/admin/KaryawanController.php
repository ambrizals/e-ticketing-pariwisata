<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Karyawan;
use DataTables;
use Response;


class KaryawanController extends Controller
{
    public function index(){
        return view('admin.karyawan.index');
    }
    public function store(Request $request){
        $item = Karyawan::create($request->all());
        if (!$item){
            return Response::json('error', 500);
        } else {
            return Response::json('success', 200);
        }
    }
    public function show($id){
        $item = Karyawan::find($id);
        return Response::json($item,200);
    }
    public function update(Request $request, $id){
        $item = Karyawan::find($id);
        $item->update($request->all());
        if ($item) {
            return Response::json('success',200);
        } else {
            return Response::json('fail',400);
        }
    }
    public function destroy($id){
        $item = Karyawan::find($id);
        $item->delete();
        if (!$item){
            return Response::json('error', 400);
        } else {
            // return redirect()->route('wahana.index');
            return Response::json('success', 200);
        }
    }
    public function daftarKaryawan() {
        $data = Karyawan::latest()->get();
        return DataTables::of($data)
                ->addColumn('action', function($item){
                    return view('datatables.admin.karyawan.action', compact('item'));
                })
                ->make('true');
    }
}
