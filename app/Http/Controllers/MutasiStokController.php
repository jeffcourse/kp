<?php

namespace App\Http\Controllers;

use App\Models\MutasiStok;
use App\Models\Gudang;
use App\Models\Satuan;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;

class MutasiStokController extends Controller
{
    public function kartuStok(Request $request){
        $selectedGudang = $request->get('gudangKartu');
        $search = $request->get('searchKartu');
        $selectedTrans = $request->get('selectedTrans');
        $tglAwal = $request->get('tglAwal');
        $tglAkhir = $request->get('tglAkhir');

        $tglAwalFormatted = $tglAwal ? Carbon::createFromFormat('d-m-Y', $tglAwal)->startOfDay()->format('d-m-Y') : Carbon::createFromFormat('Y-m-d', MutasiStok::min('tanggal'))->format('d-m-Y');
        $tglAkhirFormatted = $tglAkhir ? Carbon::createFromFormat('d-m-Y', $tglAkhir)->endOfDay()->format('d-m-Y') : Carbon::createFromFormat('Y-m-d', MutasiStok::max('tanggal'))->format('d-m-Y');        

        $query = MutasiStok::query()
                    ->select('mutasi_stok.*', 'inventory.nama_brg as nama_brg','satuan.satuan as nama_satuan', 
                        'invgudang.nama as nama_gudang')
                    ->join('inventory', 'mutasi_stok.kode_brg', '=', 'inventory.kode_brg')
                    ->join('invgudang', 'mutasi_stok.kode_gudang', '=', 'invgudang.kode')
                    ->join('satuan', 'inventory.id_satuan', '=', 'satuan.id')->orderBy('mutasi_stok.id', 'asc');

        if($selectedGudang && $selectedGudang != 'All'){
            $query->where('invgudang.nama', $selectedGudang);
        }
    
        if($search){
            $query->where('mutasi_stok.kode_brg', 'like', '%'.$search.'%')
                ->orWhere('inventory.nama_brg', 'like', '%'.$search.'%');
        }

        if($selectedTrans && $selectedTrans != 'All' && $selectedTrans != "-"){
            $query->where('mutasi_stok.no_bukti', 'like', '%'.$selectedTrans.'%');
        }

        if($selectedTrans == "-"){
            $query->where('mutasi_stok.no_bukti', '-');
        }

        if($tglAwal && $tglAkhir){
            $tglAwalFlipped = Carbon::createFromFormat('d-m-Y', $tglAwalFormatted)->format('Y-m-d');
            $tglAkhirFlipped = Carbon::createFromFormat('d-m-Y', $tglAkhirFormatted)->format('Y-m-d');
            $query->whereBetween('tanggal', [$tglAwalFlipped, $tglAkhirFlipped]);
        } elseif ($tglAwal){
            $tglAwalFlipped = Carbon::createFromFormat('d-m-Y', $tglAwalFormatted)->format('Y-m-d');
            $query->where('tanggal', '>=', $tglAwalFlipped);
        } elseif ($tglAkhir){
            $tglAkhirFlipped = Carbon::createFromFormat('d-m-Y', $tglAkhirFormatted)->format('Y-m-d');
            $query->where('tanggal', '<=', $tglAkhirFlipped);
        }

        $kartuStok = $query->orderBy('tanggal', 'asc')->paginate(10);
        $gudang = Gudang::all();

        return view('mutasi.kartustok',compact('kartuStok', 'gudang'));
    }

    public function cetak_pdf(Request $request)
    {
        $selectedGudang = $request->input('selectedGudang');
        $searchText = $request->input('searchText');
        $selectedTrans = $request->get('selectedTrans');
        $tglAwal = $request->get('tglAwal');
        $tglAkhir = $request->get('tglAkhir');

        $tglAwalFormatted = $tglAwal ? Carbon::createFromFormat('d-m-Y', $tglAwal)->startOfDay()->format('d-m-Y') : Carbon::createFromFormat('Y-m-d', MutasiStok::min('tanggal'))->format('d-m-Y');
        $tglAkhirFormatted = $tglAkhir ? Carbon::createFromFormat('d-m-Y', $tglAkhir)->endOfDay()->format('d-m-Y') : Carbon::createFromFormat('Y-m-d', MutasiStok::max('tanggal'))->format('d-m-Y');

        $query = MutasiStok::query()
                    ->select('mutasi_stok.*', 'inventory.nama_brg as nama_brg','satuan.satuan as nama_satuan', 
                        'invgudang.nama as nama_gudang')
                    ->join('inventory', 'mutasi_stok.kode_brg', '=', 'inventory.kode_brg')
                    ->join('invgudang', 'mutasi_stok.kode_gudang', '=', 'invgudang.kode')
                    ->join('satuan', 'inventory.id_satuan', '=', 'satuan.id')->orderBy('mutasi_stok.id', 'asc');

        if($selectedGudang && $selectedGudang != 'All'){
            $query->where('invgudang.nama', $selectedGudang);
        }

        if($searchText){
            $query->where('mutasi_stok.kode_brg', 'like', '%' . $searchText . '%')
                    ->orWhere('inventory.nama_brg', 'like', '%' . $searchText . '%');
        }

        if($selectedTrans && $selectedTrans != 'All' && $selectedTrans != "-"){
            $query->where('mutasi_stok.no_bukti', 'like', '%'.$selectedTrans.'%');
        }

        if($selectedTrans == "-"){
            $query->where('mutasi_stok.no_bukti', $selectedTrans);
        }

        if($tglAwal || $tglAkhir || ($tglAwal && $tglAkhir)){
            $tglAwalFlipped = Carbon::createFromFormat('d-m-Y', $tglAwalFormatted)->format('Y-m-d');
            $tglAkhirFlipped = Carbon::createFromFormat('d-m-Y', $tglAkhirFormatted)->format('Y-m-d');
            $query->whereBetween('tanggal', [$tglAwalFlipped, $tglAkhirFlipped]);
        }

        $totalQtyMasuk = $query->sum('qty_masuk');
        $totalQtyKeluar = $query->sum('qty_keluar');
        $totalQtyRusak = $query->sum('qty_rusak_exp');

        $kartuStok = $query->orderBy('tanggal', 'asc')->get();
        $data = $kartuStok;
 
        $view = View::make('mutasi.kartustokpdf', ['data'=>$data, 'totalMasuk'=>$totalQtyMasuk, 
        'totalKeluar'=>$totalQtyKeluar, 'totalRusak'=>$totalQtyRusak, 'tglAwal'=>$tglAwalFormatted, 'tglAkhir'=>$tglAkhirFormatted, 
        'selectedGudang'=>$selectedGudang]);
        $pdf = new Dompdf();
        $pdf->loadHtml($view->render());
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();
        return response($pdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline;',
        ]);
    }
}
