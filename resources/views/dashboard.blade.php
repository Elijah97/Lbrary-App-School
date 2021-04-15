@extends('layout')
@section('content')

<div class=" container-fluid row " style="width: 100%">
    <div class="col-3 ">
        <div class="analytics pad32 col-md-12 col-sm-12 col-xs-12">
            <h4>{{count($books)}} Book(s)</h4>
        </div>
    </div>
    <div class="col-3 ">
        <div class="analytics pad32 col-md-12 col-sm-12 col-xs-12">
            <h4>{{count($students)}} Student(s)</h4>
        </div>
    </div>
    <div class="col-3 ">
        <div class="analytics pad32 col-md-12 col-sm-12 col-xs-12">
            <h4>{{count($staffs)}} Staff(s)</h4>
        </div>
    </div>
    <div class="col-3 ">
        <div class="analytics pad32 col-md-12 col-sm-12 col-xs-12">
            <h4>{{count($students)}} Transaction(s)</h4>
        </div>
    </div>
    <div class="col-6">
        <div class="analytics pad32 col-md-12 col-sm-12 col-xs-12">
            Chart 1
        </div>
    </div>
    <div class="col-6">
        <div class="analytics pad32 col-md-12 col-sm-12 col-xs-12">
            cHART 2
        </div>
    </div>
</div>

@endsection