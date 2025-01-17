<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Jual;
use App\Models\JualDetail;
use App\Models\Satuan;
use App\Models\Gudang;
use App\Models\Master;
use App\Models\MutasiStok;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;

class JualController extends Controller
{
    public function jual(Request $request){
        $selectedDate = $request->get('selectedDateJual');

        $query = Jual::query();

        if($selectedDate){
            $query->where('tanggal', $selectedDate);
        }

        $jual = $query->orderBy('tanggal', 'desc')->paginate(10);

        $customer = Customer::all();

        return view('transaksi.jual',compact('jual','customer','selectedDate'));
    }

    public function create()
    {
        $lastNoBukti = Jual::latest('no_bukti')->first();
        $lastNoBuktiNum = $lastNoBukti ? intval(substr($lastNoBukti->no_bukti, -5)) : 0;
        $newNoBuktiNum = $lastNoBuktiNum + 1;
        $newNoBukti = 'JL24-' . str_pad($newNoBuktiNum, 5, '0', STR_PAD_LEFT);

        $masterData = MutasiStok::whereIn('id', function ($query){
                    $query->select(DB::raw('MAX(id)'))
                        ->from('mutasi_stok')
                        ->groupBy('kode_brg', 'kode_gudang');
                    })->select('inventory.kode_brg as kode_brg', 'inventory.nama_brg as nama_brg', 'inventory.id_satuan as id_satuan', 
                        'inventory.hrg_jual as hrg_jual', 'mutasi_stok.stok_akhir as quantity', 'mutasi_stok.kode_gudang as kode_gudang')
                    ->join('inventory', 'mutasi_stok.kode_brg', '=', 'inventory.kode_brg')
                    ->get();
        //$master = Master::all();
        $master = $masterData;
        $customer = Customer::all();
        $satuan = Satuan::all();
        $gudang = Gudang::all();

        return view('transaksi.formjual',compact('master','customer','satuan','gudang','newNoBukti'));
    }

    public function store(Request $request)
    {
        //
        $data = new Jual();
        $data->no_bukti = $request->get('no_bukti');
        $data->tanggal = $request->get('datepicker');
        $data->kode_cust = $request->get('select_customer');
        $data->sub_total = $request->get('sub_total');
        $data->persen_ppn = $request->get('persen_ppn');
        $data->total = $request->get('total'); 
        $data->lunas = 'Belum Lunas';
        $data->status = 'Belum Terkirim';
        $data->author = auth()->user()->name;
        $data->jatuh_tempo = Carbon::parse($data->tanggal)->addMonth()->format('d-m-Y');
        $data->tgl_lunas = '-';
        $data->tgl_terkirim = '-';
        $data->save();

        $kode_brg = $request->get('kode_brg');
        $qty_order = $request->get('qty_order');
        $hrg_per_unit = $request->get('hrg_per_unit');
        $hrg_total = $request->get('hrg_total');
        $kode_gudang = $request->get('select_gudang');

        foreach($kode_brg as $key => $value){
            $detail = new JualDetail();
            $detail->no_bukti = $data->no_bukti;
            $detail->kode_brg = $kode_brg[$key];
            $detail->qty_order = $qty_order[$key];
            $detail->hrg_per_unit = $hrg_per_unit[$key];
            $detail->hrg_total = $hrg_total[$key];
            $detail->kode_gudang = $kode_gudang[$key];
            $detail->save();
        }

        return redirect()->route('penjualan')->with('status','Hooray!! Your new transaction is already inserted');
    }

    public function edit($no_bukti)
    {
        //
        $objJual = Jual::find($no_bukti);
        $objDetailJual = JualDetail::where('no_bukti', $no_bukti)->get();
        $customer = Customer::all();
        $satuan = Satuan::all();

        $data = $objJual;
        $dataDetail = $objDetailJual;
        return view('transaksi.formeditjual',compact('data','dataDetail','customer','satuan'));
    }

    public function update(Request $request, $no_bukti)
    {
        JualDetail::where('no_bukti', $no_bukti)->delete();

        $objJual = Jual::find($no_bukti);
        $objJual->no_bukti = $request->get('no_bukti');
        $objJual->tanggal = $request->get('datepicker');
        $objJual->kode_cust = $request->get('select_customer');
        $objJual->sub_total = $request->get('sub_total');
        $objJual->persen_ppn = $request->get('persen_ppn');
        $objJual->total = $request->get('total');
        $objJual->lunas = $request->get('select_lunas');
        $objJual->status = $request->get('select_status');
        $objJual->create_time = Carbon::now()->format('d-m-Y');
        $objJual->jatuh_tempo = Carbon::parse($objJual->tanggal)->addMonth()->format('d-m-Y');
        $objJual->save();

        $kode_brg = $request->get('kode_brg');
        $nama_brg = $request->get('nama_brg');
        $qty_order = $request->get('qty_order');
        $id_satuan = $request->get('select_satuan');
        $hrg_per_unit = $request->get('hrg_per_unit');
        $hrg_total = $request->get('hrg_total');

        foreach($kode_brg as $key => $value) {
            $objDetail = new JualDetail();
            $objDetail->no_bukti = $objJual->no_bukti;
            $objDetail->kode_brg = $kode_brg[$key];
            $objDetail->nama_brg = $nama_brg[$key];
            $objDetail->qty_order = $qty_order[$key];
            $objDetail->id_satuan = $id_satuan[$key];
            $objDetail->hrg_per_unit = $hrg_per_unit[$key];
            $objDetail->hrg_total = $hrg_total[$key];
            $objDetail->save();
        }

        return redirect()->route('penjualan')->with('status','Your transaction is up-to-date');
    }

