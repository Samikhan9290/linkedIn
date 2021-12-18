<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::all();
        return response()->json(['products'=>$products]);

        //
//        return view('product.add-Product')
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $user_id=session()->has('USER_ID');
//        return $user_id;
        $validation=Validator::make($request->all(),[
           'title'=>'required',
           'description'=>'required',
           'price'=>'required',
        ]);
        if ($validation->fails()){
            return response()->json([
               'status'=>'400',
                'errors'=>$validation->messages(),
            ]);
        }
        else{
            $product=new Product();
            $product->title=$request->title;
            $product->description=$request->description;
            $product->price=$request->price;
            $product->user_id=$user_id;
            $product->save();
            return response()->json([
               'status'=>200,
                'message'=>"Product Added",
            ]);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product=Product::find($id);
        if ($product) {
            return response()->json([
                'status' => 200,
                'product' => $product,
            ]);
        }
            else{
                return response()->json([
                    'status' => 404,
                    'message' => 'product not Found',
                ]);
            }



        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $product=Product::find($id);
        $validate=Validator::make($request->all(),[
            "title"=>'required',
            "description"=>'required',
            "price"=>'required',

        ]);
        if ($validate->fails()){
            return response()->json([
                'status'=>'400',
                'errors'=>$validate->messages(),
            ]);

        }
        else{
            $student=Product::find($id);
            if ($product){
                $product->title=$request->title;
                $product->description=$request->description;
                $product->price=$request->price;
                $product->update();
                return response()->json([
                    'status'=>'200',
                    'message'=>'updated',
                ]);
            }
            else{
                return response()->json([
                    'status'=>404,
                    'product'=>"product NotFound",
                ]);
            }


        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $product=Product::find($id);
        $product->delete();
        return response()->json([
            'status'=>200,
            'message'=>"product Deleted",
        ]);
    }
}
