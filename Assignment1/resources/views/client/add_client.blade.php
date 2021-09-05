@extends('layouts.master')

@section('title')
    Add Client
@endsection

@section('content')
    <h1>Add Client 🧑</h1>
    <form method="post" action="{{url("add_client_action")}}">
    {{csrf_field()}}
    <br>
    <div class="form-group">
        <label for="exampleFormControlInput1">Name</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" name="name" placeholder="Name">
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Drivers License Number</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" name="drivers_license_number" placeholder="Drivers License Number">
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
        <input type="text" class="form-control" id="exampleFormControlInput1" name="age" placeholder="Age">
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect1">Gender</label>
        <select class="form-control" id="exampleFormControlSelect1" name="gender">
        <option>Male</option>
        <option>Female</option>
        <option>Other</option>
        </select>
    </div>
    <input type="submit" value="Add">
    
    
    </form>

@endsection
    
