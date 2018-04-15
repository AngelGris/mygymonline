<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>My Gym online</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/octicons/4.4.0/font/octicons.css" />
        <link href="{{ asset('/css/styles.css') }}" rel="stylesheet" />
        @yield('styles')
    </head>
    <body>
        <div class="main-header row">
            <div class="col-sm-3">My Gym online</div>
            <div class="col-sm-9">
                <ul class="header-links">
                    <li data-toggle="tooltip" data-placement="bottom" title="Users"><a href="{{ route('users') }}"><span class="mega-octicon octicon-organization"></span></a></li>
                    <li data-toggle="tooltip" data-placement="bottom" title="Plans"><a href="{{ route('plans') }}"><span class="mega-octicon octicon-repo"></span></a></li>
                    <li data-toggle="tooltip" data-placement="bottom" title="Dashboard"><a href="{{ route('home') }}"><span class="mega-octicon octicon-settings"></span></a></li>
                </ul>
            </div>
        </div>
        <div class="main-wrapper">
            @yield('content')
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
        <script src="{{ asset('/js/scripts.js') }}"></script>
        @yield('scripts')
    </body>
</html>
