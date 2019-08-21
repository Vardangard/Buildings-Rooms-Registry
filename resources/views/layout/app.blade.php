<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Pastatų-Patalpų Registras</title>
        <!-- Custom Style -->
        <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
        <!-- VDU Bootstrap --> 
        <link rel="stylesheet" href="https://resources.vdu.lt/bootstrap/4.0.0-beta.3/css/bootstrap.min.css">
        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
        <!-- Select2 -->
        <link href="{{ URL::asset('/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
        <script src="{{ URL::asset('/select2/dist/js/select2.min.js') }}"></script>
        <!-- Datatables -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
        <!-- Font -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      

    </head>
    <body>
        @include('inc.nav')
        <div class="container-fluid">
            @yield('content')
        </div>

        <footer class="footer">
            <div class="container">
                <div class="text-right">{{ Carbon::now('Europe/Vilnius') }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Prisijungė: {{ Auth::user()->name }}</div>
            </div>
        </footer>
        
        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
        <!-- Ajax -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <!-- Bootstrap VDU Js -->
        <script src="https://resources.vdu.lt/bootstrap/4.0.0-beta.3/js/bootstrap.min.js"></script>
        <!-- Datatables -->
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    </body>
</html>
