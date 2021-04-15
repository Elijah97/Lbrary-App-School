@extends('auth.resources')

@section('content')
<div class="container-fluid" id="section6">
    <div class="container mato128">
        <div class="col-lg-12 mabo32 pad0">
            <p class="white Dash_Txt_Large text-center">Back Door</p>
        </div>
        <div class="row justify-content-md-center">
            <div class="col-lg-5 ">
                <form id="" name="contact-form" action="{{ Route('register') }}" method="POST">
                    @csrf
                    @include('inc.messages')
                    <div class="row ">
                        <div class="col-md-12">
                            <div class="mabo16">
                                <input type="text" id="name" name="name" placeholder="Jon Snow" class="form-control Dash_Txt_Normal input_cust" required />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mabo16">
                                <input type="email" id="email" name="email" placeholder="user@alueducation.com" class="form-control Dash_Txt_Normal input_cust" required />
                            </div>
                        </div>
                        <div class="col-md-12 mabo16">
                            <div class="mabo16">
                                <input type="password" id="password" name="password" placeholder="Password" class="form-control Dash_Txt_Normal input_cust">
                            </div>
                        </div>
                        <div class="col-md-12 text-center mabo32">
                            <button type="submit" class="btn  Nav_Dash_Btn" role="button">Register</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop