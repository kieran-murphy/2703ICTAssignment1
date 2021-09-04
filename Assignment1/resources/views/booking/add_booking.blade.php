@extends('layouts.master')

@section('title')
    Add Booking
@endsection

@section('content')
    <h1>Add Booking</h1>
    <form method="post" action="{{url("add_booking_action")}}">
    {{csrf_field()}}
    <br>
    
    <div class="form-group">
        <label for="exampleFormControlInput1">Start Date</label>
        <input type="date" class="form-control" id="exampleFormControlInput1" name="start_time" placeholder="01-01-2020">
    </div>

    <div class="form-group">
        <label for="exampleFormControlInput1">Return Date</label>
        <input type="date" class="form-control" id="exampleFormControlInput1" name="return_time" placeholder="01-01-2020">
    </div>
    
    <div class="form-group">
        <label for="exampleFormControlSelect1">Select Client</label>
        <select class="form-control" id="exampleFormControlSelect1" name="client_drivers_license_number">
        @foreach($clients as $client)
            <option>{{$client->drivers_license_number}}</option>
        @endforeach
        </select>
    </div>
    
    <div class="form-group">
        <label for="exampleFormControlSelect1">Select Vehicle</label>
        <select class="form-control" id="exampleFormControlSelect1" name="vehicle_rego">
        @foreach($vehicles as $vehicle)
            <option>{{$vehicle->rego}}</option>
        @endforeach
        </select>
    </div>
    <input type="submit" value="Add">
    
    
    </form>

@endsection
    
