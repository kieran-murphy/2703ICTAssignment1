@extends('layouts.master')

@section('title')
    Detail
@endsection

@section('content')
    <h1>Vehicle Details 🚗</h1>
    <br>
    <div class="tablediv">
    <table class="table table-striped table-hover table-bordered">
    <tbody>
        <tr>
        <th>Rego</th>
        <td>{{$vehicle->rego}}</td>
        
        </tr>
        <tr>
        <th>Model</th>
        <td>{{$vehicle->model}}</td>
        
        </tr>
        <tr>
        <th>Year</th>
        <td>{{$vehicle->year}}</td>
        
        </tr>
        <tr>
        <th>Odometer</th>
        <td>{{$vehicle->odometer}} kms</td>
        </tr>

        <tr>
        <th>Transmission</th>
        <td>{{$vehicle->transmission}}</td>
        </tr>

        <tr>
        <th>Total Times Booked</th>
        <td>{{$vehicle->bookings}}</td>
        </tr>

        <tr>
        <th>Total Days Booked</th>
        <td>{{$vehicle->booking_time}}</td>
        </tr>
    </tbody>
    </table>
    </div>
    <br>





    <h1>Current Booking 📆</h1>
    <br>
    @if ($bookings)
        
        @foreach($bookings as $booking)

            <div class="tablediv">
            <table class="table table-striped table-hover table-bordered">
            <tbody>
                
                <tr>
                <th>Drivers Licence</th>
                <td>{{$booking->client_drivers_license_number}}</td>
                
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

            
        @endforeach
        
        
    @else 
        No bookings found
        <br>
        <br>
        <a href="{{url("add_booking")}}"> Book this vehicle?</a>
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