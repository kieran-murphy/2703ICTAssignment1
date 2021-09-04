@extends('layouts.master')

@section('title')
    Add Vehicle
@endsection

@section('content')
    <h1>Add Vehicle</h1>
    <form method="post" action="{{url("add_vehicle_action")}}">
    {{csrf_field()}}
    <br>
    <div class="form-group">
        <label for="exampleFormControlInput1">Rego</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" name="rego" placeholder="Rego">
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Model</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" name="model" placeholder="Model">
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Year</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" name="year" placeholder="Year">
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Odometer</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" name="odometer" placeholder="Odometer">
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect1">Transmission</label>
        <select class="form-control" id="exampleFormControlSelect1" name="transmission">
        <option>Automatic</option>
        <option>Manual</option>
        </select>
    </div>
    <input type="submit" value="Add">
    
    
    </form>

@endsection
    
