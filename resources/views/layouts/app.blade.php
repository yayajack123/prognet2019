<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
        @php
        $jum = DB::table('admin_notifications')->where('read_at',NULL)->count();
        $notif = DB::table('admin_notifications')->where('read_at',NULL)->get();
        @endphp
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.3/css/bootstrap-select.min.css">

    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/admin') }}">
                    Shop Admin
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <li class="dropdown" id ="markasread" onclick="markNotificationAsRead()">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                      <span class="glyphicon glyphicon-globe"></i> notification
                      <span class="badge">{{count(auth()->user()->unreadNotifications)}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <center><button id="readnotif"><a  style="color: green;">----Mark All As Read---</a></button></center>
                        @foreach($notif as $notif)
                           <li><a href="#"> {!!$notif->data!!}</a></li>
                        @endforeach
                    </ul>
                </li>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/kategori">Kategori</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/produk">Produk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/kurir">Kurir</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/transactionAdmin">Transaksi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/response">Response</a>
                        </li>
                    </ul>
                    

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#readnotif').click(function(){
            console.log("terklik");
            var baseUrl = window.location.protocol+"//"+window.location.host;
            $.ajax({
                  url: baseUrl+'/admin/markReadAdmin',  
                  type : 'post',
                  dataType: 'JSON',
                  data: {
                    "_token": "{{ csrf_token() }}",
                    
                    },
                  success:function(response){
                        location.reload();
                  },
                  error:function(){
                    alert("GAGAL");
                  }

              });
        });
    });
</script>
</html>
