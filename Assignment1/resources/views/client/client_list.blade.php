@extends('layouts.master')

@section('title')
    Clients
@endsection

@section('content')
<h1>Clients 🧑🧑🧑</h1>
<br>
    @if ($clients)
        <div class="tablediv">
        <div class="list-group">
        @foreach($clients as $client)
            <a href="{{url("client_detail/$client->drivers_license_number")}}" class="list-group-item list-group-item-action">{{$client->name}}</a>
        @endforeach
        </div>
        </div>
        <br>
        <br>
        <a href="{{url("add_client")}}">Add New Client</a>
        
    @else 
        No clients found
    @endif
@endsection
    
