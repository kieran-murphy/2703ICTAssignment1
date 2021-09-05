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
    $bookings = get_vehicle_bookings($rego);
    return view('vehicle_detail')->with('vehicle', $vehicle)->with('bookings', $bookings);
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

function get_vehicle_bookings($rego) {
    $sql = "select * from vehicle, booking where rego=? and vehicle.rego = booking.vehicle_rego";
    $bookings = DB::select($sql, array($rego));
    if (count($bookings) != 0){
        return $bookings;
    } else {
        return null;
    }
    
}

//Sort by Days Vehicle List

Route::get('/days_vehicle_list', function(){
    $sql = "select * from vehicle";
    $vehicles = DB::select($sql);
    $vehicles = days_sort($vehicles);
    return view('days_vehicle_list')->with('vehicles', $vehicles);
});

function days_sort($vehicles) {
    $vehicles = collect($vehicles);
    $vehicles = $vehicles->sortByDesc('booking_time');
    $vehicles = $vehicles->toArray();
    return $vehicles;
}

//Sort by Bookings Vehicle List

Route::get('/bookings_vehicle_list', function(){
    $sql = "select * from vehicle";
    $vehicles = DB::select($sql);
    $vehicles = bookings_sort($vehicles);
    return view('bookings_vehicle_list')->with('vehicles', $vehicles);
});

function bookings_sort($vehicles) {
    $vehicles = collect($vehicles);
    $vehicles = $vehicles->sortByDesc('bookings');
    $vehicles = $vehicles->toArray();
    return $vehicles;
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
    if ($age <= 99 && $age >= 17) {
        $id = add_client($drivers_license_number, $license_type, $name, $age, $gender);
    } else {
        die("Error: Age must be between 17 and 99");
    }
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
    if ($age <= 99 && $age >= 17) {
        $updatedclient = update_client($drivers_license_number, $license_type, $name, $age, $gender);
    } else {
        die("Error: Age must be between 17 and 99");
    }
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
    if (strlen($rego) == 6) {
        $id = add_vehicle($rego, $model, $year, $odometer, $transmission);
    } else {
        die("Error: Rego must have a length of 6.");
    }
    
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

//Add Booking

Route::get('add_booking', function(){
    $sql_vehicles = "select * from vehicle where is_booked = 0";
    $vehicles = DB::select($sql_vehicles);
    $sql_clients = "select * from client";
    $clients = DB::select($sql_clients);
    return view("booking.add_booking")->with('vehicles', $vehicles)->with('clients', $clients);
});

function add_booking($vehicle_rego, $client_drivers_license_number, $start_time, $return_time){
    $sql = "insert into booking (vehicle_rego, client_drivers_license_number, start_time, return_time) values (?, ?, ?, ?)";
    DB::insert($sql, array($vehicle_rego, $client_drivers_license_number, $start_time, $return_time));
    $sql = "update vehicle set is_booked = ? where rego = ?";
    DB::update($sql,array(1, $vehicle_rego));
    $id = DB::getPdo()->lastInsertId();
    return($id);
}

Route::post('add_booking_action', function() {
    $vehicle_rego = request("vehicle_rego");
    $client_drivers_license_number = request("client_drivers_license_number");
    $start_time = request("start_time");
    $return_time = request("return_time");
    
    
    if (strtotime($start_time) < strtotime($return_time)) {
        $id = add_booking($vehicle_rego, $client_drivers_license_number, $start_time, $return_time);
        if ($id) {
            return redirect(url("booking_list"));
        } else {
            die("Error while adding client.");
        }
    } else {
        die("Error: Start date must come before return date");
    }
    
    
    
    if ($id) {
        return redirect(url("booking_list"));
    } else {
        die("Error while adding booking.");
    }
});

//Booking List

Route::get('/booking_list', function(){
    $sql = "select * from booking";
    $bookings = DB::select($sql);
    return view('booking.booking_list')->with('bookings', $bookings);
});

Route::get('booking_detail/{booking_id}', function($booking_id){
    $booking = get_booking($booking_id);
    return view('booking.booking_detail')->with('booking', $booking);
});

function get_booking($booking_id) {
    $sql = "select * from booking where booking_id=?";
    $bookings = DB::select($sql, array($booking_id));
    if (count($bookings) != 1){
        die("Something has gone wrong, invalid query or result: $sql");
    }
    $booking = $bookings[0];
    return $booking;
}

//Delete Booking

Route::get('booking_delete/{booking_id}', function($booking_id){
    $booking = get_booking($booking_id);
    $vehicle = get_vehicle_from_booking($booking_id);
    
    $datediff = strtotime($booking->return_time) - strtotime($booking->start_time);

    $final = intval(round($datediff / (60 * 60 * 24)));
    return view('booking.delete_booking')->with('booking', $booking)->with('vehicle', $vehicle)->with('final', $final);
});

Route::post('delete_booking_action', function() {
    $odometer = request("odometer");
    $vehicle_rego = request("vehicle_rego");
    $booking_id = request("booking_id");


    
    if (request("added_kms") >= 0) {
        $added_kms = request("added_kms");
    } else {
        die("Kilometers cannot be a negative number");
    }



    $bookings = request("bookings");
    $start_time = request("start_time");
    $return_time = request("return_time");
    $booking_time = request("booking_time");

    $datediff = strtotime($return_time) - strtotime($start_time);
    $days = intval(round($datediff / (60 * 60 * 24)));
    $final_days = $days + $booking_time;

    $final_bookings = $bookings + 1;
    $final_kms = $odometer + $added_kms;

    
    add_kms($vehicle_rego, $final_kms, $final_bookings, $final_days);
    delete_booking($booking_id);
    make_available($vehicle_rego);
    return redirect(url("booking_list"));
});

function delete_booking($booking_id){
    $sql = "delete from booking where booking_id = ?";
    DB::delete($sql,array($booking_id));
}

function add_kms($vehicle_rego, $final_kms, $final_bookings, $final_days){
    $sql = "update vehicle set odometer = ?, bookings = ?, booking_time = ? where rego = ?";
    DB::update($sql,array($final_kms, $final_bookings, $final_days, $vehicle_rego));
    
}

function make_available($vehicle_rego){
    $sql = "update vehicle set is_booked = ? where rego = ?";
    DB::update($sql,array(0, $vehicle_rego));
}

function get_vehicle_from_booking($booking_id) {
    $sql = "select * from vehicle, booking where booking.booking_id=? and vehicle.rego = booking.vehicle_rego";
    $vehicles = DB::select($sql, array($booking_id));
    if (count($vehicles) != 1){
        die("Something has gone wrong, invalid query or result: $sql");
    }
    $vehicle = $vehicles[0];
    return $vehicle;
}

