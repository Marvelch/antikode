<?php

namespace App\Http\Controllers;

use App\Models\outlet;
use Faker\Core\Coordinates;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Http;

class OutletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $outlets = outlet::all();

            return response()->json([
                'Status' => 'Success',
                'Data' => $outlets,
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
        $geolocation = file_get_contents('https://api.ip2location.io/?key=01F04EB405BAF9F9FF3CBE3CC6AE2C51&ip=180.244.162.205&format=json');
        $json = json_decode($geolocation, true);

        if ($image = $request->file('picture')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }

        try {
            outlet::create([
                'name' => $request->name, 
                'picture' => $profileImage, 
                'address' => $request->address, 
                'longitude' => $json['longitude'], 
                'latitude' => $json['latitude'],
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
                'Message' => 'Failed Log Data '.$e->getMessage()
            ],400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function show(outlet $outlet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function edit(outlet $outlet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $geolocation = file_get_contents('https://api.ip2location.io/?key=01F04EB405BAF9F9FF3CBE3CC6AE2C51&ip=180.244.164.205&format=json');
        $json = json_decode($geolocation, true);

        if ($image = $request->file('picture')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }

        try {
            outlet::find($id)->update([
                'name' => $request->name, 
                'picture' => $profileImage, 
                'address' => $request->address, 
                'longitude' => $json['longitude'], 
                'latitude' => $json['latitude'],
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
                'Message' => 'Failed Log Data '.$e->getMessage()
            ],400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function destroy(outlet $outlet, $id)
    {
        try {
            outlet::find($id)->delete();

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
