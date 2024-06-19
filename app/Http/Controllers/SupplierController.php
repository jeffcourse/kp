<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function supplier(Request $request){
        $search = $request->get('search');

        $query = Supplier::query();

        if($search){
            $query->where('nama_supp', 'like', '%'.$search.'%');
        }

        $supplier = $query->paginate(10);

        return view('supplier.supplier',compact('supplier','search'));
    }

    public function create()
    {
        return view('supplier.formsupplier');
    }

    public function store(Request $request)
    {
        //
        $data = new Supplier();
        $data->kode_supp = $request->get('kode_supp');
        $data->nama_supp = $request->get('nama_supp');
        $data->bank = $request->get('bank');
        $data->acc_bank = $request->get('acc_bank');
        $data->alm_1 = $request->get('alm_1');
        $data->alm_2 = $request->get('alm_2');
        $data->kota = $request->get('kota');
        $data->negara = $request->get('negara');
        $data->kontak = $request->get('kontak');
        $data->jabatan = $request->get('jabatan');
        $data->no_telp = $request->get('no_telp');
        $data->email = $request->get('email');
        $data->save();
        return redirect()->route('supplier')->with('status','Hooray!! Your new item is already inserted');
    }

    public function edit($kode_supp)
    {
        //
        $objSupplier = Supplier::find($kode_supp);

        $data = $objSupplier;
        return view('supplier.formedit',compact('data'));
    }

    public function update(Request $request, $kode_supp)
    {
        //
        $objSupplier = Supplier::find($kode_supp);
        $objSupplier->kode_supp = $request->get('kode_supp');
        $objSupplier->nama_supp = $request->get('nama_supp');
        $objSupplier->bank = $request->get('bank');
        $objSupplier->acc_bank = $request->get('acc_bank');
        $objSupplier->alm_1 = $request->get('alm_1');
        $objSupplier->alm_2 = $request->get('alm_2');
        $objSupplier->kota = $request->get('kota');
        $objSupplier->negara = $request->get('negara');
        $objSupplier->kontak = $request->get('kontak');
        $objSupplier->jabatan = $request->get('jabatan');
        $objSupplier->no_telp = $request->get('no_telp');
        $objSupplier->email = $request->get('email');
        $objSupplier->save();
        return redirect()->route('supplier')->with('status','Your item is up-to-date');
    }

    public function destroy($kode_supp)
    {
        //
        try{
            $objSupplier = Supplier::find($kode_supp);
            $objSupplier->delete();
            return redirect()->route('supplier')->with('status','Deleted Successfully');
        }
        catch(\PDOException $ex){
            $msg = "Delete data failed. Make sure there is no correlated data before deleting!";
            return redirect()->route('supplier')->with('status',$msg);
        }
    }
}
