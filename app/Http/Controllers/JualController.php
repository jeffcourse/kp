<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Jual;
use App\Models\JualDetail;
use App\Models\Satuan;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class JualController extends Controller
{
    public function jual(Request $request){
        $selectedDate = $request->get('selectedDateJual');

        $query = Jual::query();

        if($selectedDate){
            $query->where('tanggal', $selectedDate);
        }

        $jual = $query->paginate(5);

        $customer = Customer::all();

        return view('transaksi.jual',compact('jual','customer','selectedDate'));
    }

    public function updateBayar($no_bukti)
    {
        $jual = Jual::where('no_bukti', $no_bukti)->firstOrFail();
        $jual->lunas = 'Lunas';
        $jual->save();

        return redirect()->route('penjualan')->with('status','Sukses update status pembayaran');
    }

    public function updateKirim($no_bukti)
    {
        $jual = Jual::where('no_bukti', $no_bukti)->firstOrFail();
        $jual->status = 'Sudah Terkirim';
        $jual->save();

        return redirect()->route('penjualan')->with('status','Sukses update status pengiriman');
    }
}
