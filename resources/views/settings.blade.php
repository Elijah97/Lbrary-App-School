@extends('layout')
@section('content')


<div class="Message">
    <div class="Dash_Txt_Set text-uppercase Box_Content" style="margin-left:8px;">ACCOUNT</div>
</div>
<div class="container-fluid pad0" id="content">
    <div class=" container-fluid ">
        <div class="row mato16 justify-content-center pad16">
            <div class="col-12">
                @include('inc.messages')
            </div>
            <div class="col-6  pad10 ">
                <div class="Card16 col-12">
                    <div class="col-12">
                        <p class="Dash_Txt_Article black mato6 text-uppercase">Edit Account</p>
                    </div>
                    <form class="form-horizontal pad32" action="{{ Route('updateInfo') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <input name="user_key" class="form-control input mabo16" type="hidden" value="{{Auth::user()->user_key}}">
                            <input name="names" class="form-control input mabo16" type="name" placeholder="Full Name" value="{{Auth::user()->names}}">
                            <input name="email" class="form-control input mabo16" type="Email" placeholder="Email" value="{{Auth::user()->email}}" disabled>
                            <input name="address" class="form-control input mabo16" type="Phone" placeholder="Address" value="{{Auth::user()->address}}">
                            <input name="faculty" class="form-control input mabo16" type="Phone" placeholder="Faculty" value="{{Auth::user()->faculty}}">
                            <button type="submit" class="btn filter_button float-left mato32">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-6  pad10 ">
                <div class="Card16 col-12">
                    <div class="col-12">
                        <p class="Dash_Txt_Article black mato6 text-uppercase">Change Password</p>
                    </div>
                    <form class="form-horizontal pad32" action="{{ Route('updatePassword') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <input class="form-control input mabo16" type="password" placeholder="Old Password" name="current-password" id="current-password">
                            <input class="form-control input mabo16" type="password" placeholder="New Password" name="new-password" id="new-password">
                            <input class="form-control input mabo16" type="password" placeholder="Confirm Password" name="new-password-confirm" id="new-password-confirm">
                            <button type="submit" class="btn filter_button float-left mato32">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection