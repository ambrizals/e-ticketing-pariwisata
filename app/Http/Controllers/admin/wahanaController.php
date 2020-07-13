<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Requests\uploadGambarWahanaRequest as uploadGambar;
use App\Wahana;
use App\Gambar_Wahana as Gambar;
use Validator;
use Response;
use App;
use Image;
use DataTables;
use Session;

class wahanaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.wahana.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $urlslug = [
            'urlslug' => str_slug($request->nama_wahana,'-')
        ];
        $item = Wahana::create(array_merge($request->all(),$urlslug));
        if (!$item){
            return Response::json('error', 500);
        } else {
            return Response::json('success', 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Wahana::find($id);
        return view('admin.wahana.edit', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Wahana::find($id);
        $item->update($request->all());
        if ($item){
            Session::flash('messages', 'Data wahana berhasil diubah!');
            return redirect()->route('wahana.show',$id);
        } else {
            Session::flash('messages', 'Data wahana tidak berhasil diubah!');
            return redirect()->route('wahana.show',$id);
        }
    }
    public function uploadGambar(uploadGambar $request, $id){
        $input = $request->all();
    
        // $validation = Validator::make($input, $rules);
        // if ($validation->fails())
        // {
        //     return Response::make($validation->errors->first(), 400);
        // }
    
        $file               = Input::file('file');
        $destinationPath    = 'uploads/wahana';
    
        // Get real extension according to mime type
        $ext                = $file->guessClientExtension();  
    
        // Client file name, including the extension of the client
        $fullname           = $file->getClientOriginalName(); 
    
        // Hash processed file name, including the real extension
        $hashname           = date('H.i.s').'-'.md5($fullname).'.'.$ext; 
        $thumbnails         = Image::make($file)->resize(340, 260)->save('uploads/thumbs/wahana/'.$hashname);
        $upload_success     = Image::make($file)->resize(1366, 910)->save($destinationPath.'/'.$hashname);
        $models             = new Gambar;
        $models->wahanagambar_filename   = $hashname;
        $models->wahana = $id;
        $models->wahanagambar_type    = 'full';
        $models->save();
    
        if( $upload_success ) {
           return Response::json('success', 200);
        } else {
           return Response::json('error', 400);
        }  
        return response()->json(['success'=>$imageName]);
    }

    public function gambarWahana($id){
        $gambar = Gambar::where('wahana',$id)->latest()->paginate(8);
        return view('admin.wahana.ajax.daftarGambar', compact('gambar'));
    }
    public function deletegambar($wahana,$id){
        $gambar = Gambar::find($id);
        unlink('uploads/wahana/'.$gambar->wahanagambar_filename);
        unlink('uploads/thumbs/wahana/'.$gambar->wahanagambar_filename);
        Gambar::find($id)->delete();
    }
    public function ambilGambar($wahana,$id){
        $gambar = Gambar::find($id);
        $gambarPath = 'uploads/wahana/'.$gambar->wahanagambar_filename;
        return '<img src="'.asset($gambarPath).'" />';
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteAllGambar($id){
        $gambar = Gambar::where('wahana',$id)->get();
        foreach ($gambar as $key => $value) {
            unlink('uploads/wahana/'.$value->wahanagambar_filename);
            unlink('uploads/thumbs/wahana/'.$value->wahanagambar_filename);
            Gambar::find($value->id)->delete();
        }
        return Response::json('success',200);
    }
    public function destroy($id)
    {
        $item = Wahana::find($id);
        $item->delete();
        if (!$item){
            return Response::json('error', 400);
        } else {
            // return redirect()->route('wahana.index');
            return Response::json('success', 200);
        }
    }
    public function daftarWahana(){
        $item = Wahana::latest()->get();
        return Datatables::of($item)
                        ->addColumn('action', function($item){
                            return view('datatables.admin.wahana.action', compact('item'));
                        })
                        ->make(true);
    }
}
