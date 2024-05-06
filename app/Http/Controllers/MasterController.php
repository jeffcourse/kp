<?php

namespace App\Http\Controllers;

use App\Models\Master;
use App\Models\Divisi;
use App\Models\Gudang;
use App\Models\Jenis;
use App\Models\Type;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function master(){
        $master = Master::all();
        $divisi = Divisi::all();
        $gudang = Gudang::all();
        $jenis = Jenis::all();
        $type = Type::all();

        return view('master.master',compact('master','divisi','gudang','jenis','type'));
    }

    public function create()
    {
        $divisi = Divisi::all();
        $gudang = Gudang::all();
        $jenis = Jenis::all();
        $type = Type::all();

        return view('master.formmaster',compact('divisi','gudang','jenis','type'));
    }

    public function store(Request $request)
    {
        //
        $data = new Master();
        $data->kode_brg = $request->get('kode_brg');
        $data->nama_brg = $request->get('nama_brg');
        $data->kode_divisi = $request->get('select_divisi');
        $data->kode_jenis = $request->get('select_jenis');
        $data->kode_type = $request->get('select_type');
        $data->packing = $request->get('packing');
        $data->quantity = $request->get('quantity');
        $data->hrg_jual = $request->get('hrg_jual');
        $data->hrg_jual_total = $request->get('hrg_jual_total');
        $data->kode_gudang = $request->get('select_gudang');
        $data->keterangan = $request->get('keterangan');
        $data->save();
        return redirect()->route('master')->with('status','Hooray!! Your new item is already inserted');
    }

    public function edit($kode_brg)
    {
        //
        $objMaster = Master::find($kode_brg);
        $divisi = Divisi::all();
        $gudang = Gudang::all();
        $jenis = Jenis::all();
        $type = Type::all();

        $data = $objMaster;
        return view('master.formedit',compact('data','divisi','gudang','jenis','type'));
    }

    public function update(Request $request, $kode_brg)
    {
        //
        $objMaster = Master::find($kode_brg);
        $objMaster->kode_brg = $request->get('kode_brg');
        $objMaster->nama_brg = $request->get('nama_brg');
        $objMaster->kode_divisi = $request->get('select_divisi');
        $objMaster->kode_jenis = $request->get('select_jenis');
        $objMaster->kode_type = $request->get('select_type');
        $objMaster->packing = $request->get('packing');
        $objMaster->quantity = $request->get('quantity');
        $objMaster->hrg_jual = $request->get('hrg_jual');
        $objMaster->hrg_jual_total = $request->get('hrg_jual_total');
        $objMaster->kode_gudang = $request->get('select_gudang');
        $objMaster->keterangan = $request->get('keterangan');
        $objMaster->save();
        return redirect()->route('master')->with('status','Your item is up-to-date');
    }

    public function destroy($kode_brg)
    {
        //
        try{
            $objMaster = Master::find($kode_brg);
            $objMaster->delete();
            return redirect()->route('master')->with('status','Deleted Successfully');
        }
        catch(\PDOException $ex){
            $msg = "Delete data failed. Make sure there is no correlated data before deleting!";
            return redirect()->route('master')->with('status',$msg);
        }
    }
}
