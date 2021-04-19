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
            <div class="col-6  pad10 ">
                <div class="Card16 col-12">
                    <div class="col-12">
                        <p class="Dash_Txt_Article black mato6 text-uppercase">Add Book</p>
                    </div>
                    <form class="form-horizontal pad32" action="{{ Route('addBook')}}" method="POST">
                        @csrf
                        @include('inc.messages')
                        <div class="row">
                            <input class="form-control input mabo16" type="text" name="bookName" placeholder="Book Name">
                            <input class="form-control input mabo16" type="number" name="bookId" placeholder="Book ID">
                            <input class="form-control input mabo16" type="text" name="bookAuthor" placeholder="Book Author">
                            <label for="exampleInputEmail1" class="mato16">Published Date</label>
                            <input class="form-control input mabo16" type="date" name="published" placeholder="Published Date">
                            <textarea class="form-control input mabo16" name="description" placeholder="Brief Description(Max: 100)"></textarea>
                            <input class="form-control input mabo16" type="text" name="bookShelf" placeholder="Book Shelf Number">
                            <input class="form-control input mabo16" type="number" name="bookChapters" placeholder="Book Chapters">
                            <button type="submit" class="btn filter_button float-left mato32">Add Book</button>
                        </div>
                    </form>
                    <!-- <hr>
                    <form class="form-horizontal pad32" action="/importBooks" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <p><a href="/downloadsheetBook" class="Dash_Link_Black">Download Excel Template Sheet</a></p>
                            <input name="file" class="form-control input mabo16" type="file" placeholder="Upload Sheet">
                            <button type="submit" class="btn filter_button float-left mato32">Add Books</button>
                        </div>
                    </form> -->
                </div>
            </div>

        </div>
    </div>
</div>

@endsection