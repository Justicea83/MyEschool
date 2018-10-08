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
        .all-select{
            margin-top: -20px !important;
            width: 100% !important;
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
            <div class="col-md-6 col-md-offset-3">
                    <p style="text-align: center">
                        <img src="{{ Auth::user()->avatar != null ? asset('img/profile/' . Auth::user()->avatar ): asset('img/placeholder.png')}}"
                             class="img img-responsive img-thumbnail" style="border-radius: 50%;" width="35%" height="35%">
                    </p>
            </div>
        </div>
        <div class="row">
            <form method="post" action="{{route('super.profile.update')}}"  enctype="multipart/form-data" >

                <div class="col-lg-12 clear-padding-xs">
                    <div class="col-md-12">
                        <div class="dash-item first-dash-item">
                            <h6 class="item-title"><i class="fa fa-user"></i>PERSONAL INFO</h6>
                            <div class="inner-item">
                                <div class="dash-form">
                                    <div class="col-sm-3  {{$errors->has('name') ? ' errors' : ''}}">
                                        <label class="clear-top-margin"><i class="fa fa-user-circle-o"></i>NAME</label>
                                        <input type="text" placeholder="JOHN"  name="name" value="{{$info->name}}" required/>
                                        @if($errors->has('name'))
                                            <span class="help-block">{{$errors->first('name')}}</span>
                                        @endif
                                    </div>
                                    <div class="col-sm-3  {{$errors->has('dob') ? ' errors' : ''}}">
                                        <label class="clear-top-margin"><i class="fa fa-calendar"></i>DATE OF BIRTH</label>
                                        <input type="date" required  name="dob"  value="{{$info->dob}}"/>
                                        @if($errors->has('dob'))
                                            <span class="help-block">{{$errors->first('dob')}}</span>
                                        @endif
                                    </div>
                                    <div class="col-sm-3  {{$errors->has('gender') ? ' errors' : ''}}">
                                        <label class="clear-top-margin"><i class="fa fa-venus"></i>GENDER</label>
                                        <select name="gender" required>
                                            <option></option>
                                            <option {{$info->gender == 'male'? ' selected':''}}>Male</option>
                                            <option {{$info->gender == 'female'? ' selected':''}}>Female</option>
                                        </select>
                                        @if($errors->has('gender'))
                                            <span class="help-block">{{$errors->first('gender')}}</span>
                                        @endif
                                    </div>
                                    <div class="col-sm-3 {{$errors->has('email') ? ' errors' : ''}}">
                                        <label class="clear-top-margin"><i class="fa fa-envelope-o"></i>EMAIL</label>
                                        <input type="text" required placeholder="john@pathshala.com" name="email" value="{{$info->email}}"/>
                                        @if($errors->has('email'))
                                            <span class="help-block">{{$errors->first('email')}}</span>
                                        @endif
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-sm-3  {{$errors->has('religion') ? ' errors' : ''}}">
                                        <label><i class="fa fa-bell-o"></i>RELIGION</label>
                                        <select name="religion"  value="{{old('religion')}}">
                                            <option></option>
                                            <option value="christian" {{$info->religion == 'christian'? 'selected':''}}>Christian</option>
                                            <option value="hindu" {{$info->religion == 'hindu'? 'selected':''}}>Hinduism</option>
                                            <option value="islam" {{$info->religion == 'islam'? 'selected':''}}>Islamic</option>
                                        </select>
                                        @if($errors->has('religion'))
                                            <span class="help-block">{{$errors->first('religion')}}</span>
                                        @endif
                                    </div>
                                    <div class="col-sm-3  {{$errors->has('avatar') ? ' errors' : ''}}">
                                        <label><i class="fa fa-file-picture-o"></i>UPLOAD PHOTO</label>
                                        <input type="file" value="" name="avatar" ref="file" />
                                        @if($errors->has('avatar'))
                                            <span class="help-block">{{$errors->first('avatar')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-sm-12">
                                    <button type="submit"  class="btn btn-success">
                                        <i class="fa fa-paper-plane"></i> SAVE
                                    </button>
                                </div>
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
    <script>
        $(document).ready(function () {
            $(".chosen-select").chosen({no_results_text: "Oops, nothing found!"});
        })
    </script>
    @endsection