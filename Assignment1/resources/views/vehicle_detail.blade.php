@extends('layouts.master')

@section('title')
    Detail
@endsection

@section('content')
    <h1>{{$vehicle->model}}</h1>
    <br>
    <p>Rego: {{$vehicle->rego}}</p>
    <p>Year: {{$vehicle->year}}</p>
    <p>Odometer: {{$vehicle->odometer}} kms</p>
    <p>Transmission: {{$vehicle->transmission}}</p>
    <br>
    <a href="{{url("vehicle_delete/$vehicle->rego")}}">Delete vehicle</a>
    <br>
    <a href="{{url("vehicle_update/$vehicle->rego")}}">Update vehicle</a>
    
@endsection