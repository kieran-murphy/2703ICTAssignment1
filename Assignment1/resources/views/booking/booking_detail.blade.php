@extends('layouts.master')

@section('title')
    Detail
@endsection

@section('content')
    <h1>{{$booking->vehicle_rego}}</h1>
    <br>
    <p>License Number: {{$booking->client_drivers_license_number}}</p>
    <p>Booking ID: {{$booking->booking_id}}</p>
    <p>Start Date: {{$booking->start_time}}</p>
    <p>Return Date: {{$booking->return_time}}</p>
    <br>
    <a href="{{url("booking_delete/$booking->booking_id")}}">Return vehicle</a>
    
    
@endsection