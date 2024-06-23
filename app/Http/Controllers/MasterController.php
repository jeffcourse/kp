<?php

namespace App\Http\Controllers;

use App\Models\Master;
use App\Models\Divisi;
use App\Models\Gudang;
use App\Models\Jenis;
use App\Models\Type;
use App\Models\Satuan;
use App\Models\BeliDetail;
use App\Models\JualDetail;
use App\Models\OpnameStok;
use App\Models\MutasiStok;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function master(Request $request){
        $selectedGudang = $request->get('gudang');
        $jenis = $request->get('jenis');
        $search = $request->get('search');

        $query = MutasiStok::whereIn('id', function ($query){
                    $query->select(DB::raw('MAX(id)'))
                        ->from('mutasi_stok')
                        ->groupBy('kode_brg', 'kode_gudang');
                    })->select('inventory.kode_brg as kode_brg', 'inventory.nama_brg as nama_brg', 'inventory.kode_divisi as kode_divisi',
                        'inventory.kode_jenis as kode_jenis', 'inventory.kode_type as kode_type', 'mutasi_stok.stok_akhir as quantity',
                        'inventory.id_satuan as id_satuan', 'inventory.hrg_jual as hrg_jual', 'inventory.keterangan as keterangan', 
                        'mutasi_stok.kode_gudang as kode_gudang', 'invgudang.nama as nama_gudang')
                    ->join('inventory', 'mutasi_stok.kode_brg', '=', 'inventory.kode_brg')
                    ->join('invgudang', 'mutasi_stok.kode_gudang', '=', 'invgudang.kode');

        if($selectedGudang && $selectedGudang != 'All'){
            $query->where('invgudang.nama', $selectedGudang);
        }

        if($selectedGudang == 'All'){
            $query->select('inventory.kode_brg', 'inventory.nama_brg', 'inventory.kode_divisi', 'inventory.kode_jenis', 
                    'inventory.kode_type', 'inventory.id_satuan', 'inventory.hrg_jual', 'inventory.keterangan')
                ->selectRaw('SUM(mutasi_stok.stok_akhir) as quantity')
                ->groupBy('inventory.kode_brg', 'inventory.nama_brg', 'inventory.kode_divisi', 'inventory.kode_jenis', 
                    'inventory.kode_type', 'inventory.id_satuan', 'inventory.hrg_jual', 'inventory.keterangan');
        }

        if($jenis && $jenis != 'All'){
            $query->where('inventory.kode_jenis',$jenis);
        }

        if($search){
                $query->where('inventory.nama_brg', 'like', '%'.$search.'%')
                      ->orWhere('inventory.kode_brg', 'like', '%'.$search.'%');
        }

        $master = $query->paginate(10);

        $divisi = Divisi::all();
        $gudang = Gudang::all();
        $jenis = Jenis::all();
        $type = Type::all();
        $satuan = Satuan::all();
        $beli = BeliDetail::all();
        $jual = JualDetail::all();

        return view('master.master',compact('master','divisi','gudang','jenis','type','satuan','selectedGudang','search','jenis','beli','jual'));
    }

    public function create()
    {
        $divisi = Divisi::all();
        $gudang = Gudang::all();
        $jenis = Jenis::all();
        $type = Type::all();
        $satuan = Satuan::all();

        return view('master.formmaster',compact('divisi','gudang','jenis','type','satuan'));
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
        $data->quantity = $request->get('quantity');
        $data->id_satuan = $request->get('select_satuan');
        $data->hrg_jual = $request->get('hrg_jual');
        $data->kode_gudang = $request->get('select_gudang');
        $data->keterangan = $request->get('keterangan');
        $data->save();
        return redirect()->route('master')->with('status','Hooray!! Your new item is already inserted');
    }

    public function edit($kode_brg, $nama_brg)
    {
        $objMaster = Master::where('kode_brg', $kode_brg)
                        ->where('nama_brg', $nama_brg)
                        ->first();
        $divisi = Divisi::all();
        $jenis = Jenis::all();
        $type = Type::all();

        $data = $objMaster;
        return view('master.formedit',compact('data','divisi','jenis','type'));
    }

    public function update(Request $request, $kode_brg, $nama_brg)
    {
        $objMasters = Master::where('kode_brg', $kode_brg)
                        ->where('nama_brg', $nama_brg)->get();

        foreach($objMasters as $objMaster){
            $objMaster->kode_divisi = $request->input('select_divisi');
            $objMaster->kode_jenis = $request->input('select_jenis');
            $objMaster->kode_type = $request->input('select_type');
            $objMaster->keterangan = $request->input('keterangan');
            $objMaster->save();
        }
        return redirect()->route('master')->with('status','Your item is up-to-date');
    }

    public function destroy($id)
    {
        //
        try{
            $objMaster = Master::find($id);
            $objMaster->delete();
            return redirect()->route('master')->with('status','Deleted Successfully');
        }
        catch(\PDOException $ex){
            $msg = "Delete data failed. Make sure there is no correlated data before deleting!";
            return redirect()->route('master')->with('status',$msg);
        }
    }

    public function welcome()
    {
        $totalProducts = Master::select('kode_brg')->count('kode_brg');

        $totalPriceValue = MutasiStok::whereIn('id', function ($query){
                        $query->select(DB::raw('MAX(id)'))
                            ->from('mutasi_stok')
                            ->groupBy('kode_brg');
                        })->selectRaw('SUM(inventory.hrg_jual * mutasi_stok.stok_akhir) as total_price')
                        ->join('inventory', 'mutasi_stok.kode_brg', '=', 'inventory.kode_brg')
                        ->first();
                        
        $totalPrice = $totalPriceValue->total_price;

        return view('welcome', compact('totalProducts', 'totalPrice'));
    }

    public function opnameBarang(Request $request){
        $kode_brg = $request->input('kode_brg');
        $nama_brg = $request->input('nama_brg');
        $quantity = $request->input('quantity');
        $qty_awal = $request->input('qty_awal');
        $kode_gudang = $request->input('kode_gudang');
        $keterangan = $request->input('keterangan');

        $qty_fisik = $request->input('qty_fisik');
        $transaction = $request->input('transaction');
        $no_bukti = $request->input('no_bukti');
        $qty_order = $request->input('qty_order');
        $hrg_total = $request->input('hrg_total');

        if($quantity != 0){
            DB::table('opname_stok')->insert([
                'tanggal' => Carbon::now()->format('d-m-Y'),
                'kode_brg' => $kode_brg,
                'kode_gudang' => $kode_gudang,
                'qty_sistem' => $qty_awal, 
                'qty_fisik' => $qty_fisik,
                'selisih' => $qty_fisik - $qty_awal,
                'keterangan' => $keterangan
            ]);

            if($keterangan == "BARANG RUSAK" || $keterangan == "BARANG EXPIRED"){
                $quantity = abs($quantity);

                DB::table('mutasi_stok')->insert([
                    'no_bukti' => "-",
                    'tanggal' => Carbon::now()->format('Y-m-d'),
                    'kode_brg' => $kode_brg,
                    'kode_gudang' => $kode_gudang,
                    'stok_awal' => $qty_awal, 
                    'qty_masuk' => 0,
                    'qty_keluar' => 0,
                    'qty_rusak_exp' => $quantity,
                    'stok_akhir' => $qty_awal - $quantity
                ]);
        
            } else{
                if($transaction == 'pembelian'){
                    DB::table('beli_dtl')->where('no_bukti', $no_bukti)
                    ->where('kode_brg', $kode_brg)
                    ->where('nama_brg', $nama_brg)
                    ->where('kirim_gudang', $kode_gudang)
                    ->update([
                        'qty_order' => $qty_order,
                        'hrg_total' => $hrg_total
                    ]);

                    $sub_total = DB::table('beli_dtl')
                    ->where('no_bukti', $no_bukti)
                    ->sum('hrg_total');
            
                    $beli_data = DB::table('beli')->where('no_bukti', $no_bukti)->first();
                    $sub_total = floatval($sub_total);
                    $total = $sub_total + ($sub_total * ($beli_data->persen_ppn / 100));
            
                    DB::table('beli')
                    ->where('no_bukti', $no_bukti)
                    ->update([
                        'sub_total' => $sub_total,
                        'total' => $total
                    ]);

                    DB::table('mutasi_stok')
                    ->where('no_bukti', $no_bukti)
                    ->where('kode_brg', $kode_brg)
                    ->where('kode_gudang', $kode_gudang)
                    ->update([
                        'qty_masuk' => $qty_order,
                        'stok_akhir' => DB::raw('stok_awal + ' . $qty_order)
                    ]);

                } else{
                    DB::table('jual_dtl')->where('no_bukti', $no_bukti)
                    ->where('kode_brg', $kode_brg)
                    ->where('kode_gudang', $kode_gudang)
                    ->update([
                        'qty_order' => $qty_order,
                        'hrg_total' => $hrg_total
                    ]);

                    $sub_total = DB::table('jual_dtl')
                    ->where('no_bukti', $no_bukti)
                    ->sum('hrg_total');
            
                    $jual_data = DB::table('jual')->where('no_bukti', $no_bukti)->first();
                    $sub_total = floatval($sub_total);
                    $total = $sub_total + ($sub_total * ($jual_data->persen_ppn / 100));
            
                    DB::table('jual')
                    ->where('no_bukti', $no_bukti)
                    ->update([
                        'sub_total' => $sub_total,
                        'total' => $total
                    ]);
                
                    DB::table('mutasi_stok')
                    ->where('no_bukti', $no_bukti)
                    ->where('kode_brg', $kode_brg)
                    ->where('kode_gudang', $kode_gudang)
                    ->update([
                        'qty_keluar' => $qty_order,
                        'stok_akhir' => DB::raw('stok_awal - ' . $qty_order)
                    ]);
                }
                $dataRow = DB::table('mutasi_stok')
                ->where('no_bukti', $no_bukti)
                ->where('kode_brg', $kode_brg)
                ->where('kode_gudang', $kode_gudang)
                ->get(['id', 'stok_akhir']);
                
                foreach($dataRow as $row){
                    $rowId = $row->id;
                    $rowStokAkhir = $row->stok_akhir;
                }
    
                $rowsToUpdate = DB::table('mutasi_stok')
                ->where('kode_brg', $kode_brg)
                ->where('kode_gudang', $kode_gudang)
                ->where('id', '>', $rowId)
                ->orderBy('id')
                ->get();

                $count = count($rowsToUpdate);

                if($count > 0){
                    $firstRow = $rowsToUpdate[0];
                    $stokAwal = $rowStokAkhir;
            
                    DB::table('mutasi_stok')
                    ->where('id', $firstRow->id)
                    ->update([
                        'stok_awal' => $stokAwal
                    ]);

                    for($i = 0; $i < $count; $i++){
                        $currentRow = $rowsToUpdate[$i];

                        $stokAwal = $rowStokAkhir;
                        $masuk = $currentRow->qty_masuk;
                        $keluar = $currentRow->qty_keluar;
                        $rusakExp = $currentRow->qty_rusak_exp;

                        $stokAkhir = $stokAwal + $masuk - $keluar - $rusakExp;

                        DB::table('mutasi_stok')
                        ->where('id', $currentRow->id)
                        ->update([
                            'stok_akhir' => $stokAkhir
                        ]);

                        if($i < $count - 1){
                            DB::table('mutasi_stok')
                            ->where('id', $rowsToUpdate[$i + 1]->id)
                            ->update([
                                'stok_awal' => $stokAkhir
                            ]);
                        }
                        $rowStokAkhir = $stokAkhir;
                    }
                }

                $transactions = DB::table('beli_dtl')
                ->where('kode_brg', $kode_brg)
                ->get();

                $totalCost = 0;
                $currentQuantity = 0;
                foreach($transactions as $transaction){
                    $totalCost += $transaction->hrg_total;
                    $currentQuantity += $transaction->qty_order;
                }

                $minSellPrice = $totalCost / $currentQuantity;
                $sellPrice = $minSellPrice + ($minSellPrice * 0.5);

                DB::table('inventory')
                ->where('kode_brg', $kode_brg)
                ->update(['hrg_jual' => $sellPrice]);
            }
            return response()->json(['success' => true]);
        }
    }

    public function fetchNoBukti(Request $request){
        $selectedValue = $request->input('selectedValue');
        $kodeBrg = $request->input('kodeBrg');
        $namaBrg = $request->input('namaBrg');
        $gudangBrg = $request->input('gudangBrg');

        if($selectedValue == 'pembelian'){
            $beliData = BeliDetail::where('kode_brg', $kodeBrg)
                ->where('nama_brg', $namaBrg)
                ->where('kirim_gudang', $gudangBrg)
                ->distinct()
                ->get(['no_bukti']);

            return response()->json($beliData);
        } else if($selectedValue == 'penjualan'){
            $jualData = JualDetail::where('kode_brg', $kodeBrg)
                ->where('kode_gudang', $gudangBrg)
                ->distinct()
                ->get(['no_bukti']);

            return response()->json($jualData);
        }
        return response()->json([]);
    }

    public function fetchTransData(Request $request){
        $transaction = $request->input('transaction');
        $noBukti = $request->input('noBukti');
        $kodeBrg = $request->input('kodeBrg');
        $namaBrg = $request->input('namaBrg');
        $gudangBrg = $request->input('gudangBrg');

        if($transaction == 'pembelian'){
            $beliData = BeliDetail::where('no_bukti', $noBukti)
                ->where('kode_brg', $kodeBrg)
                ->where('nama_brg', $namaBrg)
                ->where('kirim_gudang', $gudangBrg)
                ->get();

            $beliData = $beliData->map(function ($item, $key) {
                return [
                    'no_bukti' => $item->no_bukti,
                    'kode_brg' => $item->kode_brg,
                    'nama_brg' => $item->nama_brg,
                    'qty_order' => $item->qty_order,
                    'id_satuan' => $item->id_satuan,
                    'hrg_per_unit' => $item->hrg_per_unit,
                    'hrg_total' => $item->hrg_total,
                    'kode_gudang' => $item->kirim_gudang,    
                ];
            });
            return response()->json($beliData);
        } else if($transaction == 'penjualan'){
            $jualData = JualDetail::query()
                            ->select('jual_dtl.*', 'inventory.nama_brg as nama_brg','inventory.id_satuan')
                            ->join('inventory', 'jual_dtl.kode_brg', '=', 'inventory.kode_brg')
                            ->where('jual_dtl.no_bukti', $noBukti)
                            ->where('jual_dtl.kode_brg', $kodeBrg)->get();
            
            $jualData = $jualData->map(function ($item, $key) {
                return [
                    'no_bukti' => $item->no_bukti,
                    'kode_brg' => $item->kode_brg,
                    'nama_brg' => $item->nama_brg,
                    'qty_order' => $item->qty_order,
                    'id_satuan' => $item->id_satuan,
                    'hrg_per_unit' => $item->hrg_per_unit,
                    'hrg_total' => $item->hrg_total,
                    'kode_gudang' => $item->kode_gudang,     
                ];
            });
            return response()->json($jualData);
        }
        return response()->json([]);
    }

    public function cetak_pdf(Request $request){
        $selectedGudang = $request->input('selectedGudang');
        $selectedTanggal = $request->get('selectedTanggal');

        $query = OpnameStok::query()
                    ->select('opname_stok.*', 'inventory.nama_brg as nama_brg','satuan.satuan as nama_satuan', 'invgudang.nama as nama_gudang')
                    ->join('inventory', 'opname_stok.kode_brg', '=', 'inventory.kode_brg')
                    ->join('invgudang', 'invgudang.kode', '=', 'opname_stok.kode_gudang')
                    ->join('satuan', 'inventory.id_satuan', '=', 'satuan.id');

        if($selectedGudang && $selectedGudang != 'All'){
            $query->where('invgudang.nama', $selectedGudang);
        }

        if($selectedTanggal){
            $query->where('opname_stok.tanggal', $selectedTanggal);
        }

        $opname = $query->get();
        $data = $opname;
        $gudang = Gudang::all();
 
        $view = View::make('master.opnamepdf', ['data'=>$data, 'selectedGudang'=>$selectedGudang, 'selectedTanggal'=>$selectedTanggal, 'gudang'=>$gudang]);
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
