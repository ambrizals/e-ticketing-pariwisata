<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\User;
use App\Pengunjung;
use App\Karyawan;
use Facades\Yugo\SMSGateway\Interfaces\SMS;
use App;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function sendResetLinkEmail(Request $request)
    {
        // $this->validateEmail($request);

        // $response = $this->broker()->sendResetLink(
        //     $request->only('username')
        // );

        // return $response == Password::RESET_LINK_SENT
        //             ? $this->sendResetLinkResponse($response)
        //             : $this->sendResetLinkFailedResponse($request, $response);
        $newPassword = rand(100000,999999);
        $flag = 0;
        $pengunjung = Pengunjung::where('no_telepon',$request->no_telepon)->first();
        if ($pengunjung == null){
            $karyawan = Karyawan::where('no_telepon',$request->no_telepon)->first();
            if($karyawan == null){
                App::abort(500,'Your user account is not found');
            } else {
                $user = User::where('id',$karyawan->user)->first();
                $user->password = bcrypt($newPassword);
                $save = $user->save();
                if ($save) {    
                    SMS::send([$request->no_telepon],'Password anda telah direset menjadi : '.$newPassword);
                    return view('auth.reset_sms_success');
                } else {
                    App::abort(500);
                }
            }
        } else {
            $user = User::where('id',$pengunjung->user)->first();
            $user->password = bcrypt($newPassword);
            $save = $user->save();
            if ($save) {    
                SMS::send([$request->no_telepon],'Password anda telah direset menjadi : '.$newPassword);
                return view('auth.reset_sms_success');
            } else {
                App::abort(500);
            }
        }
    }
}
