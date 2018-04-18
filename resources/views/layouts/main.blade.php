<html>
    <head>
        <title>Ticketing System</title>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <link rel="stylesheet" href="{{ asset('css/main.css') }}">

        <!-- REQUIRED ICONS FOR TEXT EDITOR -->
        <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet" />
        <!-- TEXT EDITOR STYLES -->
        <link href="{{ asset('css/summernote.css') }}" rel="stylesheet" />

        <!-- datatables --->
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

        <script src="/js/summernote.js"></script>
         <!-- REQUIRED SCRIPT FOR TEXT EDITOR -->
        <script>
            $(document).ready(function () {
                $('#data-table').DataTable();

                $('#pContent, .myTextArea').summernote({
                    height: 200,// set height for editor
                });

                setInterval(function(){
                    $("#ticketCount").load('/tickets')
                }, 2000);
            });
        </script>
    </head>
    <body>
        @section('header')
        <div class="header">
        	<div class="col-md-3">
            @guest
        		    <a href="{{ route('register') }}"><span class="glyphicon glyphicon-user"></span> Sign Up</a>&nbsp;&nbsp;
        		    <a href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in"></span> Login</a>&nbsp;&nbsp;
            @else
                <a href="users/{{ Auth::user()->id }}"><span class="glyphicon glyphicon-user"></span> {{ Auth::user()->name }} </a>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <span class="glyphicon glyphicon-off"></span> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            @endguest
        	</div>
        	<div class="col-md-6"><p class="title">@yield('pageTitle')</p></div>
        	<div class="col-md-3 pull-left">
        		<form action="/search_results" method="post">
        			<label>Search</label>
        			<input type="text" name="searchText" class="form-input">
        			<button class="btn btn-success"><span class="glyphicon glyphicon-search"></span></button>
        		</form>
        	</div>
        </div>
        @show

        <div class="container">
          @section('sidebar')
            <div class="col-md-3 pull-left">
              <h3>Menu</h3>
              <ul>
                <li><a href="/"><span class="glyphicon glyphicon-home"></span> Dashboard</a></li>
              </ul>
           </div>
          @show

          <div class="col-md-9">
            @yield('content')
          </div>

      </div>

      <!---<div class="footer"><p><?php //echo "&copy; Nkonye Oyewusi ".date('Y'); ?></p></div>--->

    </body>

  </html>
