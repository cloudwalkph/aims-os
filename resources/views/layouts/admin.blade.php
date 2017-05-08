<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'AIMS') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/toastr/build/toastr.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.steps.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

    @if(session('token'))
        <script>
            window.token = '{{ session('token') }}'
        </script>
    @endif
</head>
<body>
    @yield('styles')
    <div id="app">

        <nav class="navbar navbar-default navbar-fixed-top topbar" role="navigation">
            <div class="navbar-header">
                <a class="navbar-brand" href="/" >A.I.M.S.</a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">LOGIN</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->profile->full_name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/profile"> <span class="fa fa-user"></span> Profile</a></li>
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    <span class="fa fa-sign-out"></span>
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li id="dashboard">
                        <a href="/admin"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li id="accounts">
                        <a href="/admin/users"><i class="fa fa-fw fa-users"></i> Users</a>
                    </li>
                    <li id="agencies">
                        <a href="/admin/agencies"><i class="fa fa-fw fa-book"></i> Agency</a>
                    </li>
                    <li id="manpower-types">
                        <a href="/admin/manpower-types"><i class="fa fa-fw fa-wrench"></i> Manpower Types</a>
                    </li>
                    <li id="vehicle-types">
                        <a href="/admin/vehicle-types"><i class="fa fa-fw fa-truck"></i> Vehicle Types</a>
                    </li>
                    <li id="vehicle-types">
                        <a href="/admin/job-orders"><i class="fa fa-fw fa-book"></i> Job Orders</a>
                    </li>

                    <li id="vehicle-types">
                        <a href="/admin/validate"><i class="fa fa-fw fa-check-square-o"></i>Validate</a>
                    </li>
                    {{--<li>--}}
                        {{--<a href="javascript:;" data-toggle="collapse" data-target="#demo">--}}
                            {{--<i class="fa fa-fw fa-check-square-o" href="/admin/validate"></i> Validate <i class="fa fa-fw fa-caret-down"></i>--}}
                            {{--<ul id="demo" class="collapse" aria-expanded="true">--}}
                                {{--<li>--}}
                                    {{--<a href="/admin/validate">Validation List</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<a href="/evaluate">Evaluate</a>--}}
                                {{--</li>--}}
                            {{--</ul>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                </ul>
            </div>
        </nav>

        <div id="wrapper">
            <div id="page-wrapper" style="min-height: 765px;">
                <div class="container-fluid" style="margin-top: 50px">
                    @yield('content')
                </div>
            </div>
        </div>

    </div>

    <!-- Scripts -->
    @yield('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery-3.2.0.min.js') }}"></script>
    <script src="{{ asset('js/jquery.steps.js') }}"></script>

    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>
</body>

<!--@yield('c3scripts');-->
@yield('google_charts');

</html>
