@extends('layouts.master')

@section('title')
    Update Client
@endsection
@section('content')

@if ($client->gender == 'Male')
        <h1>Update {{$client->name}} 👨</h1>
    @elseif ($client->gender == 'Female')
        <h1>Update {{$client->name}} 👩</h1>
    @elseif ($client->gender == 'Other')
        <h1>Update {{$client->name}} 🧑</h1>
    @endif
    <form method="post" action="{{url("update_client_action")}}">
    {{csrf_field()}}
    <br>
    <input type="hidden" name="drivers_license_number" value="{{$client->drivers_license_number}}">
    <div class="form-group">
        <label for="exampleFormControlInput1">Name</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" name="name" value="{{$client->name}}">
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect1">License Type</label>
        <select class="form-control" id="exampleFormControlSelect1" name="license_type">
        <option>Automatic</option>
        <option>Manual</option>
        </select>
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Age</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" name="age" value="{{$client->age}}">
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect1">Gender</label>
        <select class="form-control" id="exampleFormControlSelect1" name="gender">
        <option>Male</option>
        <option>Female</option>
        <option>Other</option>
        </select>
    </div>
    <input type="submit" value="Update">
    
    
    </form>

@endsection
