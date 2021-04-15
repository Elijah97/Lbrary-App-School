<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Library App</title>
    <link rel="shortcut icon" href="{{ URL::asset('images/images/logo_white.png')}}">
    <link href="{{ URL::asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('css/bootstrap-reboot.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('css/bootstrap-grid.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('css/index.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('css/Library')}}" rel="stylesheet">
    <link href="{{ URL::asset('css/animate.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
</head>

<body id="page-top">

    <div id="sticky-anchor"></div>
    <nav class="w-nav navbar navbar-expand-lg pad32">
        <div class=" container pad0">
            <a class="navbar-brand text-center" href="#">
                <img src="images/logo.png" height="80" class="d-inline-block align-top" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <form class="form-inline ml-auto">
                    <a href="/"><i class="material-icons black">close</i></a>
                </form>
            </div>
        </div>
    </nav>


    <div class="container-fluid pad16" id="content" style="background: #fff">
        <div class=" container-fluid ">
            <div class="row mato16 justify-content-center">
                <div class="col-10 pad10 justify-content-center">
                    <div class="Card16 col-12">
                        <div class="row">
                            <div class="col-3">
                                <p class="Dash_Txt_Article black mato6">{{count($books)}} Books</p>
                            </div>
                        </div>
                        <hr>
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Book Name</th>
                                    <th>Book ID</th>
                                    <th>Book Author</th>
                                    <th>Book Chapters</th>
                                    <th>Book Shelf</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($books as $bk)
                                <tr class='clickable-row' data-href=''>
                                    <td>{{$index++}}</td>
                                    <td>{{$bk->book_name}}</td>
                                    <td>{{$bk->book_id}}</td>
                                    <td>{{$bk->book_author}}</td>
                                    <td>{{$bk->book_chapters}}</td>
                                    <td>{{$bk->book_shelf}}</td>
                                    <td>{{$bk->book_status === 1 ? "Active" : "Pending" }}</td>
                                    <td><a data-toggle="modal" data-target="#CONTENT-{{$index}}" title="View Details"><span class=""><i class="material-icons Icon">visibility</i></span></a></td>
                                    <!-- Modal -->
                                    <div class="modal fade" id="CONTENT-{{$index}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">{{$bk->book_name}}'s Summary by Chapter </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div id="accordion">
                                                        @foreach($bk->contents as $content)
                                                        <div class="card">
                                                            <div class="card-header" id="headingOne">
                                                                <h5 class="mb-0">
                                                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapse-{{$index}}" aria-expanded="true" aria-controls="collapseOne">
                                                                        Chapter {{" "}}{{$content->book_chapter}}
                                                                    </button>
                                                                </h5>
                                                            </div>

                                                            <div id="collapse-{{$index}}" class="collapse @if ($content->book_chapter == 1) show @endif" aria-labelledby="headingOne" data-parent="#accordion">
                                                                <div class="card-body">
                                                                    {{$content->content}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                                @endforeach
                            </tbody>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="{{ URL::asset('js/jquery.js')}}"></script>
    <script src="{{ URL::asset('js/bootstrap.min.js')}}"></script>
    <script src="{{ URL::asset('js/wow.min.js')}}"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
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