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
    <link href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.steps.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/toastr/build/toastr.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('vendor/ion.rangeSlider/css/ion.rangeSlider.css') }}" rel="stylesheet"/>
    <link href="{{ asset('vendor/ion.rangeSlider/css/ion.rangeSlider.skinFlat.css') }}" rel="stylesheet"/>
    <link href="{{ asset('vendor/ion.rangeSlider/css/normalize.css') }}" rel="stylesheet"/>

    <style>
        .wizard ul, .tabcontrol ul{
            display: none;
        }
        .wizard.vertical > .content{
            margin-left: 169px;
            width: 76%;
        }
        .wizard.vertical > .actions {
            text-align: center;
        }
        .wizard > .content > .body{
            font-size: 17px;
        }
    </style>

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
    @yield('styles')
    <script src="//localhost:6001/socket.io/socket.io.js"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default topbar" role="navigation">
            <div class="navbar-header">
                <a class="navbar-brand" href="/" >A.I.M.S.</a>
            </div>

            <ul class="nav navbar-nav navbar-right">

                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o" style="font-size: 20px;"></i>
                        <span class="label label-danger hide" style="font-size: 14px;" id="notificationCount">10</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 200px;">
                                <ul class="menu" style="overflow: hidden; width: 100%; height: 200px;">
                                    {{--<li>--}}
                                        {{--<a href="#">--}}
                                            {{--<i class="fa fa-users text-primary"></i> 5 new members joined today--}}
                                        {{--</a>--}}
                                    {{--</li>--}}
                                </ul>
                            </div>
                        </li>
                        <li class="footer"><a href="#">View all</a></li>
                    </ul>
                </li>

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
        </nav>

        <div class="container-fluid">
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
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
    @if (! Auth::guest())
    <script>
        let userId = '{{ Auth::user()->id }}';
//        console.log(userId);
        (function() {
            let notifSound = new Audio('/sounds/notification.mp3');
            let newNotifications = 0;
            let $notificationCount = $('#notificationCount');
            let $notificationMenu = $('.notifications-menu');
            let $notificationItems = $('.notifications-menu .dropdown-menu ul');

            Echo.private('App.User.' + userId)
                .notification((notification) => {
                    console.log(notification.type);
                    console.log(notification);

                    notifSound.play();
                    switch (notification.type) {
                        case 'App\\Notifications\\NewJobOrderAssignment':
                            toastr.info(notification.message);
                            newNotifications++;

                            createNotificationItem(notification);
                            checkNotification();
                            break;
                    }
                });

            $notificationMenu.on('click', function() {
                newNotifications = 0;
                checkNotification();
            });

            function checkNotification() {
                $notificationCount.html(newNotifications);

                if (newNotifications > 0) {
                    showNotificationLabel();

                    return;
                }

                hideNotificationLabel();
            }

            function createNotificationItem(notification) {
                let item = '<li>' +
                    '<a href="#">' +
                        notification.message +
                    '</a>' +
                '</li>';

                $notificationItems.prepend(item);
            }

            function hideNotificationLabel() {
                $notificationCount.addClass('hide');
            }

            function showNotificationLabel() {
                $notificationCount.removeClass('hide');
            }
        })();
    </script>
    @endif

    @yield('scripts')
</body>
</html>
