<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\bank;
use Response;
use DataTables;

class bankController extends Controller
{
    public function index(){
        return view('admin.bank.index');
    }
    public function tableBank(){
        $bank = bank::get();
        return DataTables::of($bank)
                // ->editColumn('status', function($data){
                //     if($data->status == 1) {
                //         return 'Open';
                //     } elseif ($data->status == 2) {
                //        return 'Closed';
                //     } else {
                //         return 'Unknown';
                //     }
                // })
                ->addColumn('action', function($data){
                    return view('admin.bank.ajax.action', compact('data'));
                })->make('true');
    }
    public function store(Request $request){    
        $bank = bank::create($request->all());
        if ($bank) {
            return Response::json('success',200);
        } else {
            return Response::json('fail',400);
        }
    }

    public function update(Request $request, $id){
        $item = bank::find($id);
        $item->update($request->all());
        if ($item) {
            return Response::json('success',200);
        } else {
            return Response::json('fail',400);
        }
    }

    public function show($id){
        $item = bank::find($id);
        return Response::json($item,200);
    }

    public function destroy($id){
        $item = bank::find($id);
        $item->delete();
        if (!$item){
            return Response::json('error', 400);
        } else {
            // return redirect()->route('wahana.index');
            return Response::json('success', 200);
        }
    }
}
