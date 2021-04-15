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
                        <p class="Dash_Txt_Article black mato6 text-uppercase">Borrow a Book - user</p>
                    </div>
                    <form class="form-horizontal pad32" action="{{ Route('borrowing') }}" method="POST">
                        @csrf
                        @include('inc.messages')
                        <div class="row">
                            <select name="user_key" class="form-control input mabo16" id="user">
                                <option></option>
                                @foreach($users as $user)
                                <option value="{{ $user->user_key }}">{{ $user->names}} - {{$user->type == 0 ? "Student" : "Staff"}}</option>
                                @endforeach
                            </select>
                            <input type="date" name="date_expected" class="form-control input mabo16" placeholder="Date to be returned" required>
                            <select name="book_key" class="form-control input mabo16" id="book" required>
                                <option></option>
                                @foreach($books as $book)
                                <option value="{{ $book->book_key }}">{{ $book->book_name }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn filter_button float-left mato32">Confirm Action</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    $("#staff").select2({
        theme: "bootstrap",
        placeholder: "Select staff's email",
        maximumSelectionSize: 3,
        containerCssClass: ':all:'
    });
    $("#user").select2({
        theme: "bootstrap",
        placeholder: "Select User",
        maximumSelectionSize: 3,
        containerCssClass: ':form-control input mabo16:'
    });

    $("#book").select2({
        theme: "bootstrap",
        placeholder: "Select book ",
        maximumSelectionSize: 3,
        containerCssClass: ':form-control input mabo16:'
    });
</script>
@endsection