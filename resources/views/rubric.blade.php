@extends('layouts.layout')

@section('title')
@parent:: {{$title}} 
@endsection

@section('header')
@parent
    
@endsection

@section('content')
   
    <section class="jumbotron text-center">
        <div class="container">
            {{-- {!! mb_strtoupper($h1) !!} --}}
            @php echo $title @endphp
        </div>
    </section>

    <div class="row bg-light">
      <div class="album py-5 col-md-9">
        <div class="container">
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
          </div>
        </div>
    </div>
      <aside class="col-md-3 py-5">
        <div class="container">
          <ul>
            <li><a href="{{route('home')}}" 
              @if(!$rubricId)
                class="activeRubric"
              @endif
              >Home page</a></li>
            @if ($rubrics)
              @foreach ($rubrics as $rubric)
                <li><a href="{{route('postsByRubrics', $rubric->id)}}"
                  @if (intval($rubricId) === $rubricId)
                    class="activeRubric"
                  @endif
                  >{{$rubric->title}}</a></li>
              @endforeach
            @endif
          </ul>
        </div>
      </aside>
    </div>
   


@endsection