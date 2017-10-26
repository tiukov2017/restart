<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>CheckNet</title>

    <!-- Fonts -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="//fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.rawgit.com/morteza/bootstrap-rtl/v3.3.4/dist/css/bootstrap-rtl.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

    @yield('styles')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/globals.js') }}" class="script" ></script>


</head>
<body id="app-layout" data-spy="scroll" data-target="#report-nav" data-offset="200">

    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    CheckNet
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/') }}">{{trans('menus.home')}}</a></li>
                   @role('admin')
                    <li><a href="{{route('domains')}}">{{trans('menus.manage_domains')}}</a></li>
                       @endrole

                    @role('admin')
                    <li><a href="{{route('users')}}">{{trans('menus.manage_users')}}</a></li>
                    @endrole
                </ul>
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">{{trans('menus.login')}}</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>{{trans('menus.logout')}}</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    @yield('scripts')

    <script>
        (function() {
            $(document).ready(function () {

                $('.status-hover').tooltip({trigger: "hover"});
                $('body').scrollspy({
                    target: "#report-nav", offset: 200});

                $(document).find('.navigation').find('.active').removeClass('active');
                $(document).on('click', '.report-nav-link', reportNavigate);

                $('.single_page').on('click', function () {
                    $('.single_page').each(function () {
                        $(this).removeClass('active')
                    });
                    $(this).addClass('active');
                });
            });
            /** @desc fix the anchor lnks to be offseted with the fixed navbar height */
            function reportNavigate(event) {
                event.preventDefault();
                var offTop = $($(this).attr('href')).offset().top - 110;
                $(window).scrollTop(offTop);
            }
        })(jQuery);

    </script>

</body>
</html>
