<html lang="en">
   <title>KHOA Y DƯỢC - @yield('hihi')</title>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="">
		<meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="author" content="">
		<link rel="stylesheet" href="{{asset('css/app.css')}}">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link rel="stylesheet" href="{{asset('css/animate.css')}}">
        <link rel="stylesheet" href="{{asset('css/header.css')}}">
        <link rel="stylesheet" href="{{asset('css/content.css')}}">
        <link rel="stylesheet" href="{{asset('css/contact.css')}}">
        <link rel="stylesheet" href="{{asset('css/footer.css')}}">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>



    </head>
    <body>


@section('header')
@include('index.header')
@show
<div id="app">

@section('content')

@include('index.content')
@show
</div>
@section('footer')
@include('index.footer')

@show

@section('js')
		<script src="{{asset('js/app.js')}}"></script>
		<script src="{{asset('js/slide.js')}}"></script>
		<script src="{{asset('js/newsTicker.js')}}"></script>




@show
    </body>	
</html>