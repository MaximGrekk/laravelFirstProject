<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>@section('title')My site @show</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/album/">


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">


    <link href="{{asset('css/styles.css')}}" rel="stylesheet"> 
    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet"> 
    <link href="{{asset('css/main.css')}}" rel="stylesheet"> 
  </head>

  <body class="bg-light">
    <header>
        @section('header')
          <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
              <a class="navbar-brand" href="{{route('home')}}">MaximGrekk's blog</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a  
                    @if (Route::current()->getName() == "home")
                      aria-current="page"
                      class="nav-link active"
                    @else
                      class="nav-link"
                    @endif
                    href="{{route('home')}}">Домой</a>
                  </li>
                  <li class="nav-item">
                    <a 
                    @if (Route::current()->getName() == "page.about")
                      aria-current="page"
                      class="nav-link active"
                    @else
                      class="nav-link"
                    @endif
                    href="{{route('page.about')}}">О проекте</a>
                  </li>
                  @auth
                    <li class="nav-item">
                      <a 
                      @if (Route::current()->getName() == "posts.create")
                        aria-current="page"
                        class="nav-link active"
                      @else
                        class="nav-link"
                      @endif 
                      href="{{route('posts.create')}}">Создать пост</a>
                    </li>
                  @endauth
                  <li class="nav-item">
                    <a 
                    @if (Route::current()->getName() == "send")
                      aria-current="page"
                      class="nav-link active"
                    @else
                      class="nav-link"
                    @endif
                    href="{{route('send')}}">Связаться</a>
                  </li>
                  @auth
                  <li class="nav-item">
                    <a 
                    @if (Route::current()->getName() == "logout")
                      aria-current="page"
                      class="nav-link active"
                    @else
                      class="nav-link"
                    @endif
                    href="{{route('logout')}}">Выйти</a>
                  </li>
                  @endauth
                  @guest
                  <li class="nav-item">
                    <a 
                    @if (Route::current()->getName() == "register.create")
                      aria-current="page"
                      class="nav-link active"
                    @else
                      class="nav-link"
                    @endif
                    href="{{route('register.create')}}">Регистрация</a>
                  </li>
                  <li class="nav-item">
                    <a 
                    @if (Route::current()->getName() == "login.create")
                      aria-current="page"
                      class="nav-link active"
                    @else
                      class="nav-link"
                    @endif
                    href="{{route('login.create')}}">Войти</a>
                  </li>
                  @endguest
                
                </ul>
              </div>
            </div>
          </nav>
      @show
    </header>
    
    <main role="main" class="bg-light">

      <div class="container">
        @include('layouts.alerts')
      </div>

      @yield('content')

    </main>

    @include('layouts.footer')


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="{{asset('js/scripts.js')}}"></script>
  </body>
</html>