<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">


  <title>Postz</title>

  <!-- Bootstrap core CSS -->
  <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="{{asset('css/blog-home.css')}}" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <div class="container">
      <a class="navbar-brand font-weight-bold" href="{{route('home')}}">POSTZ</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">


          <li class="nav-item active">
            <a class="nav-link" href="{{route('home')}}">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>

          

          @if(Auth::check())
          
          <!-- <li class="nav-item nav-link active">
            Hi, {{ Auth::user()->name }} 
          </li> -->
          
          <li class="nav-item">
            <a class="nav-link" href="{{route('admin.index')}}">Admin</a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="{{route('logout')}}">Logout</a>
          </li> -->


          
            <a class="nav-link" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            {{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none"> --}}
              {!! Form::open(['route'=>'logout' , 'method'=>'POST', 'class'=>'d-none' ,'id'=>'logout-form']) !!}
                @csrf
            {!! Form::close() !!}
            {{-- </form> --}}
          


            @else
          <li class="nav-item">
            <a class="nav-link" href="{{route('login')}}">Login</a>
          </li>

          

            @endif
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Blog Entries Column -->
      <div class="col-md-8">

       @yield('content')
      </div>

      <!-- Sidebar Widgets Column -->
      <div class="col-md-4">

        <!-- Search Widget -->
        <x-search-widget></x-search-widget>

        
        <!-- Categories Widget -->
        <x-home-categories-widget ></x-home-categories-widget>

      

      </div>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <x-footer></x-footer>

  <!-- Bootstrap core JavaScript -->
  <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  @yield('scripts')

</body>

</html>