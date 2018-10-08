@extends('admin.index')

@push('css')

@endpush


@section('title','Admin')


@section('main')
    <div class="main-content" id="content-wrapper">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12 clear-padding-xs">
                    <h5 class="page-title"><i class="fa fa-user"></i>ADD STUDENT</h5>
                    <div class="section-divider"></div>
                </div>
            </div>
            @include('partials.alert')
            <form id="student-form" action="{{route('students.store')}}"  method="post" enctype="multipart/form-data">
                <div class="row">
                <div class="col-lg-12 clear-padding-xs">
                    <div class="col-md-12">
                        <div class="dash-item first-dash-item">
                            <h6 class="item-title"><i class="fa fa-user"></i>STUDENT INFO</h6>
                            <div class="inner-item">

                                    <div class="dash-form">
                                        <div class="col-sm-3">
                                            <label class="clear-top-margin"><i class="fa fa-user-circle-o"></i>FIRST NAME</label>
                                            <input name="fname" type="text" value="{{old('fname')}}" placeholder="JOHN" required/>
                                        </div>
                                        <div class="col-sm-3">
                                            <label class="clear-top-margin"><i class="fa fa-user-circle-o"></i>MIDDLE NAME</label>
                                            <input name="mname" type="text" value="{{old('mname')}}" placeholder="FIDLER" />
                                        </div>
                                        <div class="col-sm-3">
                                            <label class="clear-top-margin"><i class="fa fa-user-circle-o"></i>LAST NAME</label>
                                            <input name="lname" type="text" value="{{old('lname')}}" required placeholder="DOE" />
                                        </div>
                                        <div class="col-sm-3">
                                            <label class="clear-top-margin"><i class="fa fa-venus"></i>GENDER</label>
                                            <select name="gender" required>
                                                <option></option>
                                                <option>Male</option>
                                                <option>Female</option>
                                            </select>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="col-sm-3">
                                            <label><i class="fa fa-calendar"></i>DATE OF BIRTH</label>
                                            <input type="date" name="dob" required value="{{old('value')}}"  placeholder="MM/DD/YYYY" />
                                        </div>
                                        <div class="col-sm-3">
                                            <label><i class="fa fa-phone"></i>PHONE #</label>
                                            <input type="text" value="{{old('value')}}" name="phone" placeholder="1234567890" />
                                        </div>
                                        <div class="col-sm-3">
                                            <label><i class="fa fa-envelope-o"></i>EMAIL</label>
                                            <input type="email" name="student_email" value="{{old('student_email')}}" placeholder="john@pathshala.com" />
                                            @if($errors->has('student_email'))
                                                <span class="help-block text-danger">{{$errors->first('student_email')}}</span>
                                            @endif
                                        </div>
                                        <div class="col-sm-3">
                                            <label><i class="fa fa-bell-o"></i>RELIGION</label>
                                            <select name="s_religion">
                                                <option></option>
                                                <option>Buddhism</option>
                                                <option>Christian</option>
                                                <option>Hinduism</option>
                                                <option>Islamic</option>
                                            </select>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="col-sm-3">
                                            <label><i class="fa fa-file-picture-o"></i>UPLOAD PHOTO</label>
                                            <input name="s_avatar" value="{{old('s_avatar')}}" type="file" placeholder="90890" />
                                        </div>
                                    </div>

                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="dash-item">
                            <h6 class="item-title"><i class="fa fa-user-secret"></i>PARENT INFO</h6>
                            <div class="inner-item">
                                <div class="dash-form">
                                    <div class="col-sm-3">
                                        <label class="clear-top-margin"><i class="fa fa-user-circle-o"></i>FATHER NAME</label>
                                        <input value="{{old( 'father_name')}}" name="father_name" type="text" placeholder="JOHN" />
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="clear-top-margin"><i class="fa fa-user-circle-o"></i>MOTHER NAME</label>
                                        <input name="mother_name" value="{{old('mother_name')}}" type="text" placeholder="LENNORE" />
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="clear-top-margin custom-clear-margin-botton"><i class="fa fa-briefcase"></i>OCCUPATION</label>
                                        <select name="occupation" class="chosen-select">
                                            <option></option>
                                            @for($i = 0 ; $i < count($occupations->occupations); $i++)
                                                <option>{{$occupations->occupations[$i]}}</option>
                                                @endfor
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="clear-top-margin"><i class="fa fa-phone"></i>CONTACT #</label>
                                        <input type="text" value="{{old('contact')}}" name="contact" required placeholder="1234567890" />
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-sm-3">
                                        <label><i class="fa fa-phone"></i>ALTERNATE CONTACT #</label>
                                        <input type="text" value="{{old('alt_contact')}}" name="alt_contact" placeholder="1234567890" />
                                    </div>
                                    <div class="col-sm-3">
                                        <label><i class="fa fa-envelope-o"></i>EMAIL</label>
                                        <input type="email" class="{{$errors->has('email')? ' error' : ''}}" name="email" value="{{old('email')}}" required placeholder="john@pathshala.com" />
                                        @if($errors->has('email'))
                                            <span class="help-block text-danger">{{$errors->first('email')}}</span>
                                            @endif
                                    </div>
                                    <div class="col-sm-3">
                                        <label><i class="fa fa-bell-o"></i>RELIGION</label>
                                        <select name="p_religion">
                                            <option></option>
                                            <option>Buddhism</option>
                                            <option>Christian</option>
                                            <option>Hinduism</option>
                                            <option>Islamic</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="custom-clear-margin-botton"><i class="fa fa-flag"></i>NATIONALITY</label>
                                        <select name="p_nationality" class="chosen-select" >
                                            <option></option>
                                            @foreach($nationalities as $nationality)
                                                <option>{{$nationality}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-sm-3">
                                        <label><i class="fa fa-home"></i>ADDRESS</label>
                                        <input type="text" name="address" value="{{old('address')}}" placeholder="H/N 42 Street# 10" />
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="custom-clear-margin-botton"><i class="fa fa-flag "></i>COUNTRY</label>
                                        <select name="country" class="chosen-select">
                                            <option></option>
                                            @foreach($countries as $country)
                                                <option>{{$country->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="clearfix"></div>
                                    <div class="col-sm-3">
                                        <label><i class="fa fa-file-picture-o"></i>UPLOAD PHOTO</label>
                                        <input name="p_avatar" type="file" value="{{old('p_avatar')}}" placeholder="90890" />
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="dash-item">
                            <h6 class="item-title"><i class="fa fa-book"></i>ACADEMIC INFO</h6>
                            <div class="inner-item">
                                <div class="dash-form">
                                    <div class="col-sm-3">
                                        <label class="clear-top-margin"><i class="fa fa-id-card"></i>REGISTRATION #</label>
                                        <input name="reg_number" value="{{old('reg_number')}}" type="text" placeholder="PTH2017001" />
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="clear-top-margin"><i class="fa fa-book"></i>CLASS</label>
                                        <select name="s_class" required>
                                            <option></option>
                                            @foreach($classes as $class)
                                                <option value="{{$class->id}}">{{$class->name}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="clear-top-margin"><i class="fa fa-graduation-cap"></i>LAST SCHOOL</label>
                                        <input name="last_sch" value="{{old('last_sch')}}" type="text" placeholder="ABC SCHOOL" />
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="clear-top-margin"><i class="fa fa-puzzle-piece"></i>ROLL #</label>
                                        <input name="roll_no" type="text" value="{{old('roll_no')}}" placeholder="PTH05A01" />
                                    </div>
                                    <div class="clearfix"></div>

                                    <div class="col-sm-3">
                                        <label><i class="fa fa-futbol-o"></i>SPORTS</label>
                                        <select name="sports">
                                            <option></option>
                                            <option>Cricket</option>
                                            <option>Football</option>
                                            <option>Tennis</option>
                                            <option>Baseball</option>
                                            <option>Volley Ball</option>
                                            <option>Basket Ball</option>
                                            <option>Athletics</option>
                                        </select>
                                    </div>
                                    <div class="clearfix"></div>
                                    <br>
                                    <div class="col-sm-12">
                                        <button class="style-button btn btn-success"><i class="fa fa-paper-plane"></i> SAVE</button>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
                {{csrf_field()}}
            </form>
        </div>
        <div class="menu-togggle-btn">
            <a href="#menu-toggle" id="menu-toggle"><i class="fa fa-bars"></i></a>
        </div>
        @include('admin.partials.footer')
    </div>
@endsection


@section('js')
    <script type="text/javascript">
        $(function () {
            $(".chosen-select").chosen({no_results_text: "Oops, nothing found!"});
            $('#Student-form-submit').click(function (e) {
                $('#student-form').submit();
           })
        })
    </script>
@endsection

@section('css')
    <style>
        .style-button:hover{
            background-color: white;
            color: black;

        }
        .style-button{
            padding: 9px 12px 9px 12px;
            border-radius: 0;
        }
        .custom-clear-margin-botton{
            margin-bottom: -9px !important;
        }
        .error{
            border-color: #761c19 !important;
        }
    </style>
    @endsection