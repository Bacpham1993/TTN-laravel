<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('css/sb-admin.css') }}" rel="stylesheet">
	<link href="{{asset('css/AdminLTE.min.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">


	
</head>
<body>
@guest
 <div id="app">
	
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">CPANEL</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/admin') }}">
                        {{ config('app.name', '') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        
                            <li><a href="/">Trang chủ</a></li>
	@else
    <div id="wrapper">
	
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">CPANEL</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/admin') }}">
                        {{ config('app.name', '') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                         {{--<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu alert-dropdown">
                        <li>
                            <a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-primary">Alert Badge</span></a>
                        </li>
                     
                        <li class="divider"></li>
                        <li>
                            <a href="#">View All</a>
                        </li>
                    </ul>
                </li>--}}
                            
                            
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Đăng xuất
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
							
                        
                    </ul>
                </div>
            </div>
			            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="{{ url('/admin') }}"><i class="fa fa-fw fa-dashboard"></i> TỔNG QUAN</a>
                    </li>
                    <li>
                
                    <li>
                        <a href="{{ url('/admin/users') }}"><i class="fa fa-fw fa-user"></i> TÀI KHOẢN</a>
                    </li>

                            <li>
                                <a href="{{ url('admin/news')}}"><i class="fa fa-fw fa-book"></i> TIN TỨC CHUNG</a>
                            </li>
                            <li>
                                <a href="{{ url('admin/banners') }}"><i class="fa fa-fw fa-calendar"></i> SỰ KIỆN</a>
                            </li>

                    <li>
                        <a href="{{ url('admin/menus') }}"><i class="fa fa-fw fa-list"></i> MENU</a>
                    </li>
                 
                </ul>
            </div>
            <!-- /.navbar-collapse -->
			@endguest
        </nav>
		

        <div id="page-wrapper">

        @yield('content')
		</div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
   <script src="{{asset('js/tinymce/tinymce.min.js')}}"></script>
<script>
tinymce.init({

              editor_selector : "mceEditor",


              selector: '#mytextarea',
              language: 'vi_VN',

              plugins: [

                        'advlist autolink lists link image charmap print preview hr anchor pagebreak',

                        'searchreplace wordcount visualblocks visualchars code fullscreen',

                        'insertdatetime media nonbreaking save table contextmenu directionality',

                            'emoticons template paste textcolor colorpicker textpattern imagetools'

                          ],

                          toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | responsivefilemanager',

                          toolbar2: 'print preview media | forecolor backcolor emoticons',

                          image_advtab: true,

                        templates: [

                            { title: 'Test template 1', content: 'Test 1' },

                            { title: 'Test template 2', content: 'Test 2' }

                          ],
                        image_dimensions: false,
                        image_class_list: [
                            {title: 'Responsive', value: 'img-responsive'},
                            {title: 'None', value: ''}
                        ],

});
</script>
	@yield('page-js-script')

</body>
</html>
