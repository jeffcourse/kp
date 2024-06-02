<?php

namespace App\Http\Controllers;

use App\Models\SalesPerson;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function salesPerson(Request $request){
        $search = $request->get('search');

        $query = SalesPerson::query();

        if($search){
            $query->where('nama_sales', 'like', '%'.$search.'%');
        }

        $salesPerson = $query->paginate(10);

        return view('sales.sales',compact('salesPerson','search'));
    }

    public function create()
    {
        return view('sales.formsales');
    }

    public function store(Request $request)
    {
        //
        $data = new SalesPerson();
        $data->kode_sales = $request->get('kode_sales');
        $data->nama_sales = $request->get('nama_sales');
        $data->divisi = $request->get('select_divisi');
        $data->save();
        return redirect()->route('salesPerson')->with('status','Hooray!! Your new item is already inserted');
    }

    public function edit($kode_sales)
    {
        //
        $objSales = SalesPerson::find($kode_sales);

        $data = $objSales;
        return view('sales.formedit',compact('data'));
    }

    public function update(Request $request, $kode_sales)
    {
        //
        $objSales = SalesPerson::find($kode_sales);
        $objSales->kode_sales = $request->get('kode_sales');
        $objSales->nama_sales = $request->get('nama_sales');
        $objSales->divisi = $request->get('select_divisi');
        $objSales->save();
        return redirect()->route('salesPerson')->with('status','Your item is up-to-date');
    }

    public function destroy($kode_sales)
    {
        //
        try{
            $objSales = SalesPerson::find($kode_sales);
            $objSales->delete();
            return redirect()->route('salesPerson')->with('status','Deleted Successfully');
        }
        catch(\PDOException $ex){
            $msg = "Delete data failed. Make sure there is no correlated data before deleting!";
            return redirect()->route('salesPerson')->with('status',$msg);
        }
    }
}
