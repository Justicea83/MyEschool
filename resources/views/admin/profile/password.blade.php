@extends('admin.index')
@section('title','Admin')

@section('css')
    <style>
        .errors input{
            border-color:red;

        }
        .errors select option{
            border-color:red;

        }
        .errors span{
            color:red;
        }
        .style-button:hover{
            background-color: white;
            color: black;

        }
        .style-button{
            padding: 9px 12px 9px 12px;
            border-radius: 0;
        }
    </style>
@endsection

@section('main')
    <div class="main-content" id="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 clear-padding-xs">
                    <h5 class="page-title"><i class="fa fa-user-secret"></i>PROFILE</h5>
                    <div class="section-divider"></div>
                </div>
            </div>
        </div>
        @include('partials.alert')
        <div class="row">
            <form method="post" action="{{route('admin.passwords.update')}}"  enctype="multipart/form-data" >

                <div class="col-lg-12 clear-padding-xs">
                    <div class="col-md-12">
                        <div class="dash-item first-dash-item">
                            <h6 class="item-title"><i class="fa fa-user"></i>CHANGE PASSWORD</h6>
                            <div class="inner-item">
                                <div class="dash-form">
                                    <div class="col-sm-3  {{$errors->has('password') ? ' errors' : ''}}">
                                        <label class="clear-top-margin"><i class="fa fa-user-circle-o"></i>CURRENT PASSWORD</label>
                                        <input type="password"  name="password" required/>
                                        @if($errors->has('password'))
                                            <span class="help-block">{{$errors->first('password')}}</span>
                                        @endif
                                    </div>
                                    <div class="col-sm-3  {{$errors->has('newpass') ? ' errors' : ''}}">
                                        <label class="clear-top-margin"><i class="fa fa-calendar"></i>NEW PASSWORD</label>
                                        <input type="password" required  name="newpass" />
                                        @if($errors->has('newpass'))
                                            <span class="help-block">{{$errors->first('newpass')}}</span>
                                        @endif
                                    </div>
                                    <div class="col-sm-3  {{$errors->has('newpass_confirmation') ? ' errors' : ''}}">
                                        <label class="clear-top-margin"><i class="fa fa-calendar"></i>CONFIRM PASSWORD</label>
                                        <input type="password" required  name="newpass_confirmation"  value=""/>
                                        @if($errors->has('newpass_confirmation'))
                                            <span class="help-block">{{$errors->first('newpass_confirmation')}}</span>
                                        @endif
                                    </div>
                                    <div class="clearfix"></div>
                                    <br>
                                    <div class="col-sm-12">
                                        <button type="submit"  class="style-button btn btn-success">
                                            <i class="fa fa-paper-plane"></i> SAVE
                                        </button>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                {{ csrf_field() }}
            </form>
        </div>
        <div class="menu-togggle-btn">
            <a href="#menu-toggle" id="menu-toggle"><i class="fa fa-bars"></i></a>
        </div>
        @include('admin.partials.footer')
    </div>

@endsection

@section('js')

@endsection