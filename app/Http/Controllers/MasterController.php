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

        $query = Master::query();

        if($selectedGudang && $selectedGudang != 'All'){
            $query->whereHas('gudang', function ($q) use ($selectedGudang) {
                $q->where('nama', $selectedGudang);
            });
        }

        if($jenis && $jenis != 'All'){
            $query->whereHas('jenis', function ($j) use ($jenis){
                $j->where('jenis',$jenis);
            });
        }

        if($search){
            $query->where(function ($query) use ($search) {
                $query->where('nama_brg', 'like', '%'.$search.'%')
                      ->orWhere('kode_brg', 'like', '%'.$search.'%');
            });
        }

        $master = $query->paginate(5);

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
        $data->packing = $request->get('packing');
        $data->quantity = $request->get('quantity');
        $data->id_satuan = $request->get('select_satuan');
        $data->hrg_jual = $request->get('hrg_jual');
        $data->kode_gudang = $request->get('select_gudang');
        $data->keterangan = $request->get('keterangan');
        $data->save();
        return redirect()->route('master')->with('status','Hooray!! Your new item is already inserted');
    }

    public function edit($id)
    {
        //
        $objMaster = Master::find($id);
        $divisi = Divisi::all();
        $jenis = Jenis::all();
        $type = Type::all();

        $data = $objMaster;
        return view('master.formedit',compact('data','divisi','jenis','type'));
    }

    public function update(Request $request, $id)
    {
        //
        $objMaster = Master::find($id);
        $objMaster->kode_brg = $request->get('kode_brg');
        $objMaster->nama_brg = $request->get('nama_brg');
        $objMaster->kode_divisi = $request->get('select_divisi');
        $objMaster->kode_jenis = $request->get('select_jenis');
        $objMaster->kode_type = $request->get('select_type');
        $objMaster->keterangan = $request->get('keterangan');
        $objMaster->save();
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
        $keteranganArray = ["BARANG RUSAK", "BARANG EXPIRED", "SALAH PENCATATAN"];

        $totalProducts = Master::whereNotIn("keterangan", $keteranganArray)->count();

        $totalPrice = Master::whereNotIn("keterangan", $keteranganArray)->sum(DB::raw('hrg_jual * quantity'));

        return view('welcome', compact('totalProducts', 'totalPrice'));
    }

    public function opnameBarang(Request $request){
        $kode_brg = $request->input('kode_brg');
        $nama_brg = $request->input('nama_brg');
        $kode_divisi = $request->input('kode_divisi');
        $kode_jenis = $request->input('kode_jenis');
        $kode_type = $request->input('kode_type');
        $packing = $request->input('packing');
        $quantity = $request->input('quantity');
        $qty_awal = $request->input('qty_awal');
        $id_satuan = $request->input('id_satuan');
        $hrg_jual = $request->input('hrg_jual');
        $kode_gudang = $request->input('kode_gudang');
        $keterangan = $request->input('keterangan');

        $qty_fisik = $request->input('qty_fisik');
        $transaction = $request->input('transaction');
        $no_bukti = $request->input('no_bukti');
        $qty_order = $request->input('qty_order');
        $hrg_total = $request->input('hrg_total');

        $master = Master::where('kode_brg', $kode_brg)
            ->where('nama_brg', $nama_brg)
            ->where('kode_gudang', $kode_gudang)
            ->where('keterangan', $keterangan)
            ->first();

        if($keterangan == "BARANG RUSAK" || $keterangan == "BARANG EXPIRED"){
            $quantity = abs($quantity);

            if($master){
                DB::table('invmaster')
                ->where('kode_brg', $kode_brg)
                ->where('nama_brg', $nama_brg)
                ->where('kode_gudang', $kode_gudang)
                ->where('keterangan', [$keterangan])
                ->increment('quantity', $quantity);
    
            }else{
                DB::table('invmaster')->insert([
                    'kode_brg' => $kode_brg,
                    'nama_brg' => $nama_brg,
                    'kode_divisi' => $kode_divisi,
                    'kode_jenis' => $kode_jenis,
                    'kode_type' => $kode_type,
                    'packing' => $packing,
                    'quantity' => $quantity,
                    'id_satuan' => $id_satuan,
                    'hrg_jual' => $hrg_jual,
                    'kode_gudang' => $kode_gudang,
                    'keterangan' => $keterangan,
                ]);
            }
            $keteranganArray = ["BARANG RUSAK", "BARANG EXPIRED", "SALAH PENCATATAN"];
    
            DB::table('mutasi_stok')->insert([
                'no_bukti' => "-",
                'tanggal' => Carbon::now()->format('Y-m-d'),
                'kode_brg' => $kode_brg,
                'nama_brg' => $nama_brg,
                'id_satuan' => $id_satuan,
                'kode_gudang' => $kode_gudang,
                'stok_awal' => $qty_awal, 
                'qty_masuk' => 0,
                'qty_keluar' => 0,
                'qty_rusak_exp' => $quantity,
                'stok_akhir' => $qty_awal - $quantity
            ]);
             
            DB::table('invmaster')
                ->where('kode_brg', $kode_brg)
                ->where('nama_brg', $nama_brg)
                ->where('kode_gudang', $kode_gudang)
                ->whereNotIn('keterangan', $keteranganArray)
                ->decrement('quantity', $quantity);
        
        } else{

        }

        return response()->json(['success' => true]);
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
                ->get(['no_bukti']);

            return response()->json($beliData);
        } else if($selectedValue == 'penjualan'){
            $jualData = JualDetail::where('kode_brg', $kodeBrg)
                ->where('nama_brg', $namaBrg)
                ->where('kode_gudang', $gudangBrg)
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
                    'packing' => $item->packing,
                    'id_satuan' => $item->id_satuan,
                    'hrg_per_unit' => $item->hrg_per_unit,
                    'hrg_total' => $item->hrg_total,
                    'kode_gudang' => $item->kirim_gudang,    
                ];
            });

            return response()->json($beliData);
        } else if($transaction == 'penjualan'){
            $jualData = JualDetail::where('no_bukti', $noBukti)
                ->where('kode_brg', $kodeBrg)
                ->where('nama_brg', $namaBrg)
                ->where('kode_gudang', $gudangBrg)
                ->get();
            
            return response()->json($jualData);
        }
        return response()->json([]);
    }

    public function cetak_pdf(Request $request){
        $selectedGudang = $request->input('selectedGudang');

        $keteranganArray = ["BARANG RUSAK", "BARANG EXPIRED", "SALAH PENCATATAN"];

        $opname = MutasiStok::where('kode_gudang', $selectedGudang)->whereIn('keterangan', $keteranganArray);

        $data = $opname;
        $gudang = Gudang::all();
        $satuan = Satuan::all();
 
        $view = View::make('master.opnamepdf', ['data'=>$data, 'gudang'=>$gudang, 'satuan'=>$satuan, 'selectedGudang'=>$selectedGudang]);
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
