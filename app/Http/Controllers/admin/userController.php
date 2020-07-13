<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Hash;
use smsHelper;
use DataTables;
use Response;

class userController extends Controller
{
    public function index(){
        return view('admin.user.index');
    }

    public function tableUser(){
        $item = User::latest();
        return DataTables::of($item)
                ->addColumn('action', function($data){
                    return view('admin.user.ajax.action_index', compact('data'));
                })->make(true);
    }
    public function store(Request $request){
        $item = new User;
        $item->name = $request->name;
        $item->email = $request->email;
        $item->password = bcrypt($request->password);
        if ($item->save()){
            return Response::json('success', 200);
        } else {
            return Response::json('error', 400);
        }
    }

    public function show($id){
        $item = User::find($id);
        return Response::json($item,200);
    }

    public function update(Request $request, $id){
        $item = User::find($id);
        $item->update($request->all());
        if ($item) {
            return Response::json('success',200);
        } else {
            return Response::json('fail',400);
        }
    }

    public function updatePassword(Request $request, $id){
        $user = User::where('id',$id)->with(['getPengunjung','getKaryawan'])->first();
        if (($user->getPengunjung) or ($user->getKaryawan)){
            if ($request->new_password == $request->confirm_password) { 
                $user->password = bcrypt($request->confirm_password);
                if($user->getPengunjung) {
                    smsHelper::sendSMS($user->getPengunjung->no_telepon, 'Your user password in '. getenv('APP_NAME'). ' has been changed to '.$request->confirm_password.' by system administrator');
                } elseif($user->getKaryawan){
                    smsHelper::sendSMS($user->getKaryawan->no_telepon, 'Your user password in '. getenv('APP_NAME'). ' has been changed to '.$request->confirm_password.' by system administrator');
                }
                if ($user->save()){
                    return Response::json('success',200);
                } else {
                    return Response::json('fail',400);
                }
            } else {
                return Response::json('CONFIRM_FAIL',400);
            }
        } else {
            return Response::json('UNREGISTER_PHONE',400);
        }
    }

    public function destroy($id){
        $item = User::find($id);
        $item->delete();
        if (!$item){
            return Response::json('error', 400);
        } else {
            return Response::json('success', 200);
        }
    }
}
