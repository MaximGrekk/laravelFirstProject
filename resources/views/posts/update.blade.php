@extends('layouts.layout')

@section('title')
@parent:: Обновление поста
@endsection

@section('header')
@parent
    
@endsection
 
@section('content')

    <div class="container mt-5 mb-5">
        <form method="POST" action="{{ route('updatePostCreate', $post->id) }}">
            @csrf
            <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control
            @error('title') is-invalid @enderror" id="title" placeholder="Title" name="title" value="{{$post->title}}">
            @error('title')
                <div class="invalid-feedback"> {{$message}} </div>
            @enderror
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control  @error('content') is-invalid @enderror" id="content" rows="5" name="content" placeholder="Content...">{{$post->content}}</textarea>
                @error('content')
                <div class="invalid-feedback"> {{$message}} </div>
            @enderror
            </div>
            <div class="form-group">
            <label for="rubric_id">Rubric</label>
            <select class="form-control  @error('rubric_id') is-invalid @enderror" id="rubric_id" name="rubric_id">
                <option>Select rubric</option>
                @foreach ($rubrics as $k => $v)
                    <option value="{{$k}}"
                    @if ($post->rubric_id == $k) selected
                        
                    @endif
                    {{($post->title === $v) ? 'Selected' : ''}}>{{ $v }} </option>
                @endforeach
            </select>
            @error('rubric_id')
                <div class="invalid-feedback"> {{$message}} </div>
            @enderror
            </div>

            <button type="submit" class="btn btn-primary">Обновить</button>
        </form>   
    </div>

@endsection