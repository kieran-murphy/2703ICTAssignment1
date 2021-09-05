@extends('layouts.master')

@section('title')
    Bookings
@endsection

@section('content')
<h1>Bookings 📆</h1>
    @if ($bookings)
        <br>
        <div class="tablediv">
        <div class="list-group">
        @foreach($bookings as $booking)
            <a href="{{url("booking_detail/$booking->booking_id")}}" class="list-group-item list-group-item-action">{{$booking->vehicle_rego}}</a>
        @endforeach
        </div>
        </div>
        <br>
        
    @else 
        <br>
        No bookings found
        <br>
        <br>
        
    @endif
    <a href="{{url("add_booking")}}">Add New Booking</a>
@endsection
    
