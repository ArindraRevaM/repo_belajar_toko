<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App/Product;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
	public function show()
    {
        return Product :: all();
    }
    public function store(Request $request)
    {
    	$validator=Validator::make($request->all(),
    		[
    			'nama_product' => 'required'
    			'jumlah_product' => 'required'
    		]
    	);

    	if($validator->fails()){
    		return Response()->json($validator->errors());
    	}

    	$simpan = Product::create([
    		'nama_product' => $request->nama_product,
    		'jumlah_product' => $request->jumlah_product,
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
