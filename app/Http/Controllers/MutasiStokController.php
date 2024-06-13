<?php

namespace App\Http\Controllers;

use App\Models\MutasiStok;
use App\Models\Gudang;
use App\Models\Satuan;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;

class MutasiStokController extends Controller
{
    public function kartuStok(Request $request){
        $selectedGudang = $request->get('gudangKartu');
        $search = $request->get('searchKartu');
        $selectedTrans = $request->get('selectedTrans');
        $tglAwal = $request->get('tglAwal');
        $tglAkhir = $request->get('tglAkhir');

        $query = MutasiStok::query();

        if($selectedGudang && $selectedGudang != 'All'){
            $query->where('kode_gudang', $selectedGudang);
        }
    
        if($search){
            $query->where(function ($query) use ($search){
                $query->where('kode_brg', 'like', '%'.$search.'%')
                      ->orWhere('nama_brg', 'like', '%'.$search.'%');
            });
        }

        if($selectedTrans && $selectedTrans != 'All' && $selectedTrans != "-"){
            $query->where(function ($query) use ($selectedTrans){
                $query->where('no_bukti', 'like', '%'.$selectedTrans.'%');
            });
        }

        if($selectedTrans == "-"){
            $query->where('no_bukti', '-');
        }

        if($tglAwal && $tglAkhir){
            $tglAwalCarbon = Carbon::createFromFormat('d-m-Y', $tglAwal)->startOfDay();
            $tglAkhirCarbon = Carbon::createFromFormat('d-m-Y', $tglAkhir)->endOfDay();

            $tglAwalFormatted = $tglAwalCarbon->format('Y-m-d');
            $tglAkhirFormatted = $tglAkhirCarbon->format('Y-m-d');

            $query->whereBetween('tanggal', [$tglAwalFormatted, $tglAkhirFormatted]);
        }

        $kartuStok = $query->orderBy('tanggal', 'asc')->paginate(10);

        $gudang = Gudang::all();
        $satuan = Satuan::all();

        return view('mutasi.kartustok',compact('kartuStok','gudang','satuan'));
    }

    public function cetak_pdf(Request $request)
    {
        $selectedGudang = $request->input('selectedGudang');
        $searchText = $request->input('searchText');
        $selectedTrans = $request->get('selectedTrans');
        $tglAwal = $request->get('tglAwal');
        $tglAkhir = $request->get('tglAkhir');

        $query = MutasiStok::query();

        if($selectedGudang && $selectedGudang != 'All'){
            $query->where('kode_gudang', $selectedGudang);
        }

        if($searchText){
            $query->where(function ($query) use ($searchText){
                $query->where('kode_brg', 'like', '%' . $searchText . '%')
                    ->orWhere('nama_brg', 'like', '%' . $searchText . '%');
            });
        }

        if($selectedTrans && $selectedTrans != 'All' && $selectedTrans != "-"){
            $query->where(function ($query) use ($selectedTrans){
                $query->where('no_bukti', 'like', '%'.$selectedTrans.'%');
            });
        }

        if($selectedTrans == "-"){
            $query->where('no_bukti', $selectedTrans);
        }

        if($tglAwal && $tglAkhir){
            $tglAwalCarbon = Carbon::createFromFormat('d-m-Y', $tglAwal)->startOfDay();
            $tglAkhirCarbon = Carbon::createFromFormat('d-m-Y', $tglAkhir)->endOfDay();

            $tglAwalFormatted = $tglAwalCarbon->format('Y-m-d');
            $tglAkhirFormatted = $tglAkhirCarbon->format('Y-m-d');

            $query->whereBetween('tanggal', [$tglAwalFormatted, $tglAkhirFormatted]);
        }

        $totalQtyMasuk = $query->sum('qty_masuk');
        $totalQtyKeluar = $query->sum('qty_keluar');
        $totalQtyRusak = $query->sum('qty_rusak_exp');

        $kartuStok = $query->orderBy('tanggal', 'asc')->get();
        $data = $kartuStok;

        $gudang = Gudang::all();
        $satuan = Satuan::all();
 
    	$pdf = PDF::loadview('mutasi.kartustokpdf',['data'=>$data, 'gudang'=>$gudang, 'satuan'=>$satuan, 'totalMasuk'=>$totalQtyMasuk, 
            'totalKeluar'=>$totalQtyKeluar, 'totalRusak'=>$totalQtyRusak, 'tglAwal'=>$tglAwal, 'tglAkhir'=>$tglAkhir, 
            'selectedGudang'=>$selectedGudang]);
        $pdf->setPaper('A4');
    	return $pdf->stream();
    }
}
