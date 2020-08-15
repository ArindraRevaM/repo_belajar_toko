<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App/Orders;
use Illuminate\Support\Facades\Validator;

class OrdersController extends Controller
{
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
}