    public function destroy($no_bukti)
    {
        try{
            JualDetail::where('no_bukti', $no_bukti)->delete();
            $objJual = Jual::find($no_bukti);
            $objJual->delete();
            return redirect()->route('penjualan')->with('status','Deleted Successfully');
        }
        catch(\PDOException $ex){
            $msg = "Delete data failed. Make sure there is no correlated data before deleting!";
            return redirect()->route('penjualan')->with('status',$msg);
        }
    }

    public function updateBayar(Request $request)
    {
        $no_bukti = $request->input('no_bukti');
        $tgl_lunas = $request->input('tgl_lunas');

        $jual = Jual::where('no_bukti', $no_bukti)->firstOrFail();

        $jual->lunas = 'Lunas';
        $jual->tgl_lunas = $tgl_lunas;
        $jual->save();

        return response()->json(['success' => true]);
    }

    public function updateKirim(Request $request)
    {
        $no_bukti = $request->input('no_bukti');
        $tgl_terkirim = $request->input('tgl_terkirim');

        $jual = Jual::where('no_bukti', $no_bukti)->firstOrFail();

        $jual->status = 'Sudah Terkirim';
        $jual->tgl_terkirim = $tgl_terkirim;
        $jual->save();

        $jualDetail = JualDetail::where('no_bukti', $no_bukti)->get();

        foreach ($jualDetail as $detail){
            $master = DB::table('mutasi_stok')
                ->where('kode_brg', $detail->kode_brg)
                ->where('kode_gudang', $detail->kode_gudang)
                ->orderBy('id', 'desc')
                ->first();

            if ($master){
                $stok_awal = $master->stok_akhir;

                DB::table('mutasi_stok')->insert([
                    'no_bukti' => $no_bukti,
                    'tanggal' => Carbon::parse($tgl_terkirim)->format('Y-m-d'),
                    'kode_brg' => $detail->kode_brg,
                    'kode_gudang' => $detail->kode_gudang,
                    'stok_awal' => $stok_awal,
                    'qty_masuk' => 0,
                    'qty_keluar' => $detail->qty_order,
                    'qty_rusak_exp' => 0,
                    'stok_akhir' => $stok_awal - $detail->qty_order
                ]);
            }
        }

        return response()->json(['success' => true]);
    }

    public function showDetail($no_bukti){
        $jualDetail = JualDetail::query()
            ->select('jual_dtl.*', 'inventory.nama_brg as nama_brg','satuan.satuan as nama_satuan')
            ->join('inventory', 'jual_dtl.kode_brg', '=', 'inventory.kode_brg')
            ->join('satuan', 'inventory.id_satuan', '=', 'satuan.id')
            ->where('jual_dtl.no_bukti', $no_bukti)->get();

        $gudang = Gudang::all();

        return view('transaksi.jualdetail', compact('jualDetail','no_bukti','gudang'));
    }

    public function welcomeJual(){
        $query = Jual::query();
        $transLunasJual = $query->where('lunas', 'Belum Lunas')->count();

        $query2 = Jual::query();
        $transStatusJual = $query2->where('status', 'Belum Terkirim')->count();
        return view('welcome', compact('transLunasJual', 'transStatusJual'));
    }

    public function belumLunasReport()
    {
        $lunas = Jual::where('lunas', 'Belum Lunas')->orderBy('tanggal', 'desc')->paginate(5);
        $customer = Customer::all();

        return view('report.jualLunas', compact('lunas','customer'));
    }

    public function belumKirimReport()
    {
        $kirim = Jual::where('status', 'Belum Terkirim')->orderBy('tanggal', 'desc')->paginate(5);
        $customer = Customer::all();

        return view('report.jualKirim', compact('kirim','customer'));
    }

    public function cetak_pdf($no_bukti)
    {
        $jual = Jual::find($no_bukti);
        $jualDetail = JualDetail::query()
                        ->select('jual_dtl.*', 'inventory.nama_brg as nama_brg','satuan.satuan as nama_satuan')
                        ->join('inventory', 'jual_dtl.kode_brg', '=', 'inventory.kode_brg')
                        ->join('satuan', 'inventory.id_satuan', '=', 'satuan.id')
                        ->where('jual_dtl.no_bukti', $no_bukti)->get();
        $customer = Customer::all();
 
        $data = $jual;
        $dataDetail = $jualDetail;

        $view = View::make('transaksi.jualpdf', ['data'=>$data, 'dataDetail'=>$dataDetail, 'customer'=>$customer]);
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
