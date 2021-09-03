@extends('layouts.master')

@section('title')
    Clients
@endsection

@section('content')
<h1>Clients</h1>
    @if ($clients)
        <ul>
        @foreach($clients as $client)
            <li><a href="{{url("client_detail/$client->drivers_license_number")}}">{{$client->name}}</a></li>
        @endforeach
        </ul>
        <br>
        <a href="{{url("add_client")}}">Add New Client</a>
    @else 
        No clients found
    @endif
@endsection
    
