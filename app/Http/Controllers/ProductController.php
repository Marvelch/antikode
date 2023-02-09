<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $products = product::all();

            return response()->json([
                'Status' => 'Success',
                'Data' => $products,
                'Message' => 'Successfully fetched data'
            ],200);
        } catch (\Exception $e) {
            DB::rollback();
            
            return response()->json([
                'Status' => 'Failed',
                'Message' => $e
            ],400);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }

        try {
            product::create([
                'name' => $request->name,
                'price' => $request->price,
                'picture' => $profileImage,
                'brand_id' => $request->brand_id
            ]);

            DB::commit();
            
            return response()->json([
                'Status' => 'Success',
                'Message' => 'Data has been successfully saved !'
            ],200);

        } catch (\Exception $e) {
            DB::rollback();
            
            return response()->json([
                'Status' => 'Failed',
                'Message' => 'Failed Log Data !'
            ],400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }

        try {
            product::find($id)->update([
                'name' => $request->name,
                'price' => $request->price,
                'picture' => $profileImage,
                'brand_id' => $request->brand_id
            ]);

            DB::commit();
            
            return response()->json([
                'Status' => 'Success',
                'Message' => 'Data has been successfully updated !'
            ],200);

        } catch (\Exception $e) {
            DB::rollback();
            
            return response()->json([
                'Status' => 'Failed',
                'Message' => $e->getMessage()
            ],400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(product $product, $id)
    {
        try {
            product::find($id)->delete();

            DB::commit();
            
            return response()->json([
                'Status' => 'Success',
                'Message' => 'Data deletion has been successful !'
            ],200);
        } catch (\Exception $e) {
            DB::rollback();
            
            return response()->json([
                'Status' => 'Failed',
                'Message' => $e->getMessage()
            ],400);
        }
    }
}
