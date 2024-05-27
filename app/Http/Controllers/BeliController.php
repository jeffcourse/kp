<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Gudang;
use App\Models\Beli;
use App\Models\BeliDetail;
use App\Models\Satuan;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BeliController extends Controller
{
    public function beli(Request $request){
        $selectedDate = $request->get('selectedDate');

        $query = Beli::query();

        if($selectedDate){
            $query->where('tanggal', $selectedDate);
        }

        $beli = $query->paginate(5);

        $supplier = Supplier::all();
        $gudang = Gudang::all();

        return view('transaksi.beli',compact('beli','supplier','gudang','selectedDate'));
    }

    public function create()
    {
        $lastNoBukti = Beli::latest('no_bukti')->first();
        $lastNoBuktiNum = $lastNoBukti ? intval(substr($lastNoBukti->no_bukti, -5)) : 0;
        $newNoBuktiNum = $lastNoBuktiNum + 1;
        $newNoBukti = 'BL24-' . str_pad($newNoBuktiNum, 5, '0', STR_PAD_LEFT);

        $supplier = Supplier::all();
        $gudang = Gudang::all();
        $satuan = Satuan::all();

        return view('transaksi.formbeli',compact('supplier','gudang','satuan','newNoBukti'));
    }

    public function store(Request $request)
    {
        //
        $data = new Beli();
        $data->no_bukti = $request->get('no_bukti');
        $data->tanggal = $request->get('datepicker');
        $data->kode_supp = $request->get('select_supplier');
        $data->mata_uang = $request->get('mata_uang');
        $data->kirim_gudang = $request->get('select_gudang');
        $data->sub_total = $request->get('sub_total');
        $data->persen_ppn = $request->get('persen_ppn');
        $data->total = $request->get('total'); 
        $data->lunas = 'Belum Lunas';
        $data->status = 'Belum Terkirim';
        $data->create_time = Carbon::now()->format('d-m-Y');
        $data->save();

        $kode_brg = $request->get('kode_brg');
        $nama_brg = $request->get('nama_brg');
        $qty_order = $request->get('qty_order');
        $id_satuan = $request->get('select_satuan');
        $hrg_per_unit = $request->get('hrg_per_unit');
        $hrg_total = $request->get('hrg_total');

        foreach($kode_brg as $key => $value) {
            $detail = new BeliDetail();
            $detail->no_bukti = $data->no_bukti;
            $detail->kode_brg = $kode_brg[$key];
            $detail->nama_brg = $nama_brg[$key];
            $detail->qty_order = $qty_order[$key];
            $detail->id_satuan = $id_satuan[$key];
            $detail->hrg_per_unit = $hrg_per_unit[$key];
            $detail->hrg_total = $hrg_total[$key];
            $detail->save();
        }

        return redirect()->route('pembelian')->with('status','Hooray!! Your new transaction is already inserted');
    }

    public function updateBayar($no_bukti)
    {
        $beli = Beli::where('no_bukti', $no_bukti)->firstOrFail();
        $beli->lunas = 'Lunas';
        $beli->save();

        return redirect()->route('pembelian')->with('status','Sukses update status pembayaran');
    }

    public function updateKirim($no_bukti)
    {
        $beli = Beli::where('no_bukti', $no_bukti)->firstOrFail();
        $beli->status = 'Sudah Terkirim';
        $beli->save();

        return redirect()->route('pembelian')->with('status','Sukses update status pengiriman');
    }
}
