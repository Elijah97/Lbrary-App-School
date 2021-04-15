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
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>

<body id="page-top" class="body">

    <div id="sticky-anchor"></div>
    <nav class="w-nav navbar navbar-expand-lg pad32" id="sticky" style="background:#FFF">
        <div class=" container pad0">
            <a class="navbar-brand text-center" href="#">
                <img src="{{ URL::asset('images/logo.png')}}" height="100" class="d-inline-block align-top" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <form class="form-inline ml-auto">
                    <a href="#"><i class="material-icons">close</i></a>
                </form>
            </div>
        </div>
    </nav>



    @yield('content')




    <script src="{{ URL::asset('js/jquery.js')}}"></script>
    <script src="{{ URL::asset('js/bootstrap.min.js')}}"></script>
    <script src="{{ URL::asset('js/wow.min.js')}}"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
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