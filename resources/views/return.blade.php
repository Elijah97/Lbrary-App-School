@extends('layout')
@section('content')
<nav class="navbar sticky-top navbar-expand-lg avbar-light bg-light subnav">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <i class="material-icons sidemenuIcon">menu</i>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <ul class="navbar-nav subsubnav">
            <li class="nav-item {{ Request::is(['transaction']) ? 'active' : null }}">
                <a class="nav-link" href="{{ URL::to('/transaction') }}">Borrow </a>
            </li>
            <li class="nav-item {{ Request::is(['return']) ? 'active' : null }}">
                <a class="nav-link" href="{{ URL::to('/return') }}">Return </a>
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
                        <p class="Dash_Txt_Article black mato6 text-uppercase">Return a Book</p>
                    </div>
                    <form class="form-horizontal pad32" action="{{ Route('returning') }}" method="POST">
                        @csrf
                        @include('inc.messages')
                        <div class="row">
                            <select name="book_key" class="form-control input mabo16" id="book" required>
                                <option></option>
                                @foreach($books as $book)
                                <option value="{{ $book->book_key }}">{{ $book->book_name }}</option>
                                @endforeach
                            </select>
                            <input class="form-control input mabo16" type="number" min="1" max="5" name="book_condition" placeholder="Book conditin from 1(Bad) - 5(Good)">
                            <button type="submit" class="btn filter_button float-left mato32">Confirm Action</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $("#student").select2({
        theme: "bootstrap",
        placeholder: "Select student's email *",
        maximumSelectionSize: 3,
        containerCssClass: ':all:'
    });

    $("#book").select2({
        theme: "bootstrap",
        placeholder: "Select book ",
        maximumSelectionSize: 3,
        containerCssClass: ':all:'
    });
</script>
@endsection