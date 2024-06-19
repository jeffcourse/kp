<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\SalesPerson;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function customer(Request $request){
        $search = $request->get('search');

        $query = Customer::query();

        if($search){
            $query->where('nama_cust', 'like', '%'.$search.'%');
        }

        $customer = $query->paginate(10);
        $salesPerson = SalesPerson::all();

        return view('customer.customer',compact('customer','salesPerson','search'));
    }

    public function create()
    {
        $salesPerson = SalesPerson::all();

        return view('customer.formcustomer',compact('salesPerson'));
    }

    public function store(Request $request)
    {
        //
        $data = new Customer();
        $data->kode_cust = $request->get('kode_cust');
        $data->nama_cust = $request->get('nama_cust');
        $data->type_cust = $request->get('type_cust');
        $data->alm_1 = $request->get('alm_1');
        $data->alm_2 = $request->get('alm_2');
        $data->alm_3 = $request->get('alm_3');
        $data->kota = $request->get('kota');
        $data->kontak = $request->get('kontak');
        $data->no_telp = $request->get('no_telp');
        $data->kode_sales = $request->get('select_sales');
        $data->save();
        return redirect()->route('customer')->with('status','Hooray!! Your new item is already inserted');
    }

    public function edit($kode_cust)
    {
        //
        $objCustomer = Customer::find($kode_cust);
        $salesPerson = SalesPerson::all();

        $data = $objCustomer;
        return view('customer.formedit',compact('data','salesPerson'));
    }

    public function update(Request $request, $kode_cust)
    {
        //
        $objCustomer = Customer::find($kode_cust);
        $objCustomer->kode_cust = $request->get('kode_cust');
        $objCustomer->nama_cust = $request->get('nama_cust');
        $objCustomer->type_cust = $request->get('type_cust');
        $objCustomer->alm_1 = $request->get('alm_1');
        $objCustomer->alm_2 = $request->get('alm_2');
        $objCustomer->alm_3 = $request->get('alm_3');
        $objCustomer->kota = $request->get('kota');
        $objCustomer->kontak = $request->get('kontak');
        $objCustomer->no_telp = $request->get('no_telp');
        $objCustomer->kode_sales = $request->get('select_sales');
        $objCustomer->save();
        return redirect()->route('customer')->with('status','Your item is up-to-date');
    }

    public function destroy($kode_cust)
    {
        //
        try{
            $objCustomer = Customer::find($kode_cust);
            $objCustomer->delete();
            return redirect()->route('customer')->with('status','Deleted Successfully');
        }
        catch(\PDOException $ex){
            $msg = "Delete data failed. Make sure there is no correlated data before deleting!";
            return redirect()->route('customer')->with('status',$msg);
        }
    }
}
