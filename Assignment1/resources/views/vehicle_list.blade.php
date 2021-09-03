@extends('layouts.master')

@section('title')
    Fleet
@endsection

@section('content')
<h1>Vehicles</h1>
    @if ($vehicles)
        <ul>
        @foreach($vehicles as $vehicle)
            <li><a href="{{url("vehicle_detail/$vehicle->rego")}}">{{$vehicle->rego}}</a></li>
        @endforeach
        </ul>
        <br>
        <a href="{{url("add_vehicle")}}">Add New Vehicle</a>
    @else 
        No vehicles found
    @endif
@endsection
    
