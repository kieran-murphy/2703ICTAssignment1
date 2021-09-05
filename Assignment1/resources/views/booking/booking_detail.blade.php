@extends('layouts.master')

@section('title')
    Booking Detail
@endsection

@section('content')
    <h1>Booking for {{$booking->vehicle_rego}} 📆</h1>
    <br>

    <div class="tablediv">
    <table class="table table-striped table-hover table-bordered">
    <tbody>
        <tr>
        <th>License Number</th>
        <td>{{$booking->client_drivers_license_number}}</td>
        
        </tr>
        <tr>
        <th>Booking ID</th>
        <td>{{$booking->booking_id}}</td>
        
        </tr>
        <tr>
        <th>Start Date</th>
        <td>{{$booking->start_time}}</td>
        
        </tr>
        <tr>
        <th>Return Date</th>
        <td>{{$booking->return_time}}</td>
        </tr>

    </tbody>
    </table>
    </div>
    <br>
    <a href="{{url("booking_delete/$booking->booking_id")}}">Return vehicle</a>
    
    
@endsection