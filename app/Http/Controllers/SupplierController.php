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
        $data->alamat = $request->get('alamat');
        $data->kontak = $request->get('kontak');
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
        $objSupplier->alamat = $request->get('alamat');
        $objSupplier->kontak = $request->get('kontak');
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
