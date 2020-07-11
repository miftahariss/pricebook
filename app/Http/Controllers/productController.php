<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Product;

class productController extends Controller
{

    public function store (Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid Request! name and description is required!',
            ], 401);
        }

        $data = new Product();
        $data->name = $request->input('name');
        $data->save();

        return response()->json([
            'message' => 'Product data CREATED successfully!',
        ], 200);
    }

    public function index(){
        $data = Product::all();

        $products = array();

        foreach($data as $key => $val){
            $products[] = $val->name;
        }

        $output = array();
        while( empty( $products) === false )
        {
          $currentProduct = array_shift( $products );
          $currentGroup = array( $currentProduct );
          foreach( $products as $index => $product )
          {
            if( similar_text( $product, $currentProduct, $percentage ) and $percentage > 60 )
            {
              $currentGroup[] = $product;
              unset( $products[ $index ] );
            }
          }
          $output[] = $currentGroup;
        }

        dd($output);

        return response()->json([
            'products' => $data,
        ], 200);
    }

}