@extends('layouts.layout')

@section('title')
@parent:: Send mail 
@endsection

@section('header')
@parent
    
@endsection

@section('content')
    <div class="container">
        <form action="/send" method="post">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Your name</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email adress</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>

            <div class="mb-3">
                <label for="text" class="form-label">Example textarea</label>
                <textarea class="form-control" id="text" rows="5" name="text"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Send</button>
        </form>
    </div>
@endsection