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
    </style>
@endsection

@section('main')
    <div class="main-content" id="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 clear-padding-xs">
                    <h5 class="page-title"><i class="fa fa-user-secret"></i>ADD ACCOUNTANT</h5>
                    <div class="section-divider"></div>
                </div>
            </div>
        </div>
        @include('partials.alert')
        <div class="row">
            <form method="post" action="{{route('accountants.store')}}"  enctype="multipart/form-data" >
                <div class="col-lg-12 clear-padding-xs">
                    <div class="col-md-12">
                        <div class="dash-item first-dash-item">
                            <h6 class="item-title"><i class="fa fa-user"></i>ACCOUNTANT INFO</h6>
                            <div class="inner-item">
                                <div class="dash-form">
                                    <div class="col-sm-3  {{$errors->has('firstname') ? ' errors' : ''}}">
                                        <label class="clear-top-margin"><i class="fa fa-user-circle-o"></i>FIRST NAME</label>
                                        <input type="text" placeholder="JOHN"  name="firstname" value="{{old('firstname')}}" required/>
                                        @if($errors->has('firstname'))
                                            <span class="help-block">{{$errors->first('firstname')}}</span>
                                        @endif
                                    </div>
                                    <div class="col-sm-3  {{$errors->has('middlename') ? ' errors' : ''}}">
                                        <label class="clear-top-margin"><i class="fa fa-user-circle-o"></i>MIDDLE NAME</label>
                                        <input type="text" placeholder="FIDLER" name="middlename"  value="{{old('middlename')}}"/>
                                        @if($errors->has('middlename'))
                                            <span class="help-block">{{$errors->first('middlename')}}</span>
                                        @endif
                                    </div>
                                    <div class="col-sm-3  {{$errors->has('lastname') ? ' errors' : ''}}">
                                        <label class="clear-top-margin"><i class="fa fa-user-circle-o"></i>LAST NAME</label>
                                        <input type="text" placeholder="DOE"  name="lastname"  value="{{old('lastname')}}" required/>
                                        @if($errors->has('lastname'))
                                            <span class="help-block">{{$errors->first('lastname')}}</span>
                                        @endif
                                    </div>
                                    <div class="col-sm-3  {{$errors->has('gender') ? ' errors' : ''}}">
                                        <label class="clear-top-margin"><i class="fa fa-venus"></i>GENDER</label>
                                        <select name="gender" value="{{old('gender')}}" required>
                                            <option></option>
                                            <option>Male</option>
                                            <option>Female</option>
                                        </select>
                                        @if($errors->has('gender'))
                                            <span class="help-block">{{$errors->first('gender')}}</span>
                                        @endif
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-sm-3  {{$errors->has('dob') ? ' errors' : ''}}">
                                        <label><i class="fa fa-calendar"></i>DATE OF BIRTH</label>
                                        <input type="date" required  name="dob"  value="{{old('dob')}}"/>
                                        @if($errors->has('dob'))
                                            <span class="help-block">{{$errors->first('dob')}}</span>
                                        @endif
                                    </div>
                                    <div class="col-sm-3  {{$errors->has('phone') ? ' errors' : ''}}">
                                        <label><i class="fa fa-phone"></i>PHONE #</label>
                                        <input type="text" required placeholder="1234567890" name="phone"  value="{{old('phone')}}"/>
                                        @if($errors->has('phone'))
                                            <span class="help-block">{{$errors->first('phone')}}</span>
                                        @endif
                                    </div>
                                    <div class="col-sm-3 {{$errors->has('email') ? ' errors' : ''}}">
                                        <label><i class="fa fa-envelope-o"></i>EMAIL</label>
                                        <input type="text" required placeholder="john@pathshala.com" name="email" value="{{old('email')}}"/>
                                        @if($errors->has('email'))
                                            <span class="help-block">{{$errors->first('email')}}</span>
                                        @endif
                                    </div>
                                    <div class="col-sm-3  {{$errors->has('religion') ? ' errors' : ''}}">
                                        <label><i class="fa fa-bell-o"></i>RELIGION</label>
                                        <select name="religion"  value="{{old('religion')}}">
                                            <option>-- Select --</option>
                                            <option>Buddhism</option>
                                            <option>Christian</option>
                                            <option>Hinduism</option>
                                        </select>
                                        @if($errors->has('religion'))
                                            <span class="help-block">{{$errors->first('religion')}}</span>
                                        @endif
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-sm-3  {{$errors->has('middlename') ? ' errors' : ''}}">
                                        <label><i class="fa fa-file-picture-o"></i>UPLOAD PHOTO</label>
                                        <input type="file" placeholder="90890" value="{{old('avatar')}}" name="avatar" ref="file" />
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
                                        <input required type="text" placeholder="H/N 42 Street# 10" name="c_address" value="{{old('c_address')}}" />
                                        @if($errors->has('c_address'))
                                            <span class="help-block">{{$errors->first('c_address')}}</span>
                                        @endif
                                    </div>
                                    <div class="col-sm-3  {{$errors->has('c_address1') ? ' errors' : ''}}">
                                        <label class="clear-top-margin"><i class="fa fa-home"></i>ADDRESS 2</label>
                                        <input type="text" placeholder="H/N 42 Street# 10" name="c_address1" value="{{old('c_address1')}}"  />
                                        @if($errors->has('c_address1'))
                                            <span class="help-block">{{$errors->first('c_address1')}}</span>
                                        @endif
                                    </div>
                                    <!-- <div class="col-sm-3"> -->
                                <!-- <label class="clear-top-margin"><i class="fa fa-flag"></i>COUNTRY</label>
                                        <select  name="country" value="{{old('country')}}">
                                            <option>-- Select --</option>
                                            <option>Canada</option>
                                            <option>India</option>
                                            <option>Japan</option> -->
                                    <!-- </select> -->
                                    <!-- </div> -->
                                    <div class="col-sm-3  {{$errors->has('state') ? ' errors' : ''}}">
                                        <label class="clear-top-margin"><i class="fa fa-id-card"></i>STATE</label>
                                        <select  name="state" value="{{old('state')}}">
                                            <option>-- Select --</option>
                                            <option>British Columbia</option>
                                            <option>Ontario</option>
                                        </select>
                                        @if($errors->has('state'))
                                            <span class="help-block">{{$errors->first('state')}}</span>
                                        @endif
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-sm-3  {{$errors->has('zip') ? ' errors' : ''}}">
                                        <label><i class="fa fa-code"></i>ZIP</label>
                                        <input type="text" placeholder="90890" name="zip" value="{{old('zip')}}"/>
                                        @if($errors->has('zip'))
                                            <span class="help-block">{{$errors->first('zip')}}</span>
                                        @endif
                                    </div>
                                    <div class="col-sm-3  {{$errors->has('c_phone') ? ' errors' : ''}}">
                                        <label><i class="fa fa-phone"></i>PHONE #</label>
                                        <input type="text" placeholder="1234567890" name="c_phone" value="{{old('c_phone')}}"/>
                                        @if($errors->has('c_phone'))
                                            <span class="help-block">{{$errors->first('c_phone')}}</span>
                                        @endif
                                    </div>
                                    <div class="col-sm-3  {{$errors->has('c_phone1') ? ' errors' : ''}}">
                                        <label><i class="fa fa-phone"></i>ALTERNATE PHONE #</label>
                                        <input type="text" placeholder="1234567890" name="c_phone1" value="{{old('c_phone1')}}"/>
                                        @if($errors->has('c_phone1'))
                                            <span class="help-block">{{$errors->first('c_phone1')}}</span>
                                        @endif
                                    </div>
                                <!-- <div class="col-sm-3 {{$errors->has('c_mail') ? ' errors' : ''}}">
                                        <label><i class="fa fa-envelope-o"></i>EMAIL</label>
                                        <input type="text" placeholder="john@pathshala.com" name="c_mail" value="{{old('c_mail')}}" />
                                        @if($errors->has('c_mail'))
                                    <span class="help-block">{{$errors->first('c_mail')}}</span>
                                        @endif
                                        </div> -->
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
                                        <input type="text" placeholder="PhD" name="degree"  value="{{old('degree')}}"/>
                                        @if($errors->has('degree'))
                                            <span class="help-block">{{$errors->first('degree')}}</span>
                                        @endif
                                    </div>
                                    <div class="col-sm-3  {{$errors->has('uni') ? ' errors' : ''}}">
                                        <label class="clear-top-margin"><i class="fa fa-building"></i>UNIVERSITY/COLLEGE</label>
                                        <select name="uni" value="{{old('uni')}}">
                                            <option>-- Select --</option>
                                            <option>IIT</option>
                                            <option>Harvard</option>
                                        </select>
                                        @if($errors->has('uni'))
                                            <span class="help-block">{{$errors->first('uni')}}</span>
                                        @endif
                                    </div>
                                    <div class="col-sm-3  {{$errors->has('year') ? ' errors' : ''}}">
                                        <label class="clear-top-margin"><i class="fa fa-calendar"></i>YEAR PASSED</label>
                                        <select name="year" value="{{old('year')}}" >
                                            <option>-- Select --</option>
                                            <option>2005</option>
                                            <option>2006</option>
                                        </select>
                                        @if($errors->has('year'))
                                            <span class="help-block">{{$errors->first('year')}}</span>
                                        @endif
                                    </div>
                                    <div class="col-sm-3  {{$errors->has('gpa') ? ' errors' : ''}}">
                                        <label class="clear-top-margin"><i class="fa fa-puzzle-piece"></i>CGPA</label>
                                        <input type="text" placeholder="08.65" name="gpa"  value="{{old('gpa')}}" />
                                        @if($errors->has('gpa'))
                                            <span class="help-block">{{$errors->first('gpa')}}</span>
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
                {!! csrf_field() !!}
            </form>
        </div>
        <div class="menu-togggle-btn">
            <a href="#menu-toggle" id="menu-toggle"><i class="fa fa-bars"></i></a>
        </div>
        @include('admin.partials.footer')
    </div>

@endsection