@extends('layouts.master')

@section('title')
    Fleet
@endsection

@section('content')
<h1>Vehicles</h1>
    @if ($items)
        <ul>
        @foreach($items as $item)
            <li><a href="{{url("item_detail/$item->model")}}">{{$item->rego}}</a></li>
        @endforeach
        </ul>
        <br>
        <a href="{{url("add_item")}}">Add New Item</a>
    @else 
        No item found
    @endif
@endsection
    
