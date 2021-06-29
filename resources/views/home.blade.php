@extends('layouts.layout')

@section('title')
@parent:: {{$title}} 
@endsection

@section('header')
@parent
    
@endsection

@section('content')
   

    <div class="row bg-light">
      <aside class="col-lg-3 col-md-4 col-sm-12 py-5">
        <div class="container-fluid text-align-center m-auto">
          <ul>
            <h2 class="headerLi">Рубрики</h2>
            <a href="{{route('home')}}" 
              @if(!$rubricId)
                class="activeRubric"
              @endif
              ><li>Home page</li></a>
            @if ($rubrics)
              @foreach ($rubrics as $rubric)
              <a href="{{route('postsByRubrics', $rubric->id)}}"
                {{-- {{dump($rubric->id)}} --}}
                @if (intval($rubricId) == $rubric->id){
                  class="activeRubric"
                }
                  class="activeRubric"
                @endif
                ><li>{{$rubric->title}}</li></a>
              @endforeach
            @endif
          </ul>
        </div>
      </aside>
      <div class="album py-5 col-lg-9 col-md-8 ">
        <div class="container">
          <h2 class="headerLi">Посты</h2>
          <div class="row">
            @foreach ($posts as $post)
              <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                <div class="card mb-4 box-shadow shadow">
                  <img class="card-img-top" src="{{asset('img/1.webp')}}" alt="Card image cap">
                  <div class="card-body">
                    <a href="{{route('showPost', $post->id)}}"><h3 class="card-title">{{$post->title}}</h3></a>
                    <p class="card-text">{{$post->content}}</p>
                    <div class="d-flex justify-content-between pt-3 pb-2">
                      <small><b>Рубрика: {{$post->rubric_id}}</b></small>
                      <small class="text-muted">
                          {{ $post->getPostDate() }}
                      </small>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
            <div class="col-md-12 d-flex justify-content-center">
              {{$posts->links('vendor.pagination.bootstrap-4')}}
            </div>
          </div>
        </div>
    </div>
      
    </div>
   


@endsection