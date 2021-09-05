@extends('layouts.master')

@section('title')
    Detail
@endsection

@section('content')
    @if ($client->gender == 'Male')
        <h1>{{$client->name}} 👨</h1>
    @elseif ($client->gender == 'Female')
        <h1>{{$client->name}} 👩</h1>
    @elseif ($client->gender == 'Other')
        <h1>{{$client->name}} 🧑</h1>
    @endif
    <br>
    <div class="tablediv">
    <table class="table table-striped table-hover table-bordered">
    <tbody>
        <tr>
        <th>License Number</th>
        <td>{{$client->drivers_license_number}}</td>
        
        </tr>
        <tr>
        <th>Type</th>
        <td>{{$client->license_type}}</td>
        
        </tr>
        <tr>
        <th>Age</th>
        <td>{{$client->age}}</td>
        
        </tr>
        <tr>
        <th>Gender</th>
        <td>{{$client->gender}}</td>
        </tr>
    </tbody>
    </table>
    </div>
    <br>
    <a href="{{url("client_update/$client->drivers_license_number")}}">Update client</a>
    <br>
    <br>
    <a href="{{url("client_delete/$client->drivers_license_number")}}">Delete client</a>
    
    
@endsection