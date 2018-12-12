<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name') }}</title>

    <link href="{{ asset('favicon.ico') }}" rel="icon">

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet">
    <link href="{{ asset('assets/css/icons/icomoon/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/core.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/components.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/colors.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
    @yield('plugin-css')
    <!-- /global stylesheets -->
</head>

@php
    $body_class = $classes['body'] ?? '';
    $current_user = auth()->user();
@endphp

<body class="{{ !empty($has_sticky_sidebar) ? '' : 'navbar-top' }}{{ $body_class }}">
    <div class="navbar navbar-inverse bg-indigo{{ !empty($has_sticky_sidebar) ? '' : ' navbar-fixed-top' }}">
        <div class="navbar-header">
            <a class="navbar-brand text-semibold" href="{{ route('home') }}">{{ config('app.name', 'Hamlet') }}</a>

            <ul class="nav navbar-nav pull-right visible-xs-block">
                <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            </ul>
        </div>

        <div class="navbar-collapse collapse" id="navbar-mobile">
            <ul class="nav navbar-nav">
                <li><a href="#">Text link</a></li>

                <li>
                    <a href="#">
                        <i class="icon-calendar3"></i>
                        <span class="visible-xs-inline-block position-right">Icon link</span>
                    </a>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <p class="navbar-text"><span class="label bg-success-400">Online</span></p>

                <li>
                    <a href="#">
                        <i class="icon-cog3"></i>
                        <span class="visible-xs-inline-block position-right">Icon link</span>
                    </a>
                </li>

                <li class="dropdown dropdown-user">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        <span class="greeting">Morning</span>, {{ $current_user->full_name }}
                        <i class="caret"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href=""><i class="icon-user-plus"></i> My profile</a></li>
                        <li><a href="{{ route('logout') }}" data-method="post"><i class="icon-switch2"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

    <div class="page-container">
        <div class="page-content">
            <div class="content-wrapper">
                <!-- Page header -->
                <div class="page-header page-header-default">
                    <div class="page-header-content">
                        <div class="page-title">
                            <h4><i class="{{ $module['icon'] }} position-left"></i> <span class="text-semibold">{{ $module['name'] }}</span></h4>
                        </div>
                        @yield('heading-elements')
                    </div>

                    @if (!empty($breadcrumbs))
                        <div class="breadcrumb-line">
                            <ul class="breadcrumb">
                                <li><a href="{{ route('home') }}"><i class="icon-home2 position-left"></i> Home</a></li>
                                @foreach ($breadcrumbs as $part)
                                    @if (is_array($part))
                                        <li><a href="{{ $part['url'] }}">{{ $part['label'] }}</a></li>
                                    @elseif (is_string($part))
                                        <li class="active">{{ $part }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <!-- /page header -->

                <!-- Content area -->
                <div class="content">
                    @yield('content')
                </div>
                <!-- /content area -->
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include('partials.footer', ['class' => 'absolute-center-20'])
    <!-- /footer -->

    <!-- Core JS files -->
    <script src="{{ asset('assets/js/plugins/pace.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/libraries/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/libraries/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/blockui.min.js') }}"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    @yield('plugin-scripts')
    <script src="{{ asset('assets/js/core/app.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/ripple.min.js') }}"></script>
    <!-- /theme JS files -->

    <script src="{{ asset('assets/js/custom/main.js') }}"></script>
    @yield('page-script')
</body>
</html>
