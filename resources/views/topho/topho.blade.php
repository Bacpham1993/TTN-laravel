<?php
/**
 * Created by PhpStorm.
 * User: bac
 * Date: 1/31/18
 * Time: 5:55 AM
 */
?>
<html lang="en">
<title>KHOA Y DƯỢC - TOPHO</title>
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

<div class="container-fluid" id="home">


    <div class="navbar-wrapper">
        <nav class="navbar" id="mainNav">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false"
                            aria-controls="navbar">
                        <span class="sr-only">MENU</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>

                    </button>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    {!! $menu !!}
                </div>
            </div>
        </nav>
    </div>

</div>
@section('content')
    <content>
    <div class="container">

        <div class="row">
            <ol class="breadcrumb" style="background-color:white;text-align:left">
                <li class="breadcrumb-item">
                    <a href="/">Trang chủ</a>
                </li>



                <li class="breadcrumb-item active">
                     {{ $item->title }}

                </li>
            </ol>

        </div>
        <div class="row">
            {!! $item->description !!}
        </div>

    </div>



    </content>

@show
@section('footer')
    @include('../index.footer')

@show

@section('js')
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/slide.js')}}"></script>
    <script src="{{asset('js/newsTicker.js')}}"></script>





@show
</body>
</html>