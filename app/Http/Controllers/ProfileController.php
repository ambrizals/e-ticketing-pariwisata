<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Pengunjung;
use App\transaksi;
use Auth;
use Hash;
use Session;
use smsHelper;


class ProfileController extends Controller
{
	public function __construct(){
		return $this->middleware('auth');
	}
    public function show(){
    	$user = Auth::user();
		$data = Pengunjung::with(['getUser'])->where('user', $user->id)->first();
    	if($data == null){
    		return view('akun.panel.profile_unregistered');
    	} else {
			return view('akun.panel.profile', compact('user','data'));
    	}
	}
	public function store(Request $request){
		$data = new Pengunjung();
		$data->user = Auth::user()->id;
		$data->nama_pengunjung = $request->nama_pengunjung;
		$data->no_telepon = $request->no_telepon;
		$data->save();
		SMS::send([$request->no_telepon], trans('front.sms_registered_success'));
		Session::flash('messages', 'Your identity is saved!');
		return redirect()->route('front.profile.panel');
	}
    public function passwordChange(Request $request, $id){
		$user = User::where('id',$id)->with(['getPengunjung'])->first();
        if (Hash::check($request->password_lama, $user->password)) { 
	        if ($request->get('password_baru') == $request->get('konfirmasi_password')){
	            $user->password = bcrypt($request->get('konfirmasi_password'));
				$user->save();
				smsHelper::sendSMS($user->getPengunjung->no_telepon,'The password on your account has been successfully changed. if you dont feel you have changed the password in your account, please contact us. - wibisana');
                Session::flash('messages', 'Kata sandi berhasil dirubah !');
	            return redirect()->route('front.profile.panel');
	        } else{
	            return 'Password tidak sama';
	        }
        } else {
			Session::flash('messages', 'Kata sandi yang anda masukkan salah !');
			return redirect()->route('front.profile.panel');
        }
	} 
	public function update(Request $request){
		$data = Pengunjung::find(Auth::user()->getPengunjung->id);
		$data->user = Auth::user()->id;
		$data->nama_pengunjung = $request->nama_pengunjung;
		$data->no_telepon = $request->no_telepon;
		$data->save();
		Session::flash('messages', 'Anda berhasil mengubah data diri anda!');
		return redirect()->route('front.profile.panel');
	}
	public function transaction(){
		$data = transaksi::where('user',Auth::user()->id)->latest()->paginate(5);
		return view('akun.transaksi.list', compact('data'));
	}
}
