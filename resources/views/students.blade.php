@extends('layout')
@section('content')


<div class="Message">
    <div class="Dash_Txt_Set text-uppercase Box_Content" style="margin-left:8px;">Students</div>
</div>
<div class="container-fluid pad0" id="content">
    <div class=" container-fluid ">
        <div class="row mato16 pad16">
            <div class="col-4  pad10 ">
                <div class="Card16 col-12">
                    <div class="col-12">
                        <p class="Dash_Txt_Article black mato6 text-uppercase">Add STUDENT</p>
                    </div>
                    <form class="form-horizontal pad32" action="{{ Route('addStudent') }}" method="POST">
                        @csrf
                        @include('inc.messages')
                        <div class="row">
                            <input name="names" class="form-control input mabo16" type="text" placeholder="Full Names" required>
                            <input name="email" class="form-control input mabo16" type="email" placeholder="Email" required>
                            <input name="studentId" class="form-control input mabo16" type="number" placeholder="Student ID" required>
                            <input name="address" class="form-control input mabo16" type="phone" placeholder="Address" required>
                            <select name="faculty" class="form-control input mabo16">
                                <option value="Computer Science">Computer Science</option>
                                <option value="Global Challenges">Global Challenges</option>
                                <option value="Entrepreneurship">Entrepreneurship</option>
                            </select>
                            <label for="exampleInputEmail1" class="mato16">Graduation Year</label>
                            <input name="year" class="form-control input mabo16" type="date" placeholder="Class of 20--">
                            <button type="submit" class="btn filter_button float-left mato32">Add Student</button>
                        </div>
                    </form>
                    <!-- <hr>
                    <form class="form-horizontal pad32" action="/importStudents" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <p><a href="/downloadsheet" class="Dash_Link_Black">Download Excel Template Sheet</a></p>
                            <input class="form-control input mabo16" type="file" name="file" placeholder="Upload Sheet">
                            <button type="submit" class="btn filter_button float-left mato32">Add Students</button>
                        </div>
                    </form> -->
                </div>
            </div>
            <div class="col-8 pad10 ">
                <div class="Card16 col-12">
                    <div class="row">
                        <div class="col-3">
                            <p class="Dash_Txt_Article black mato6">{{count($students)}} Student(s)</p>
                        </div>
                    </div>
                    <table class="table table-hover Dash_Txt_Set mato16">
                        <thead class="text-uppercase">
                            <tr>
                                <th>#</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Student ID</th>
                                <th>Address</th>
                                <th>Graduation Year</th>
                                <th>Faculty</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $std)

                            <tr class='clickable-row' data-href=''>
                                <td>{{$index++}}</td>
                                <td>{{$std->names}}</td>
                                <td>{{$std->email}}</td>
                                <td>{{$std->userUUID}}</td>
                                <td>{{$std->address}}</td>
                                <td>{{$std->year}}</td>
                                <td>{{$std->faculty}}</td>
                                <td>{{$std->status == 1 ? "Active" : "Pending"}}</td>
                                <td>
                                    @if($std->status == 1)

                                    <a href="/user/{{$std->user_key}}/suspend" title="Suspend User"><span class=""><i class="material-icons Icon">pause</i></span></a>
                                    @else
                                    <a href="/user/{{$std->user_key}}/activate" title="Activate User"><span class=""><i class="material-icons Icon">play_arrow</i></span></a>
                                    @endif
                                    <a href="/studentEdit/{{$std->id}}" title="Edit request"><span class=""><i class="material-icons Icon">edit</i></span></a>
                                    <a href="/user/{{$std->user_key}}/delete" title="Delete request"><span class=""><i class="material-icons Icon">delete</i></span></a>
                                    @endforeach
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection