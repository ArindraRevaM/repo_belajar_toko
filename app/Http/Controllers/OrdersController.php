<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App/Orders;
use Illuminate\Support\Facades\Validator;

class OrdersController extends Controller
{
	 public function show()
    {
        $data_orders = Orders::join('customers', 'customers.id_customers', 'orders.id_customers')->get();
        return Response()->json($data_orders);
    }
     public function show()
    {
        $data_orders = Siswa::join('product', 'product.id_product', 'orders.id_product')->get();
        return Response()->json($data_orders);
    }
    public function detail($id)
    {
        if(Orders::where('id', $id)->exists()){
            $data_orders = Orders::join('customers', 'customers.id_customers', 'orders.id_kelas')
                                      ->where('orders.id', '=', $id)
                                      ->get();

            return Response()->json($data_orders);  
        }
        else{
            return Response()->json(['message' => 'Tidak Ditemukan']);
        }
    }
    public function detail($id)
    {
        if(Orders::where('id', $id)->exists()){
            $data_orders = Orders::join('product', 'product.id_product', 'orders.id_product')
                                      ->where('orders.id', '=', $id)
                                      ->get();

            return Response()->json($data_orders);  
        }
        else{
            return Response()->json(['message' => 'Tidak Ditemukan']);
        }
    }
   public function store(Request $request)
    {
    	$validator=Validator::make($request->all(),
    		[
    			'alamat' => 'required'
    			'tanggal_order' => 'required'
    			'id_customers' => 'required'
    			'id_product' => 'required'
    		]
    	);

    	if($validator->fails()){
    		return Response()->json($validator->errors());
    	}

    	$simpan = Orders::create([
    		'alamat' => $request->alamat,
    		'tanggal_order' => $request->tanggal_order,
    		'id_customers' => $request->id_customers,
    		'id_product' => $request->id_product
    	]);
    	
    	if($simpan)
    	{
    		return Response()->json(['status'=> 1]);
    	}	
    	else
    	{
    		return Response()->json(['status'=> 0]);
    	}
    }
    public function update($id, Request $request)
    {
    	$validator=Validator::make($request->all(),
    		[
    			'alamat' => 'required'
    			'tanggal_order' => 'required'
    			'id_customers' => 'required'
    			'id_product' => 'required'
    		]
    	);

    	if($validator->fails()){
    		return Response()->json($validator->errors());
    	}

    	$ubah = Orders::where('id', $id)->update([
    		'alamat' => $request->alamat,
    		'tanggal_order' => $request->tanggal_order,
    		'id_customers' => $request->id_customers,
    		'id_product' => $request->id_product
    	]);
    	
    	if($ubah) {
    		return Response()->json(['status'=> 1]);
    	}	
    	else {
    		return Response()->json(['status'=> 0]);
    	}
    }
    public function destroy($id)
    {
    	$hapus = Orders::where('id', $id)->delete();
    	if($hapus) {
    		return Response()->json(['status' => 1]);
    	}
    	else{
    		return Response()->json(['status' => 0]);
    	}
    }
}
