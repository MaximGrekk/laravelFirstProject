@extends('layouts.layout')

@section('title')
@parent:: Пост {{$post->id}}
@endsection

@section('header')
@parent
    
@endsection

@section('content')


   

    <div class="row bg-light">
      
      <div class="album py-5 col-lg-12 col-xl-8 offset-xl-2">
        <div class="container-fluid">
          <h2 class="text-center h1">{{$post->title}}</h2>
          <article class="border px-5 pt-5 mt-5 mb-3 shadow">
            <p class="text-center" style="font-size: 20px">{{$post->content}}</p>
            <div class="d-flex justify-content-between pt-3 pb-2">
              <div>
                <p style="margin: 0;" class="text-muted"><small><b>Рубрика: {{$post->rubric_id}}</b></small></p>
                <small>Author: {{$author->name}}</small>
              </div>
                
                <small class="text-muted">
                    {{ $post->getPostDate() }}
                </small>
            </div>
          </article>
          <a href="{{ url('/') }}" class="btn btn-secondary btn-lg col-12" role="button" aria-pressed="true">Назад</a>
          <div class="d-flex justify-content-center mt-2">
            @can('update', $post)
              <a href="{{ route('updatePost', $post->id) }}" class="btn btn-warning btn-lg col-5" role="button" aria-pressed="true">Редактировать</a>
            @endcan
            @can('delete', $post)
            <a href="{{ route('deletePost', $post->id) }}" class="btn btn-danger btn-lg col-5 offset-2" role="button" aria-pressed="true">Удалить</a>
            @endcan
          </div>
        </div>
    </div>
      
    </div>
   


@endsection