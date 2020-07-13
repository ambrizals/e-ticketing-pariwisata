<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use App\User;
use App\Karyawan;
use smsHelper;

class ProfileController extends Controller
{
    public function show(){
    	$user = Auth::user();
    	$data = Karyawan::where('user', $user->id)->first();
    	if($data == null){
			return view('admin.profile_unregister', compact('user'));
    	} else {
			return view('admin.profile', compact('data','user'));
    	}
    }
    public function store(Request $request){
    	$user = Auth::user();
    	$data = new Karyawan();
    	$data->user = $user->id;
    	$data->nama_karyawan = $request->nama_karyawan;
    	$data->no_telepon = $request->no_telepon;
    	$data->alamat = $request->alamat;
    	$data->foto = '';
    	$data->save();
    	return redirect()->route('admin.profile');
    }
    public function update(Request $request, $id){
    	$data = Karyawan::find($id);
    	$data->nama_karyawan = $request->nama_karyawan;
    	$data->no_telepon = $request->no_telepon;
    	$data->alamat = $request->alamat;
    	$data->foto = '';
    	$data->update();
    	return redirect()->route('admin.profile');
    }
    public function passwordChange(Request $request, $id){
		$user = User::where('id',$id)->with(['getKaryawan'])->first();
        if (Hash::check($request->password_lama, $user->password)) { 
	        if ($request->get('password_baru') == $request->get('konfirmasi_password')){
	            $user->password = bcrypt($request->get('konfirmasi_password'));
				$user->save();
				smsHelper::sendSMS($user->getKaryawan->no_telepon,'Kata sandi akses pada akun wibisana anda telah diganti.');
				// $sms = SMS::send(, 'Kata sandi akses pada akun wibisana anda telah diganti.');
				// if ($sms['code'] == 400){
				// 	Twilio::message('+628115349997', 'Kata sandi akses pada akun wibisana anda telah diganti.');
				// }
                Session::flash('messages', 'Kata sandi berhasil dirubah !');
	            return redirect()->route('admin.profile');
	        } else{
	            return 'Password tidak sama';
	        }
        } else {
			Session::flash('messages', 'Kata sandi yang anda masukkan salah !');
			return redirect()->route('admin.profile');
        }
    } 
}
