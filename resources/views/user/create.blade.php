@extends('layouts.layout')

@section('title')
@parent:: Registration 
@endsection

@section('header')
@parent
    
@endsection

@section('content')
    <div class="container">
        <form action="{{route('register.store')}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Your name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>

            <button type="submit" class="btn btn-primary">Send</button>
        </form>
    </div>
@endsection