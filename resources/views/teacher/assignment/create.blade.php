@extends('admin.index')

@section('css')
    <style>
        .errors{
            border: 1px solid red !important;
        }
        .submit-btn-cust{
            cursor: pointer;
        }


    </style>
@endsection


@section('title','Student')


@section('main')
    <div class="main-content" id="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 clear-padding-xs">
                    <h5 class="page-title"><i class="fa fa-code"></i>CREATE ASSIGNMENT</h5>
                    <div class="section-divider"></div>
                </div>
            </div>
            @include('partials.alert')
            <div class="row">
                <div class="col-lg-12 clear-padding-xs">
                    <div class="col-xs-12">
                        <div class="dash-item first-dash-item">
                            <h6 class="item-title"><i class="fa fa-edit"></i>CREATE NEW ASSIGNMENT</h6>
                            <form action="{{route('assignments.store')}}" method="post" enctype="multipart/form-data" id="assignmentForm">
                                <div class="inner-item">
                                    <div class="dash-form">
                                        <div class="col-sm-4">
                                            <label class="clear-top-margin"><i class="fa fa-user-circle-o"></i>CLASS</label>
                                            <select name="class">
                                                @foreach($classes as $class)
                                                    <option value="{{$class->id}}">{{$class->name}}</option>
                                                    @endforeach

                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label class="clear-top-margin"><i class="fa fa-code"></i>COURSE</label>
                                            <select name="course">
                                                @foreach($courses as $class)
                                                    <option value="{{$class->id}}">{{$class->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label class="clear-top-margin"><i class="fa fa-calendar"></i>SUBMIT BY</label>
                                            <input class="{{$errors->has('deadline')? 'errors':''}}" name="deadline" value="{{old('deadline')}}" type="datetime-local" placeholder="MM/DD/YYYY" required />
                                            @if($errors->has('deadline'))
                                                <span class="help-block text-danger">{{$errors->first('deadline')}}</span>
                                            @endif
                                        </div>
                                        <div class="col-sm-12">
                                            <label><i class="fa fa-edit"></i>REMARKS</label>
                                            <textarea class="{{$errors->has('remarks')? 'errors':''}}" value="{{old('remarks')}}" name="remarks" placeholder="REMARKS"></textarea>
                                            @if($errors->has('remarks'))
                                                <span class="help-block text-danger">{{$errors->first('remarks')}}</span>
                                            @endif
                                        </div>
                                        <div class="col-sm-12">
                                            <label><i class="fa fa-file-code-o"></i>UPLOAD FILE</label>
                                            <input type="file" value="{{old('ass_file.*')}}" class="file-input {{$errors->has('ass_file')? 'errors' : ''}}" name="ass_file[]" multiple/>
                                            @if($errors->has('ass_file'))
                                                <span class="help-block text-danger">{{$errors->first('ass_file')}}</span>
                                                @endif
                                        </div>
                                        <div class="col-sm-12">
                                            <a class="submit-btn-cust" data-toggle="modal" data-target="#deleteDetailModal"><i class="fa fa-paper-plane"></i> CREATE</a>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                {{csrf_field()}}
                            </form>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="menu-togggle-btn">
            <a href="#menu-toggle" id="menu-toggle"><i class="fa fa-bars"></i></a>
        </div>
        <div id="deleteDetailModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><i class="fa fa-trash"></i>CREATE ASSIGNMENT ?</h4>
                    </div>
                    <div class="modal-body">
                        <div class="table-action-box">
                            <a href="#" class="save-items save"><i class="fa fa-check"></i>YES</a>

                            <a href="#" class="cancel" data-dismiss="modal"><i class="fa fa-ban"></i>CLOSE</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.partials.footer')
    </div>
@endsection


@section('js')
    <script type="text/javascript">
        $(function () {
            $('#deleteDetailModal .save-items').click(function (e) {
                e.preventDefault();
                $('#assignmentForm').submit();
            })
        })
        $(function(){
            $('.errors').focus(function (e) {
                $(this).removeClass('errors');
                $(this).siblings('span').remove();
            })
        })
    </script>
@endsection