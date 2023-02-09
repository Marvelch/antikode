<?php

namespace App\Http\Controllers;

use App\Models\brand;
use App\Models\outlet;
use Illuminate\Http\Request;
use DB;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        if ($image = $request->file('logo')) {
            $destinationPath = 'image/';
            $logoImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $logoImage);
            $input['image'] = "$logoImage";
        }

        if ($image = $request->file('banner')) {
            $destinationPath = 'image/';
            $bannerImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $bannerImage);
            $input['image'] = "$bannerImage";
        }

        try {
            brand::create([
                'name' => $request->name, 
                'logo' => $logoImage, 
                'banner' => $bannerImage
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
                'Message' => 'Failed Log Data '.$e->getMessage()
            ],400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(brand $brand)
    {
        try {
            $brands = brand::all();

            return response()->json([
                'Status' => 'Success',
                'Data' => $brands,
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($image = $request->file('logo')) {
            $destinationPath = 'image/';
            $logoImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $logoImage);
            $input['image'] = "$logoImage";
        }

        if ($image = $request->file('banner')) {
            $destinationPath = 'image/';
            $bannerImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $bannerImage);
            $input['image'] = "$bannerImage";
        }

        try {
            brand::find($id)->update([
                'name' => $request->name, 
                'logo' => $logoImage, 
                'banner' => $bannerImage
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
                'Message' => 'Failed Log Data '.$e->getMessage()
            ],400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(brand $brand, $id)
    {
        try {
            brand::find($id)->delete();

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
