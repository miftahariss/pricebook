<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Product;

class productController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index(){
        $data = Product::all();

        return response()->json([
            'products' => $data,
        ], 200);
    }
    public function show($id){
        $data = Product::where('id',$id)->get();

        return response()->json([
            'products' => $data,
        ], 200);
    }
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
        $data->description = $request->input('description');
        $data->save();

        return response()->json([
            'message' => 'Product data CREATED successfully!',
        ], 200);
    }
}