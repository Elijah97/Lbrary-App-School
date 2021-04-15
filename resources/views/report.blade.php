@extends('layout')
@section('content')

<div class="container-fluid pad0" id="content">
    <div class=" container-fluid ">
        <div class="row mato16 pad16 justify-content-center">

            <div class="col-12 pad10 justify-content-center">
                <div class="Card16 col-12">
                    <div class="row">
                        <div class="col-6">
                            <span class="Dash_Txt_Article black">{{count($transactions)}} Record(s)</span>
                        </div>
                        <div class="col-6">
                            {{-- <button class="btn filter_button float-right" type="button" style="margin-left: 10px">
                                    <span class="Dash_Txt_Normal" >Download Excel</span>
                                </button>
                                
                                <button class="btn filter_button float-right" type="button" style="margin-left: 10px">
                                    <span class="Dash_Txt_Normal" >Print Table</span>
                                </button>  --}}

                            <a href="/sendReminder" class="btn filter_button float-right" type="button" style="margin-left: 10px">
                                <span class="Dash_Txt_Normal">Send reminder</span>
                            </a>

                        </div>
                    </div>
                    <hr>
                    <table id="example" class="table table-hover Dash_Txt_Set mato16">
                        <thead class="">
                            <tr>
                                <th>#</th>
                                <th>Names</th>
                                <th>Email</th>
                                <th>Book Name</th>
                                <th>Book Status</th>
                                <th>Book Condition (1 - 5)</th>
                                <th>Date Borrowed</th>
                                <th>Date Returned</th>
                                <th>Timeline</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactions as $trans)
                            <tr class='clickable-row tableContent' data-href=''>
                                <td>{{$count++ }}</td>
                                <td>{{$trans->borrower_name}}</td>
                                <td>{{$trans->borrower_email}}</td>
                                <td>{{$trans->book_name->book_name}}</td>
                                <td>
                                    @if($trans->status == 0)
                                    Borrowed
                                    @else
                                    Returned/Available
                                    @endif
                                </td>
                                <td>
                                    @if($trans->book_condition == NULL)
                                    -
                                    @else
                                    {{$trans->book_condition}}
                                    @endif
                                </td>
                                <td>{{$trans->date_borrowed}}</td>
                                <td>
                                    @if($trans->date_returned == NULL)
                                    Book Not yet Returned
                                    @else
                                    {{$trans->date_returned}}
                                    @endif
                                </td>
                                <td>{{$trans->timeline}}</td>
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