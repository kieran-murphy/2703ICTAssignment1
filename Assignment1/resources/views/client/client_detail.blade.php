@extends('layouts.master')

@section('title')
    Detail
@endsection

@section('content')
    <h1>{{$client->name}}</h1>
    <br>
    <p>License Number: {{$client->drivers_license_number}}</p>
    <p>Type: {{$client->license_type}}</p>
    <p>Age: {{$client->age}}</p>
    <p>Gender: {{$client->gender}}</p>
    <br>
    <a href="{{url("client_update/$client->drivers_license_number")}}">Update client</a>
    <br>
    <br>
    <a href="{{url("client_delete/$client->drivers_license_number")}}">Delete client</a>
    
    
@endsection