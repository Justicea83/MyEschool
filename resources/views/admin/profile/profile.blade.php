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
            <form method="post" action="{{route('admin.profile.update')}}"  enctype="multipart/form-data" >

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
                                    <div class="col-sm-3  {{$errors->has('phone') ? ' errors' : ''}}">
                                        <label class="clear-top-margin"><i class="fa fa-phone"></i>PHONE #</label>
                                        <input type="text" required placeholder="1234567890" name="phone"  value="{{$info->contact}}"/>
                                        @if($errors->has('phone'))
                                            <span class="help-block">{{$errors->first('phone')}}</span>
                                        @endif
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-sm-3 {{$errors->has('email') ? ' errors' : ''}}">
                                        <label><i class="fa fa-envelope-o"></i>EMAIL</label>
                                        <input type="text" required placeholder="john@pathshala.com" name="email" value="{{$info->email}}"/>
                                        @if($errors->has('email'))
                                            <span class="help-block">{{$errors->first('email')}}</span>
                                        @endif
                                    </div>
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
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="dash-item">
                            <h6 class="item-title"><i class="fa fa-home"></i>CONTACT INFO</h6>
                            <div class="inner-item">
                                <div class="dash-form">
                                    <div class="col-sm-3  {{$errors->has('c_address') ? ' errors' : ''}}">
                                        <label class="clear-top-margin"><i class="fa fa-home"></i>ADDRESS 1</label>
                                        <input required type="text" placeholder="H/N 42 Street# 10" name="c_address" value="{{$info->address}}" />
                                        @if($errors->has('c_address'))
                                            <span class="help-block">{{$errors->first('c_address')}}</span>
                                        @endif
                                    </div>
                                    <div class="col-sm-3  {{$errors->has('c_address1') ? ' errors' : ''}}">
                                        <label class="clear-top-margin"><i class="fa fa-home"></i>ADDRESS 2</label>
                                        <input type="text" placeholder="H/N 42 Street# 10" name="c_address1" value="{{$info->alt_address}}"  />
                                        @if($errors->has('c_address1'))
                                            <span class="help-block">{{$errors->first('c_address1')}}</span>
                                        @endif
                                    </div>
                                    <div class="col-sm-3  {{$errors->has('c_phone') ? ' errors' : ''}}">
                                        <label class="clear-top-margin"><i class="fa fa-phone"></i>PHONE #</label>
                                        <input type="text" placeholder="1234567890" name="c_phone" value="{{$info->contact}}"/>
                                        @if($errors->has('c_phone'))
                                            <span class="help-block">{{$errors->first('c_phone')}}</span>
                                        @endif
                                    </div>
                                    <div class="col-sm-3  {{$errors->has('c_phone1') ? ' errors' : ''}}">
                                        <label class="clear-top-margin"><i class="fa fa-phone"></i>ALTERNATE PHONE #</label>
                                        <input type="text" placeholder="1234567890" name="c_phone1" value="{{$info->alt_phone}}"/>
                                        @if($errors->has('c_phone1'))
                                            <span class="help-block">{{$errors->first('c_phone1')}}</span>
                                        @endif
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="dash-item">
                            <h6 class="item-title"><i class="fa fa-book"></i>ACADEMIC INFO</h6>
                            <div class="inner-item">
                                <div class="dash-form">
                                    <div class="col-sm-3  {{$errors->has('degree') ? ' errors' : ''}}">
                                        <label class="clear-top-margin"><i class="fa fa-graduation-cap"></i>HIGHEST DEGREE</label>
                                        <input type="text" placeholder="PhD" name="degree"  value="{{$info->degree}}"/>
                                        @if($errors->has('degree'))
                                            <span class="help-block">{{$errors->first('degree')}}</span>
                                        @endif
                                    </div>
                                    <div class="col-sm-3  {{$errors->has('uni') ? ' errors' : ''}}">
                                        <label class="clear-top-margin"><i class="fa fa-building"></i>UNIVERSITY/COLLEGE</label>
                                        <select class="all-select chosen-select " name="uni" value="{{old('uni')}}">
                                            <option></option>
                                            @foreach($uni as $item)
                                                <option {{$info->university == $item->name ? ' selected':''}}>{{$item->name}}</option>
                                                @endforeach

                                        </select>
                                        @if($errors->has('uni'))
                                            <span class="help-block">{{$errors->first('uni')}}</span>
                                        @endif
                                    </div>
                                    <div class="col-sm-3  {{$errors->has('year') ? ' errors' : ''}}">
                                        <label class="clear-top-margin"><i class="fa fa-calendar"></i>YEAR PASSED</label>
                                        <input type="text" name="year" value="{{$info->year}}" >

                                        </input>
                                        @if($errors->has('year'))
                                            <span class="help-block">{{$errors->first('year')}}</span>
                                        @endif
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="clearfix"></div>
                                    <br>
                                    <div class="col-sm-12">
                                        <button type="submit"  class="btn btn-success">
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
    <script>
        $(document).ready(function () {
            $(".chosen-select").chosen({no_results_text: "Oops, nothing found!"});
        })
    </script>
    @endsection