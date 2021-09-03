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

//Vehicle List

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

//Client List

Route::get('/client_list', function(){
    $sql = "select * from client";
    $clients = DB::select($sql);
    return view('client.client_list')->with('clients', $clients);
});

Route::get('client_detail/{drivers_license_number}', function($drivers_license_number){
    $client = get_client($drivers_license_number);
    return view('client.client_detail')->with('client', $client);
});

function get_client($drivers_license_number) {
    $sql = "select * from client where drivers_license_number=?";
    $clients = DB::select($sql, array($drivers_license_number));
    if (count($clients) != 1){
        die("Something has gone wrong, invalid query or result: $sql");
    }
    $client = $clients[0];
    return $client;
}

//Add Client

Route::get('add_client', function(){
    return view("client.add_client");
});

function add_client($drivers_license_number, $license_type, $name, $age, $gender){
    $sql = "insert into client (drivers_license_number, license_type, name, age, gender) values (?, ?, ?, ?, ?)";
    DB::insert($sql, array($drivers_license_number, $license_type, $name, $age, $gender));
    $id = DB::getPdo()->lastInsertId();
    return($id);
}

Route::post('add_client_action', function() {
    $drivers_license_number = request("drivers_license_number");
    $license_type = request("license_type");
    $name = request("name");
    $age = request("age");
    $gender = request("gender");
    $id = add_client($drivers_license_number, $license_type, $name, $age, $gender);
    if ($id) {
        return redirect(url("client_detail/$drivers_license_number"));
    } else {
        die("Error while adding client.");
    }
});

//Update Client

Route::get('client_update/{drivers_license_number}', function($drivers_license_number){
    $client = get_client($drivers_license_number);
    return view('client.update_client')->with('client', $client);
});

Route::post('update_client_action', function() {
    $drivers_license_number = request("drivers_license_number");
    $license_type = request("license_type");
    $name = request("name");
    $age = request("age");
    $gender = request("gender");
    $updatedclient = update_client($drivers_license_number, $license_type, $name, $age, $gender);
    return redirect(url("client_detail/$drivers_license_number")); 
});

function update_client($drivers_license_number, $license_type, $name, $age, $gender) {
    $sql = "update client set license_type = ?, name = ?, age = ?, gender = ? where drivers_license_number = ?";
    DB::update($sql,array($license_type, $name, $age, $gender, $drivers_license_number));
}

//Delete Client

Route::post('delete_client_action', function() {
    $drivers_license_number = request("drivers_license_number");
    delete_client($drivers_license_number);
    return redirect(url("client_list"));
});

Route::get('client_delete/{drivers_license_number}', function($drivers_license_number){
    $client = get_client($drivers_license_number);
    return view('client.delete_client')->with('client', $client);
});

function delete_client($drivers_license_number){
    $sql = "delete from client where drivers_license_number = ?";
    DB::delete($sql,array($drivers_license_number));
}

//Add Vehicle

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

//Update Vehicle

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

//Delete Vehicle

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