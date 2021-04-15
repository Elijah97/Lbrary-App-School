<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Library App</title>
    <link rel="shortcut icon" href="{{ URL::asset('images/logo.png')}}">
    <link href="{{ URL::asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('css/bootstrap-reboot.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('css/bootstrap-grid.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('css/index.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('css/Library.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('css/animate.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
    <link rel="stylesheet" href="css/select2-bootstrap.css">

    <script src="{{ URL::asset('js/jquery.js')}}"></script>
    <script src="{{ URL::asset('js/bootstrap.min.js')}}"></script>
    <script src="{{ URL::asset('js/wow.min.js')}}"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/frappe-charts@1.1.0/dist/frappe-charts.min.iife.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.js"></script>
    <style>
        /*INPUTS*/
        .input {
            width: 100%;
            height: 36px;
            border-radius: 0px;
            background: #fff;
            font-size: 14px;
            padding: 4px 0;
            color: #000;
            box-shadow: none;
            border: none;
            border-bottom: 1px solid #e4e4e4;
        }

        .input:focus {
            width: 100%;
            height: 36px;
            border-radius: 0px;
            background: #fff;
            font-size: 14px;
            padding: 4px 0;
            color: #000;
            box-shadow: none;
            border: none;
            border-bottom: 1px solid #e4e4e4;
        }
    </style>
</head>

<body id="page-top">
    <div id="sticky-anchor"></div>
    <div class="wrapper">
        <nav class="sidebar">
            <div class="sidebar-header ">
                <center>
                    <img src="{{URL::asset('images/logo.png')}}" alt="" width="80%">
                </center>
            </div>

            <ul class="list-unstyled menu">
                <li class="{{ Request::is(['dashboard']) ? 'active' : null }}">
                    <a href="{{ URL::to('/dashboard') }}"><i class="material-icons Icon">show_chart</i>ANALYTICS</a>
                </li>
                <li class="{{ Request::is(['students']) || Request::is(['staff'])  ? 'active' : null }}">
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="material-icons Icon">pages</i>ADD</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="{{ URL::to('/students') }}">STUDENTS</a>
                        </li>
                        <li>
                            <a href="{{ URL::to('/staffs') }}">STAFF</a>
                        </li>
                        <li>
                            <a href="{{ URL::to('/content') }}">CONTENT</a>
                        </li>
                    </ul>
                </li>
                <li class="{{ Request::is(['books']) || Request::is(['shelf']) ? 'active' : null }}">
                    <a href="{{ URL::to('/books') }}"><i class="material-icons Icon">chat_bubble_outline</i>BOOKS</a>
                </li>
                <li class="{{ Request::is(['transaction']) || Request::is(['return']) ? 'active' : null }}">
                    <a href="{{ URL::to('/transaction') }}"><i class="material-icons Icon">all_inclusive</i>TRANSACTION</a>
                </li>
                <li class="{{ Request::is(['reports']) ? 'active' : null }}">
                    <a href="{{ URL::to('/reports') }}"><i class="material-icons Icon">file_copy</i>REPORT</a>
                </li>
                <!-- <li class="{{ Request::is(['account']) ? 'active' : null }}">
                    <a href="{{ URL::to('/account') }}"><i class="material-icons Icon">supervisor_account</i>ACCOUNT</a>
                </li> -->
                <hr class="sep">
                <li class="{{ Request::is(['settings']) ? 'active' : null }}">
                    <a href="{{ URL::to('/settings') }}" class="Other"><i class="material-icons Icon">settings</i>Settings</a>
                </li>
                {{-- <li class="{{ Request::is(['']) ? 'active' : null }}">
                <a href="#" class="Other"><i class="material-icons Icon">info</i>About</a>
                </li> --}}
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="navbar-form pad0">
                        {{ csrf_field() }}
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="Other">
                            <i class="material-icons Icon">power_settings_new</i>Sign - Out
                        </a>
                    </form>
                </li>
            </ul>

        </nav>
        <div class="container-fluid pad0" id="content">

            <nav class="navbar sticky-top navbar-expand-lg navbar-expand-md navbar-expand-sm TopNav">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <button class="btn btn-sm sidemenuBtn" id="sidebarCollapse" href="#">
                    <i class="material-icons sidemenuIcon">menu</i>
                </button>

                <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                    <ul class="navbar-nav ml-auto">
                        <!-- <a href="/transact" class="btn filter_button float-left mx-auto my-auto">
                    <span class="white">Record Transaction</span>
                </a>&nbsp;&nbsp; -->

                        <li class="nav-item">
                            <img src="../images/avatar.png" class="rounded-circle Nav_Profile" style="width: 32px;height: 32px;">
                        </li>
                        <li class="nav-item">
                            <div class="dropdown">
                                <a class="nav-link Nav_options">{{ Auth::user()->names }}</a>
                            </div>
                        </li>
                    </ul>

                </div>
            </nav>

            @yield('content')

        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
    <script>
        new WOW().init();
    </script>
    <!-- <script>
  $(document).on('click',function(){
    $('.collapse').collapse('hide');
  })
</script> -->
    <script>
        function sticky_relocate() {
            var window_top = $(window).scrollTop();
            var div_top = $('#sticky-anchor').offset().top;
            if (window_top > div_top) {
                $('#sticky').addClass('stick');
                $('#sticky-anchor').height($('#sticky').outerHeight());
            } else {
                $('#sticky').removeClass('stick');
                $('#sticky-anchor').height(0);
            }
        }

        $(function() {
            $(window).scroll(sticky_relocate);
            sticky_relocate();
        });
    </script>
    <script>
        $(document).ready(function() {

            $('#sidebarCollapse').on('click', function() {
                $('.sidebar').toggleClass('active');
            });

        });
    </script>
</body>

</html>