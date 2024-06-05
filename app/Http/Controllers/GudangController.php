<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class GudangController extends Controller
{
    public function gudang(Request $request){

        $gudang = Gudang::paginate(10);

        return view('gudang.gudang',compact('gudang'));
    }

    public function create()
    {
        return view('gudang.formgudang');
    }

    public function store(Request $request)
    {
        //
        $data = new Gudang();
        $data->kode = $request->get('kode');
        $data->nama = $request->get('nama');
        $data->alamat = $request->get('alamat');
        $data->keterangan = $request->get('keterangan');
        $data->save();
        return redirect()->route('gudang')->with('status','Hooray!! Your new item is already inserted');
    }

    public function edit($kode)
    {
        //
        $objGudang = Gudang::find($kode);

        $data = $objGudang;
        return view('gudang.formedit',compact('data'));
    }

    public function update(Request $request, $kode)
    {
        //
        $objGudang = Gudang::find($kode);
        $objGudang->kode = $request->get('kode');
        $objGudang->nama = $request->get('nama');
        $objGudang->alamat = $request->get('alamat');
        $objGudang->keterangan = $request->get('keterangan');
        $objGudang->save();
        return redirect()->route('gudang')->with('status','Your item is up-to-date');
    }

    public function destroy($kode)
    {
        //
        try{
            $objGudang = Gudang::find($kode);
            $objGudang->delete();
            return redirect()->route('gudang')->with('status','Deleted Successfully');
        }
        catch(\PDOException $ex){
            $msg = "Delete data failed. Make sure there is no correlated data before deleting!";
            return redirect()->route('gudang')->with('status',$msg);
        }
    }
}
