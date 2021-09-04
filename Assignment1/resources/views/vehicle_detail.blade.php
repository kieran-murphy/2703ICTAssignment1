@extends('layouts.master')

@section('title')
    Detail
@endsection

@section('content')
    <h1>Vehicle Details</h1>
    <br>
    <p>Rego: {{$vehicle->rego}}</p>
    <p>Model: {{$vehicle->model}}</p>
    <p>Year: {{$vehicle->year}}</p>
    <p>Odometer: {{$vehicle->odometer}} kms</p>
    <p>Transmission: {{$vehicle->transmission}}</p>
    <br>
    <h1>Bookings:</h1>
    <br>
    @if ($bookings)
        
        @foreach($bookings as $booking)
            <a href="{{url("booking_detail/$booking->booking_id")}}">{{$booking->client_drivers_license_number}}</a> from: {{$booking->start_time}} until: {{$booking->return_time}}
            <br>
            <br>
        @endforeach
        
        
    @else 
        No bookings found
    @endif
    <br>
    <br>
    <br>
    <br>
    <a href="{{url("vehicle_update/$vehicle->rego")}}">Update vehicle</a>
    <br>
    <br>
    <a href="{{url("vehicle_delete/$vehicle->rego")}}">Delete vehicle</a>
    
    
@endsection