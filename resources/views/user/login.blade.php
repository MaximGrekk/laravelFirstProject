@extends('layouts.layout')

@section('title')
@parent:: Login 
@endsection

@section('header')
@parent
    
@endsection

@section('content')
    <div class="container">
        <form action="{{route('login')}}" method="post">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <button type="submit" class="btn btn-primary">Send</button>
        </form>
    </div>
@endsection