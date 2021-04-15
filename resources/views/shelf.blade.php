@extends('layout')
@section('content')


<nav class="navbar sticky-top navbar-expand-lg avbar-light bg-light subnav">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <i class="material-icons sidemenuIcon">menu</i>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <ul class="navbar-nav subsubnav">
            <li class="nav-item {{ Request::is(['books']) ? 'active' : null }}">
                <a class="nav-link" href="{{ URL::to('/books') }}">ADD BOOK </a>
            </li>
            <li class="nav-item {{ Request::is(['shelf']) ? 'active' : null }}">
                <a class="nav-link" href="{{ URL::to('/shelf') }}">SHELF </a>
            </li>

        </ul>
    </div>
</nav>

<div class="container-fluid pad0" id="content">
    <div class=" container-fluid ">
        <div class="row mato16 pad16 justify-content-center">
            <div class="col12">
                @include('inc.messages')
            </div>
            <div class="col-12 pad10 justify-content-center">
                <div class="Card16 col-12">
                    <div class="row">
                        <div class="col-3">
                            <p class="Dash_Txt_Article black mato6">{{count($books)}} Books</p>
                        </div>
                    </div>
                    <hr>
                    <table id="example" class="table table-striped " style="width:100%" border="0">
                        <thead class="text-uppercase">
                            <tr>
                                <th>#</th>
                                <th>Book Name</th>
                                <th>Book ID</th>
                                <th>Book Author</th>
                                <th>Published Date</th>
                                <th>Book Shelf</th>
                                <th>Book Chapters</th>
                                <th>Borrowed</th>
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
                                <td>{{$bk->published}}</td>
                                <td>{{$bk->book_shelf}}</td>
                                <td>{{$bk->book_chapters}}</td>
                                <td>{{$bk->book_traffic}}</td>
                                <td>
                                    @if($bk->book_status == 1)
                                    Active
                                    @elseif($bk->book_status == 0)
                                    Pending
                                    @else
                                    Borrowed
                                    @endif
                                </td>
                                <td>
                                    @if($bk->book_status !== 2)
                                    @if($bk->book_status == 1)

                                    <a href="/bookPend/{{$bk->book_id}}" title="Pause request"><span class=""><i class="material-icons Icon">pause</i></span></a>
                                    @else
                                    <a href="/bookPlay/{{$bk->book_id}}" title="Play request"><span class=""><i class="material-icons Icon">play_arrow</i></span></a>
                                    @endif
                                    <a href="/bookEdit/{{$bk->book_id}}" title="Edit request"><span class=""><i class="material-icons Icon">edit</i></span></a>

                                    <a href="/bookRemove/{{$bk->book_id}}" title="Delete request"><span class=""><i class="material-icons Icon">delete</i></span></a>
                                    @else
                                    No Action for borrowed books
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection