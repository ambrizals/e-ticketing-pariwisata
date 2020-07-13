<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\cart;
use App\bank;
use App\User;
use Auth;
use Response;

class cartController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}
    public function index(Request $request){
        $user = 
    	$cart = cart::with('getWahana')->where('user', Auth::user()->id)->get();
    	$itemCount = [
    		'qty' => 0,
			'total' => 0
    	];
    	if ($request->has('quicklook')){
    		return view('cart.quicklook_v2', compact('cart', 'itemCount'));
    	} elseif ($request->has('count')) {
    		foreach ($cart as $item) {
    			$itemCount['qty'] = $itemCount['qty'] + $item->qty;    			
    		}
    		return $itemCount['qty'];
    	} else  {
            if ($cart->count() == 0){
                return view('cart.index_empty');
            } else {
				$bank = bank::where('status','1')->get();
                return view('cart.index', compact('cart', 'itemCount','bank'));            
            }
    	}
    }
    public function store(Request $request){
        $user = User::with('getPengunjung')->where('id', Auth::user()->id)->first();
			if (!$user->getPengunjung == null){
			$cart_base = cart::where('wahana', $request->wahana)->where('user', Auth::user()->id)
								->first();
			if($cart_base == null) {
				$cart = new cart();
				$cart->user = Auth::user()->id;
				$cart->wahana = $request->wahana;
				$cart->qty = $request->qty;
				$save = $cart->save();
				if ($save){
					return Response::json('success',200);
				} else {
					return Response::json('error', 400);
				}
			} else {
				$cart_base->qty = $cart_base->qty + $request->qty;
				if ($cart_base->save()){
					return Response::json('success',200);
				} else {
					return Response::json('error', 400);
				}
			}
        } else {
            $url = route('front.profile.panel');
            return Response::json($url, 300);
        }
    }
    public function update(Request $request, $id){
        $cart = cart::find($id);
        $cart->qty = $request->qty;
        $save = $cart->save();
        if ($save){
            return Response::json('success',200);
        } else {
            return Response::json('error',400);
        }
    }
    public function destroy($id){
        $item = cart::find($id);
        $delete = $item->delete();
        if ($item){
            return Response::json('success', 200);
        } else {
            // return redirect()->route('wahana.index');
            return Response::json('error', 400);
        }        
    }
}
