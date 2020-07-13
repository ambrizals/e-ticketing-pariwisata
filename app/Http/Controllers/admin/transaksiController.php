<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\transaksi;
use App\transaksi_paytransfer;
use App\bank;
use App\Pengunjung;
use transaksiHelper;
use DataTables;
use Session;
use Carbon\Carbon;
use smsHelper;

class transaksiController extends Controller
{
    public function index(){
        return view('admin.transaksi.index');
    }

    public function tableTransaksi(Request $request){
        if($request->has('cod')) {
            $data = transaksi::with(['getPengunjung'])->where('jenis_pembayaran',1)->where('status','1')->latest();
        } elseif($request->has('transfer')){
            $data = transaksi::with('getPengunjung')->whereHas('getTransaksipaytransfer', function($query){
                $query->where('status','=','2');
            })->where('jenis_pembayaran',2)->where('status','1')->latest();
        } elseif($request->has('listTunai')){
            $data = transaksi::with(['getPengunjung'])->where('jenis_pembayaran',1)->latest();
        }
        elseif($request->has('listTransfer')){
            $data = transaksi::with(['getPengunjung'])->where('jenis_pembayaran',2)->latest();
        } else {
            $data = transaksi::with(['getPengunjung'])->latest();
        }
        return DataTables::of($data)
                ->editColumn('id', function($data){
                    if($data->status == 2){
                        $dtID_msg = '<span class="badge badge-primary">Paid</span>';
                    } elseif ($data->status == 1) {
                        $dtID_msg = '<span class="badge badge-danger">Unpaid</span>';
                    } elseif ($data->status == 0) {
                        $dtID_msg = '<span class="badge badge-secondary">Cancel</span>';
                    }
                    return 'TRX-'.$data->id .' '. $dtID_msg;
                })
                ->addColumn('action', function($data){
                    return view('admin.transaksi.ajax.action_index', compact('data'));
                })->rawColumns(['id','action'])->make(true);
    }
    public function show($id){
        $transaksi = transaksi::with(['getPengunjung','getTransaksipaytransfer','getTicket'])->find($id);
        // dd($transaksi);
        $trx['status'] = transaksiHelper::checkStatus($transaksi->status);
        $trx['payment'] = transaksiHelper::checkPayment($transaksi->jenis_pembayaran);        
        return view('admin.transaksi.show', compact('transaksi','trx'));
    }
    public function update($id){

    }
    public function destroy($id){

    }
    public function payCOD(Request $request, $id){
        $transaksi = transaksi::find($id);
        $calculate = $transaksi->total_bayar - $request->jumlah_bayar;
        if ($calculate > 0) {
            Session::flash('messages', 'Jumlah yang dibayarkan kurang dari total pembayaran');
            return redirect()->route('transaksi.show', $id);
        } else {
            $transaksi->jumlah_bayar = $request->jumlah_bayar;
            $transaksi->kembalian = $calculate * -1;
            $transaksi->status = 2;
            $save = $transaksi->save();
            if ($save){
                smsHelper::sendSMS($transaksi->getPengunjung->no_telepon, 'Your transaction is paid by counter.');
                Session::flash('messages', 'Transaksi telah diselesaikan !');
                return redirect()->route('transaksi.show', $id);
            } else {
                Session::flash('messages', 'Terjadi kesalahan!');
                return redirect()->route('transaksi.show', $id);
            }
        }
    }

    public function payTransfer(Request $request, $id){
        $transaksi = transaksi::find($id);
        $calculate = $transaksi->total_bayar - $transaksi->getTransaksipaytransfer->jumlah_transfer;
        if ($calculate > 0){
            Session::flash('messages', 'Jumlah yang dibayarkan kurang dari total pembayaran');
            return redirect()->route('transaksi.show', $id);            
        } else {
            $paytransfer = transaksi_paytransfer::where('transaksi',$id)->first();
            $paytransfer->status = 3;
            if ($paytransfer->save()) {
                $kembalian = $calculate * -1;
                $transaksi->kembalian = $kembalian;
                $transaksi->status = 2;
                $transaksi->getTransaksipaytransfer->status = 3;
                $save = $transaksi->save();
                if ($save) {
                    smsHelper::sendSMS($transaksi->getPengunjung->no_telepon, 'Your bank transfer to pay transaction #'.$transaksi->id.' is confirmed by counter');
                    Session::flash('messages', 'Transaksi telah diselesaikan !');
                    return redirect()->route('transaksi.show', $id);                
                } else {
                    Session::flash('messages', 'Terjadi kesalahan!');
                    return redirect()->route('transaksi.show', $id);                
                }
            } else {
                Session::flash('messages', 'Terjadi kesalahan!');
                return redirect()->route('transaksi.show', $id);     
            }
        }
    }
}
