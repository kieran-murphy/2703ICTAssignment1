@extends('layouts.master')

@section('title')
    Detail
@endsection

@section('content')
    <h1>{{$vehicle->rego}}</h1>
    <br>
    <p>Model: {{$vehicle->model}}</p>
    <p>Year: {{$vehicle->year}}</p>
    <p>Odometer: {{$vehicle->odometer}} kms</p>
    <p>Transmission: {{$vehicle->transmission}}</p>
    <br>
    <a href="{{url("vehicle_update/$vehicle->rego")}}">Update vehicle</a>
    <br>
    <br>
    <a href="{{url("vehicle_delete/$vehicle->rego")}}">Delete vehicle</a>
    
    
@endsection