<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Wahana;
use Facades\Yugo\SMSGateway\Interfaces\SMS;
use Twilio;

class halamanController extends Controller
{
	public function index(){
        $wahana = Wahana::with(['getGambar' => function($query){
            // return $query->latest();
        }])->latest()->get();
	    return view('beranda', compact('wahana', 'pengaturan'));
	}
	public function sms(){
		// return SMS::send(['0811111234'], 'Hello, world!');
		// $sms = Twilio::message('+628115349997', 'Pink Elephants and Happy Rainbows');
		// dd($sms);
	}
}
