<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Bootstrap core CSS -->
    <link href="{{asset('startbootstrap-modern-business/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{asset('startbootstrap-modern-business/css/modern-business.css')}}" rel="stylesheet">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script> 
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script> -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
</head>
<body>
    @yield('content')
    @yield('script')
    <!-- Bootstrap core JavaScript -->
    <script src="{{asset('startbootstrap-modern-business/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('startbootstrap-modern-business/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>
</body>
</html>