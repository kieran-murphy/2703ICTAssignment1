@extends('layouts.master')

@section('title')
    Delete Vehicle
@endsection
@section('content')

<form method="post" action="{{url("delete_vehicle_action")}}">
    {{csrf_field()}}
    <input type="hidden" name="rego" value="{{$vehicle->rego}}">
    <p>
        <label>Are you sure?</label>
        
    </p>
    <input type="submit" value="Yes">
</form>

@endsection
