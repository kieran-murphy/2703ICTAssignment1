<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){
    $sql = "select * from vehicle";
    $vehicles = DB::select($sql);
    return view('vehicle_list')->with('vehicles', $vehicles);
});

Route::get('vehicle_detail/{rego}', function($rego){
    $vehicle = get_vehicle($rego);
    return view('vehicle_detail')->with('vehicle', $vehicle);
});

function get_vehicle($rego) {
    $sql = "select * from vehicle where rego=?";
    $vehicles = DB::select($sql, array($rego));
    if (count($vehicles) != 1){
        die("Something has gone wrong, invalid query or result: $sql");
    }
    $vehicle = $vehicles[0];
    return $vehicle;
}

Route::get('add_vehicle', function(){
    return view("add_vehicle");
});

function add_vehicle($rego, $model, $year, $odometer, $transmission){
    $sql = "insert into vehicle (rego, model, year, odometer, transmission) values (?, ?, ?, ?, ?)";
    DB::insert($sql, array($rego, $model, $year, $odometer, $transmission));
    $id = DB::getPdo()->lastInsertId();
    return($id);
}

Route::post('add_vehicle_action', function() {
    $rego = request("rego");
    $model = request("model");
    $year = request("year");
    $odometer = request("odometer");
    $transmission = request("transmission");
    $id = add_vehicle($rego, $model, $year, $odometer, $transmission);
    if ($id) {
        return redirect(url("vehicle_detail/$rego"));
    } else {
        die("Error while adding vehicle.");
    }
});






Route::get('vehicle_update/{rego}', function($rego){
    $vehicle = get_vehicle($rego);
    return view('update_vehicle')->with('vehicle', $vehicle);
});

Route::post('update_vehicle_action', function() {
    $rego = request("rego");
    $model = request("model");
    $year = request("year");
    $odometer = request("odometer");
    $transmission = request("transmission");
    $updatedvehicle = update_vehicle($rego, $model, $year, $odometer, $transmission);
    return redirect(url("vehicle_detail/$rego")); 
});

function update_vehicle($rego, $model, $year, $odometer, $transmission) {
    $sql = "update vehicle set model = ?, year = ?, odometer = ?, transmission = ? where rego = ?";
    DB::update($sql,array($model, $year, $odometer, $transmission, $rego));
}








Route::post('delete_vehicle_action', function() {
    $rego = request("rego");
    delete_vehicle($rego);
    return redirect(url("/"));
});

Route::get('vehicle_delete/{rego}', function($rego){
    $vehicle = get_vehicle($rego);
    return view('delete_vehicle')->with('vehicle', $vehicle);
});

function delete_vehicle($rego){
    $sql = "delete from vehicle where rego = ?";
    DB::delete($sql,array($rego));
}