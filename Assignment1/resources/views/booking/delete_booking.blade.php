@extends('layouts.master')

@section('title')
    Delete Booking
@endsection
@section('content')

<form method="post" action="{{url("delete_booking_action")}}">
    {{csrf_field()}}
    <input type="hidden" name="booking_id" value="{{$booking->booking_id}}">
    <input type="hidden" name="vehicle_rego" value="{{$booking->vehicle_rego}}">
    <input type="hidden" name="odometer" value="{{$vehicle->odometer}}">
    
    <div class="form-group">
        <label for="exampleFormControlInput1">Distance Travelled: </label>
        <input type="text" class="form-control" id="exampleFormControlInput1" name="added_kms" placeholder="Kilometers">
    </div>

    <p>
  
    </p>
    <input type="submit" value="Return">
</form>

@endsection
