<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\ProductController;
use App\Models\outlet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'products',  'as' => 'product.'], function(){
    Route::get('/', [ProductController::class,'index']);
    Route::post('store', [ProductController::class,'store']);
    Route::put('/{id}/update',[ProductController::class,'update']);
    Route::post('{id}/destroy',[ProductController::class,'destroy']);
});

Route::group(['prefix' => 'outlets',  'as' => 'outlet.'], function(){
    Route::get('/', [OutletController::class,'index']);
    Route::post('store', [OutletController::class,'store']);
    Route::put('/{id}/update',[OutletController::class,'update']);
    Route::post('{id}/destroy',[OutletController::class,'destroy']);
});

Route::group(['prefix' => 'brands',  'as' => 'brand.'], function(){
    Route::get('/show', [BrandController::class,'show']);
    Route::post('store', [BrandController::class,'store']);
    Route::put('/{id}/update',[BrandController::class,'update']);
    Route::post('{id}/destroy',[BrandController::class,'destroy']);
});

Route::get('sort-by-distance',function() {
    $outlets = outlet::all();

    $latMonas = -6.172043;
    $lngMonas = 106.826327;

    $arrayOutletDistance = [];

    foreach($outlets as  $outlet){
        $outletName = $outlet->name;
        $theta = $lngMonas - $outlet->longitude;
        $miles = (sin(deg2rad($latMonas)) * sin(deg2rad($outlet->latitude))) + (cos(deg2rad($latMonas)) * cos(deg2rad($outlet->latitude)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet  = $miles * 5280;
        // $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        // $meters = $kilometers * 1000;
        array_push($arrayOutletDistance,['namaOutlet' => $outletName,'jarak' => $kilometers]);
    }

    $sortOutletDistance = array();

    foreach($arrayOutletDistance as $key => $item) {
        $sortOutletDistance[$key] = $item['jarak'];   
        // echo sort($outlet['jarak']);
        // foreach($outlet as $distance) {
        //     // echo sort($distance);
        //     echo $distance;
        // }
    }

    array_multisort($sortOutletDistance, SORT_ASC, $arrayOutletDistance);
    dd($arrayOutletDistance);
    // return compact('arrayOutletDistance');
});