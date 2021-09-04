@extends('layouts.master')

@section('title')
    Bookings
@endsection

@section('content')
<h1>Bookings</h1>
    @if ($bookings)
        <ul>
        @foreach($bookings as $booking)
            <li><a href="{{url("booking_detail/$booking->booking_id")}}">{{$booking->vehicle_rego}}</a></li>
        @endforeach
        </ul>
        <br>
        
    @else 
        No bookings found
    @endif
    <a href="{{url("add_booking")}}">Add New Booking</a>
@endsection
    
