<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Gudang;
use App\Models\Beli;
use App\Models\BeliDetail;
use App\Models\Satuan;
use App\Models\Master;
use App\Models\MutasiStok;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class BeliController extends Controller
{
    public function beli(Request $request){
        $selectedDate = $request->get('selectedDate');

        $query = Beli::query();

        if($selectedDate){
            $query->where('tanggal', $selectedDate);
        }

        $beli = $query->orderBy('tanggal', 'desc')->paginate(5);

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
        $data->sub_total = $request->get('sub_total');
        $data->persen_ppn = $request->get('persen_ppn');
        $data->total = $request->get('total'); 
        $data->lunas = 'Belum Lunas';
        $data->status = 'Belum Terkirim';
        $data->create_time = Carbon::now()->format('d-m-Y');
        $data->author = auth()->user()->name;
        $data->jatuh_tempo = Carbon::parse($data->tanggal)->addMonth()->format('d-m-Y');
        $data->tgl_lunas = '-';
        $data->tgl_terkirim = '-';
        $data->save();

        $kode_brg = $request->get('kode_brg');
        $nama_brg = $request->get('nama_brg');
        $qty_order = $request->get('qty_order');
        $packing = $request->get('packing');
        $id_satuan = $request->get('select_satuan');
        $hrg_per_unit = $request->get('hrg_per_unit');
        $hrg_total = $request->get('hrg_total');
        $kirim_gudang = $request->get('select_gudang');

        foreach($kode_brg as $key => $value) {
            $detail = new BeliDetail();
            $detail->no_bukti = $data->no_bukti;
            $detail->kode_brg = $kode_brg[$key];
            $detail->nama_brg = $nama_brg[$key];
            $detail->qty_order = $qty_order[$key];
            $detail->packing = $packing[$key];
            $detail->id_satuan = $id_satuan[$key];
            $detail->hrg_per_unit = $hrg_per_unit[$key];
            $detail->hrg_total = $hrg_total[$key];
            $detail->kirim_gudang = $kirim_gudang[$key];
            $detail->save();
        }

        return redirect()->route('pembelian')->with('status','Hooray!! Your new transaction is already inserted');
    }

    public function edit($no_bukti)
    {
        //
        $objBeli = Beli::find($no_bukti);
        $objDetailBeli = BeliDetail::where('no_bukti', $no_bukti)->get();
        $supplier = Supplier::all();
        $gudang = Gudang::all();
        $satuan = Satuan::all();

        $data = $objBeli;
        $dataDetail = $objDetailBeli;
        return view('transaksi.formeditbeli',compact('data','dataDetail','supplier','gudang','satuan'));
    }

    public function update(Request $request, $no_bukti)
    {
        BeliDetail::where('no_bukti', $no_bukti)->delete();

        $objBeli = Beli::find($no_bukti);
        $objBeli->no_bukti = $request->get('no_bukti');
        $objBeli->tanggal = $request->get('datepicker');
        $objBeli->kode_supp = $request->get('select_supplier');
        $objBeli->kirim_gudang = $request->get('select_gudang');
        $objBeli->sub_total = $request->get('sub_total');
        $objBeli->persen_ppn = $request->get('persen_ppn');
        $objBeli->total = $request->get('total');
        $objBeli->lunas = $request->get('select_lunas');
        $objBeli->status = $request->get('select_status');
        $objBeli->create_time = Carbon::now()->format('d-m-Y');
        $objBeli->jatuh_tempo = Carbon::parse($objBeli->tanggal)->addMonth()->format('d-m-Y');
        $objBeli->save();

        $kode_brg = $request->get('kode_brg');
        $nama_brg = $request->get('nama_brg');
        $qty_order = $request->get('qty_order');
        $id_satuan = $request->get('select_satuan');
        $hrg_per_unit = $request->get('hrg_per_unit');
        $hrg_total = $request->get('hrg_total');

        foreach($kode_brg as $key => $value) {
            $objDetail = new BeliDetail();
            $objDetail->no_bukti = $objBeli->no_bukti;
            $objDetail->kode_brg = $kode_brg[$key];
            $objDetail->nama_brg = $nama_brg[$key];
            $objDetail->qty_order = $qty_order[$key];
            $objDetail->id_satuan = $id_satuan[$key];
            $objDetail->hrg_per_unit = $hrg_per_unit[$key];
            $objDetail->hrg_total = $hrg_total[$key];
            $objDetail->save();
        }

        return redirect()->route('pembelian')->with('status','Your transaction is up-to-date');
    }

    public function destroy($no_bukti)
    {
        try{
            BeliDetail::where('no_bukti', $no_bukti)->delete();
            $objBeli = Beli::find($no_bukti);
            $objBeli->delete();
            return redirect()->route('pembelian')->with('status','Deleted Successfully');
        }
        catch(\PDOException $ex){
            $msg = "Delete data failed. Make sure there is no correlated data before deleting!";
            return redirect()->route('pembelian')->with('status',$msg);
        }
    }

    public function updateBayar(Request $request)
    {
        $no_bukti = $request->input('no_bukti');
        $tgl_lunas = $request->input('tgl_lunas');

        $beli = Beli::where('no_bukti', $no_bukti)->firstOrFail();

        $beli->lunas = 'Lunas';
        $beli->tgl_lunas = $tgl_lunas;
        $beli->save();

        return response()->json(['success' => true]);
    }

    public function updateKirim(Request $request)
    {
        $no_bukti = $request->input('no_bukti');
        $tgl_terkirim = $request->input('tgl_terkirim');

        $beli = Beli::where('no_bukti', $no_bukti)->firstOrFail();

        $beli->status = 'Sudah Terkirim';
        $beli->tgl_terkirim = $tgl_terkirim;
        $beli->save();

        $beliDetail = BeliDetail::where('no_bukti', $no_bukti)->get();

        $keteranganArray = ["BARANG RUSAK", "BARANG EXPIRED", "SALAH PENCATATAN"];

        foreach ($beliDetail as $detail) {
            $master = DB::table('invmaster')
                ->where('kode_brg', $detail->kode_brg)
                ->where('nama_brg', $detail->nama_brg)
                ->where('kode_gudang', $detail->kirim_gudang)
                ->whereNotIn('keterangan', $keteranganArray)
                ->first();

            if ($master) {
                $stok_awal = $master->quantity;

                DB::table('mutasi_stok')->insert([
                    'no_bukti' => $no_bukti,
                    'tanggal' => Carbon::parse($tgl_terkirim)->format('Y-m-d'),
                    'kode_brg' => $detail->kode_brg,
                    'nama_brg' => $detail->nama_brg,
                    'id_satuan' => $detail->id_satuan,
                    'kode_gudang' => $detail->kirim_gudang,
                    'stok_awal' => $stok_awal,
                    'qty_masuk' => $detail->qty_order,
                    'qty_keluar' => 0,
                    'qty_rusak_exp' => 0,
                    'stok_akhir' => $stok_awal + $detail->qty_order
                ]);

                DB::table('invmaster')
                    ->where('kode_brg', $detail->kode_brg)
                    ->where('nama_brg', $detail->nama_brg)
                    ->where('kode_gudang', $detail->kirim_gudang)
                    ->whereNotIn('keterangan', $keteranganArray)
                    ->increment('quantity', $detail->qty_order);
                
                $transactions = DB::table('beli_dtl')
                    ->where('kode_brg', $detail->kode_brg)
                    ->get();

                $totalCost = 0;
                $currentQuantity = 0;
                foreach($transactions as $transaction){
                    $totalCost += $transaction->hrg_total;
                    $currentQuantity += $transaction->qty_order;
                }

                $minSellPrice = $totalCost / $currentQuantity;
                $sellPrice = $minSellPrice + ($minSellPrice * 0.5);

                DB::table('invmaster')
                    ->where('kode_brg', $detail->kode_brg)
                    ->whereNotIn('keterangan', $keteranganArray)
                    ->update(['hrg_jual' => $sellPrice]);

            } else {
                DB::table('mutasi_stok')->insert([
                    'no_bukti' => $no_bukti,
                    'tanggal' => Carbon::parse($tgl_terkirim)->format('Y-m-d'),
                    'kode_brg' => $detail->kode_brg,
                    'nama_brg' => $detail->nama_brg,
                    'id_satuan' => $detail->id_satuan,
                    'kode_gudang' => $detail->kirim_gudang,
                    'stok_awal' => 0,
                    'qty_masuk' => $detail->qty_order,
                    'qty_keluar' => 0,
                    'qty_rusak_exp' => 0,
                    'stok_akhir' => $detail->qty_order
                ]);

                DB::table('invmaster')->insert([
                    'kode_brg' => $detail->kode_brg,
                    'nama_brg' => $detail->nama_brg,
                    'packing' => $detail->packing,
                    'quantity' => $detail->qty_order,
                    'id_satuan' => $detail->id_satuan,
                    'kode_gudang' => $detail->kirim_gudang,
                    'keterangan' => '-',
                ]);

                $transactions = DB::table('beli_dtl')
                    ->where('kode_brg', $detail->kode_brg)
                    ->get();

                $totalCost = 0;
                $currentQuantity = 0;
                foreach($transactions as $transaction){
                    $totalCost += $transaction->hrg_total;
                    $currentQuantity += $transaction->qty_order;
                }

                $minSellPrice = $totalCost / $currentQuantity;
                $sellPrice = $minSellPrice + ($minSellPrice * 0.5);

                DB::table('invmaster')
                    ->where('kode_brg', $detail->kode_brg)
                    ->update(['hrg_jual' => $sellPrice]);
            }
        }

        return response()->json(['success' => true]);
    }

    public function showDetail($no_bukti){
        $beliDetail = BeliDetail::where('no_bukti', $no_bukti)->get();
        $satuan = Satuan::all();
        $gudang = Gudang::all();

        return view('transaksi.belidetail', compact('beliDetail','satuan','gudang','no_bukti'));
    }

    public function welcomeBeli(){
        $query = Beli::query();
        $transLunas = $query->where('lunas', 'Belum Lunas')->count();

        $query2 = Beli::query();
        $transStatus = $query2->where('status', 'Belum Terkirim')->count();
        return view('welcome', compact('transLunas','transStatus'));
    }

    public function belumLunasReport()
    {
        $lunas = Beli::where('lunas', 'Belum Lunas')->orderBy('tanggal', 'desc')->paginate(5);
        $supplier = Supplier::all();
        $gudang = Gudang::all();

        return view('report.beliLunas', compact('lunas','supplier','gudang'));
    }

    public function belumKirimReport()
    {
        $kirim = Beli::where('status', 'Belum Terkirim')->orderBy('tanggal', 'desc')->paginate(5);
        $supplier = Supplier::all();
        $gudang = Gudang::all();

        return view('report.beliKirim', compact('kirim','supplier','gudang'));
    }

    public function cetak_pdf($no_bukti)
    {
        $beli = Beli::find($no_bukti);
        $beliDetail = BeliDetail::where('no_bukti', $no_bukti)->get();
        $supplier = Supplier::all();
        $gudang = Gudang::all();
        $satuan = Satuan::all();

        $data = $beli;
        $dataDetail = $beliDetail;
 
        $view = View::make('transaksi.belipdf', ['data'=>$data, 'dataDetail'=>$dataDetail, 'supplier'=>$supplier, 'gudang'=>$gudang, 'satuan'=>$satuan]);
        $pdf = new Dompdf();
        $pdf->loadHtml($view->render());
        $pdf->setPaper('A4', 'landscape');
        $pdf->render();
        return response($pdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline;',
        ]);
    }
}
