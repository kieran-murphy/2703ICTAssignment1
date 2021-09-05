@extends('layouts.master')

@section('title')
    Delete Client
@endsection
@section('content')

<h1>Delete Client 🧑🚫</h1>
<br>

<form method="post" action="{{url("delete_client_action")}}">
    {{csrf_field()}}
    <input type="hidden" name="drivers_license_number" value="{{$client->drivers_license_number}}">
    <p>
        <label>Are you sure?</label>
        
    </p>
    <input type="submit" value="Yes">
</form>

@endsection
