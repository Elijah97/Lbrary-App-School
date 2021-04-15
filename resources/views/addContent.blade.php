@extends('layout')
@section('content')


<nav class="navbar sticky-top navbar-expand-lg avbar-light bg-light subnav">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <i class="material-icons sidemenuIcon">menu</i>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <ul class="navbar-nav subsubnav">
            <li class="nav-item {{ Request::is(['content']) ? 'active' : null }}">
                <a class="nav-link" href="#">SELECT BOOK </a>
            </li>
            <li class="nav-item {{ Request::is(['addContent']) ? 'active' : null }}">
                <a class="nav-link" href="#">ADD CONTENT </a>
            </li>

        </ul>
    </div>
</nav>

<div class="container-fluid pad0" id="content">
    <div class=" container-fluid ">
        <div class="row mato16 pad16 justify-content-center">
            <div class="col-6  pad10 ">
                <div class="Card16 col-12">
                    <div class="col-12"><a href="{{ URL::to('/content') }}"><i class="material-icons BackIcon">arrow_back</i></a></div>
                    <form class="form-horizontal pad32" action="{{ Route('addContent') }}" method="POST">
                        @csrf
                        @include('inc.messages')
                        <div class="row">
                            @foreach($book as $bk)
                            <p class="Dash_Txt_Article black mato6 mabo16 text-uppercase">Add Content for <i>{{$bk->book_name}}</i></p>
                            <select class="form-control input mabo16" name="book_chapter" required>
                                <option>Select Book Chapter</option>
                                @for($i = 1; $i <= $bk->book_chapters; $i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                            </select>
                            <textarea class="form-control input mabo16" name="content" placeholder="Chapter Summary"></textarea>
                            <input name="book_key" class="form-control input mabo16" type="hidden" value="{{$bk->book_key}}">
                            @endforeach
                            <button type="submit" class="btn filter_button float-left mato32">Add Content for a chapter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row mato16 pad16 justify-content-center">
            <div class="col-6  pad10 ">
                <div class="Card16 col-12">
                    <table class="table table-hover Dash_Txt_Set mato16">
                        <thead class="text-uppercase">
                            <tr>
                                <th>#</th>
                                <th>Book Name</th>
                                <th>Book Author</th>
                                <th>Chapter</th>
                                <th>Total Chapters</th>
                                <th>Summary</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contents as $content)

                            <tr class='clickable-row' data-href=''>
                                <td>{{$index++}}</td>
                                <td>{{$content->book_name}}</td>
                                <td>{{$content->book_author}}</td>
                                <td>{{$content->book_chapter}}</td>
                                <td>{{$content->book_chapters}}</td>
                                <td>{{$content->content}}</td>
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