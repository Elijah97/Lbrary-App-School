@extends('auth.resources')

@section('content')
<div class="container-fluid" id="section6">
    <div class="container mato128">
        <div class="col-lg-12 mabo32 pad0">
            <p class="white Dash_Txt_Large text-center">Reset Password</p>
        </div>
        <div class="row justify-content-md-center ">
            <div class="col-lg-5 ">
                <form id="" name="contact-form" action="" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mabo16">
                                <input type="email" id="email" name="email" placeholder="user@alueducation.com" class="form-control Dash_Txt_Normal input_cust" required />
                            </div>
                        </div>
                        <div class="col-md-12 text-center mabo32">
                            <button type="submit" class="btn  Nav_Dash_Btn" role="button">Login</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop