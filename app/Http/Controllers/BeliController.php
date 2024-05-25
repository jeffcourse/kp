<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Gudang;
use App\Models\Beli;
use App\Models\BeliDetail;
use App\Models\Satuan;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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
