<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Entitle') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="{{ asset('css/sidebar2.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>

</head>

<body>
    <div id="wrapper">
    <!-- Sidebar -->

        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand"></li>
                <li>
                    <a href="{{ route('admin.group.show') }}">Groups</a>
                </li>
                <li>
                    <a href="{{ route('admin.task.show') }}">Tasks</a>
                </li>
            </ul>
        </div>

        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                    @if (!Auth::guest())

                        <a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle">
                            <i class="fa fa-bars fa-2x" aria-hidden="true"></i>
                        </a>
                    @endif

                    </div>
                    <div class="col">
                        <span class="pull-right">
                            @if (Auth::guest())

                                <a href="{{ route('login') }}">{{ __('Login') }}</a>
                            @else

                            <!-- Authentication Links -->
                            <div class="dropdown">
                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-user-circle-o fa-lg" aria-hidden="true"></i>&nbsp;{{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="{{ route('logout') }}"><i class="fa fa-btn fa-sign-out"></i>{{ __('Logout') }}</a>
                                    <form class="dropdown-item" id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf

                                    </form>
                                </div>
                            </div>
                            @endif

                        </span>
                    </div>
                </div>
                @yield('content')

            </div>
        </div>
    </div>
    
    <!-- JavaScripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>

    <script>

        $(document).ready(function() {
            $('.summernote').summernote();
        });
        
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });

        $(function() {
            // setTimeout() function will be fired after page is loaded
            // it will wait for 2 sec. and then will fire
            // $("#savedMessage").hide() function
            setTimeout(function() {
                $("#savedMessage").hide('blind', {}, 200)
            }, 2000);
        });
    </script>

</body>
