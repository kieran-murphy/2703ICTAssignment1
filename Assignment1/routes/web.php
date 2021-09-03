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

Route::get('add_vehicle', function(){
    return view("add_vehicle");
});



/*
Route::get('item_update/{id}', function($id){
    $item = get_item($id);
    return view('items.update_item')->with('item', $item);
});



Route::post('update_item_action', function() {
    $id = request("id");
    $summary = request("summary");
    $details = request("details");
    $updatedid = update_item($id, $summary, $details);
    return redirect(url("item_detail/$id")); 
});



function update_item($id,$summary,$details) {
    $sql = "update item set summary = ?, details = ? where id = ?";
    DB::update($sql,array($summary,$details,$id));
}


*/

Route::get('vehicle_detail/{rego}', function($rego){
    $vehicle = get_vehicle($rego);
    return view('vehicle_detail')->with('vehicle', $vehicle);
});

function get_vehicle($id) {
    $sql = "select * from vehicle where rego=?";
    $vehicles = DB::select($sql, array($id));
    if (count($vehicles) != 1){
        die("Something has gone wrong, invalid query or result: $sql");
    }
    $vehicle = $vehicles[0];
    return $vehicle;
}

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