@extends('layouts.app')

@section('content')

<div class="container">
  <ul class="navbar-nav mr-auto ">
    
    <a class="btn btn-secondary btn-lg col-md-6 m-0 p-0" href="{{ route('tables') }}">Check your stored search </a>
    <br>
    <form class="form-inline my-2 my-lg-0" action="{{ route('form') }}" method="POST" role="search" style="margin-right: 20px">
          {{ csrf_field() }}
          
          <input class="form-control mr-sm-2 searchbar" type="search" placeholder="Use your IČO" aria-label="Search" name="q">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
      
        
  </ul>
<div>
<br>
<div class="search">
    @if(isset($firma))
    <p> The Search result for your query <b> {{ $query }} </b> is :</p>
    <h2>Company Information</h2>
    {{-- <form action="/ico/guardar" method="post"> --}}
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Description</th>
          <th>Values</th>
        </tr>
      </thead>
      <tbody>
        {{-- @foreach($ulice as $new_ico)  --}}
        <tr>
          {{-- <td><a href="beers/{{ $beer->id }}">{{$beer->product_name}}</a></td> --}}
          <th>Company Name</th>
          <td>{{$firma}}</td>
          {{-- <td><input type="text" name="{{$firma}}" ></td> --}}
          
          
        </tr>
        <tr>
            {{-- <td><a href="beers/{{ $beer->id }}">{{$beer->product_name}}</a></td> --}}
            <th>Address</th>
            <td>{{$ulice}}</td>
            {{-- <td><input type="text" name="{{$ulice}}" ></td> --}}
        </tr>
        <tr>
            {{-- <td><a href="beers/{{ $beer->id }}">{{$beer->product_name}}</a></td> --}}
            <th>City</th>
            <td>{{$mesto}}</td>
            {{-- <td><input type="text" name="{{$mesto}}" ></td> --}}
            
        </tr>
        <tr>
            {{-- <td><a href="beers/{{ $beer->id }}">{{$beer->product_name}}</a></td> --}}
            <th>Postcode</th>
            <td>{{$psc}}</td>
            {{-- <td><input type="text" name="{{$psc}}" ></td> --}}
            
        </tr>
        <tr>
            {{-- <td><a href="beers/{{ $beer->id }}">{{$beer->product_name}}</a></td> --}}
            <th>IČO</th>
            <td>{{$dic}}</td>
            {{-- <td><input type="text" name="{{$dic}}" ></td> --}}
        </tr>
        {{-- @endforeach --}}
      </tbody>
    </table>
    {{-- </form> --}}
    @elseif(isset($message))
    <p>{{ $message }}</p>
    @endif
  </div>
@endsection