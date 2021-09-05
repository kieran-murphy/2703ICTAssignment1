@extends('layouts.master')

@section('title')
    Update Vehicle
@endsection
@section('content')

<h1>Update Vehicle 🚗</h1>
    <form method="post" action="{{url("update_vehicle_action")}}">
    {{csrf_field()}}
    <br>
    <input type="hidden" name="rego" value="{{$vehicle->rego}}">
    <div class="form-group">
        <label for="exampleFormControlInput1">Model</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" name="model" value="{{$vehicle->model}}">
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Year</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" name="year" value="{{$vehicle->year}}">
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Odometer</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" name="odometer" value="{{$vehicle->odometer}}">
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect1">Transmission</label>
        <select class="form-control" id="exampleFormControlSelect1" name="transmission">
        <option>Automatic</option>
        <option>Manual</option>
        </select>
    </div>
    <input type="submit" value="Update">
    
    
    </form>

@endsection
