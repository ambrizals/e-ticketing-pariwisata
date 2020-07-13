<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\transaksi;
use App\transaksi_paytransfer;
use App\eticket;
use App\cart;
use App\User;
use Auth;
use transaksiHelper;
use Response;
use App;
use smsHelper;

class transaksiController extends Controller
{
    public function store(Request $request){
        $user = User::with('getPengunjung')->where('id',Auth::user()->id)->first();
        $cart = cart::with('getWahana')->where('user',Auth::user()->id)->get();
        if ($cart->count() > 0) {
            $count['total_bayar'] = 0;
            foreach($cart as $count){
                $count['total_bayar'] = $count['total_bayar'] + ($count->getWahana->biaya_wahana * $count->qty);
            }
            $transaksi = new transaksi;
            $transaksi->user = Auth::user()->id;
            $transaksi->pengunjung = $user->getPengunjung->id;
            $transaksi->tanggal_booking = $request->tanggal_booking;
            $transaksi->jenis_pembayaran = $request->jenis_pembayaran;
            $transaksi->total_bayar = $count['total_bayar'];
            $transaksi->status = 1;
            $save = $transaksi->save();
            if ($save) {
                $newTransaksi = transaksi::where('user', Auth::user()->id)->latest()->limit(1)->first();
                if ($newTransaksi->jenis_pembayaran == 2){
                    $paytransfer = new transaksi_paytransfer();
                    $paytransfer->transaksi = $newTransaksi->id;
                    $paytransfer->bank = $request->bank;
                    $paytransfer->status = 1;
                    $paytransfer->save();
                }
                if ($newTransaksi->status == 1){
                    foreach($cart as $item) {
                        $eticket = new eticket;
                        $eticket->transaksi = $newTransaksi->id;
                        $eticket->wahana = $item->wahana;
                        $eticket->qty = $item->qty;
                        $eticket->harga = $item->getWahana->biaya_wahana;
                        $eticket->total = $item->qty * $item->getWahana->biaya_wahana;
                        $saveTiket = $eticket->save();
                        if ($saveTiket) {
                            cart::find($item->id)->delete();
                        }
                    }
                } else {
                    App::abort(500);
                }

            } else {
                App::abort(500);
            }
            if ($newTransaksi->jenis_pembayaran == 1){
                smsHelper::sendSMS($newTransaksi->getPengunjung->no_telepon, 'Your transaction #'.$newTransaksi->id.' can be paid through a counter, please make a  make a payment before '.$newTransaksi->tanggal_booking.'.');
                return view('akun.transaksi.success_cod', compact('newTransaksi'));
            } elseif ($newTransaksi->jenis_pembayaran == 2){
                $msgPaytransfer = 'Your transaction #'.$newTransaksi->id.' can be paid by bank transfer ('.$newTransaksi->getTransaksipaytransfer->getBank->nama_bank.' - '.$newTransaksi->getTransaksipaytransfer->getBank->nama_rekening.' - '.$newTransaksi->getTransaksipaytransfer->getBank->nomor_rekening.'), please make a  make a payment before '.$newTransaksi->tanggal_booking.'.';
                smsHelper::sendSMS($newTransaksi->getPengunjung->no_telepon, $msgPaytransfer);
                return view('akun.transaksi.success_banktransfer', compact('newTransaksi', 'msgPaytransfer'));
            } else {
                App::abort(500,'Something wrong when saving your transaction');
            }
        } else {
            App::abort(500,'Upss your cart is empty');
        }
    } 
    public function show($id){
        $transaksi = transaksi::with(['getTicket','getPengunjung','getTransaksipaytransfer'])->find($id);
        $trx['status'] = transaksiHelper::checkStatus($transaksi->status);
        $trx['payment'] = transaksiHelper::checkPayment($transaksi->jenis_pembayaran);
        return view('akun.transaksi.show', compact('transaksi', 'trx'));
    }
    public function form_confirmTransfer($id){
        $paytransfer = transaksi_paytransfer::with(['getBank','getTransaksi'])->where('transaksi',$id)->first();
        return Response::json($paytransfer);
    }
    public function confirmTransfer(Request $request, $id){
        $paytransfer = transaksi_paytransfer::with(['getTransaksi'])->where('transaksi',$id)->first();
        $paytransfer->jumlah_transfer = $request->jumlah_transfer;
        $paytransfer->tanggal_transfer = $request->tanggal_transfer;
        $paytransfer->status = 2;
        $save = $paytransfer->save();
        if ($save) {
            smsHelper::sendSMS($paytransfer->getTransaksi->getPengunjung->no_telepon, 'Your transaction #'.$paytransfer->getTransaksi->id.'  is waiting for a bank transfer confirmation by the counter.');
            return response()->json('success',200);
        } else {
            return response()->json('error',400);
        }
    }
}
