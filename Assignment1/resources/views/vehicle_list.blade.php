@extends('layouts.master')

@section('title')
    Fleet
@endsection

@section('content')
<h1>Vehicles 🚗</h1>
<br>
Sort by: <a href="{{url("days_vehicle_list")}}">Days</a> or <a href="{{url("bookings_vehicle_list")}}">Bookings</a> or <a href="{{url("/")}}">ID</a>
<br>
<br>
    @if ($vehicles)
        <div class="tablediv">
        <div class="list-group">
        @foreach($vehicles as $vehicle)
            <a href="{{url("vehicle_detail/$vehicle->rego")}}" class="list-group-item list-group-item-action">{{$vehicle->rego}}</a>
        @endforeach
        </div>
        </div>
        <br>
        <a href="{{url("add_vehicle")}}">Add New Vehicle</a>
    @else 
        No vehicles found
    @endif
@endsection
    
