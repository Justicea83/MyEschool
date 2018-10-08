@extends('admin.index')

@section('css')
    <style>
        .edit-submit{
            cursor: pointer;
        }
    </style>
@endsection


@section('title','Teacher')


@section('main')
    <div class="main-content" id="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 clear-padding-xs">
                    <h5 class="page-title"><i class="fa fa-pencil-square-o"></i>MARK ATTENDENCE</h5>
                    <div class="section-divider"></div>
                </div>
            </div>
            @include('partials.alert')
            <form id="delete-form" action="{{route('teacher.attendance.mark.save')}}"  method="post">
                <div class="row">
                <div class="col-lg-12 clear-padding-xs">
                    <div class="col-lg-12">
                        <div class="dash-item">
                            <h6 class="item-title"><i class="fa fa-info-circle"></i>MARK ATTENDENCE</h6>
                            <div class="inner-item">
                                <table id="attendenceDetailedTable" class="display responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th><i class="fa fa-puzzle-piece"></i>ROLL #</th>
                                        <th><i class="fa fa-user"></i>NAME</th>
                                        <th><i class="fa fa-check"></i>STATUS</th>
                                        <th><i class="fa fa-edit"></i>REMARKS</th>
                                        <th><i class="fa fa-ban"></i>ATTENDENCE BLOCKED?</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($students as $student)
                                        <tr>
                                            <td>{{$student->ref_no}}</td>
                                            <td>{{$student->fname}} {{$student->lname}}</td>
                                            <td>
                                                <select name="status[]" class="datatable-select">
                                                    <option value="present">Present</option>
                                                    <option value="absent">Absent</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input name="remarks[]" type="text" placeholder="Remarks" class="datatable-input"/>
                                            </td>
                                            <td class="text-success">NO</td>
                                        </tr>

                                    @endforeach

                                    </tbody>
                                </table>
                                <div class="table-action-box">
                                    <a data-toggle="modal" data-target="#deleteDetailModal" class="save edit-submit"><i class="fa fa-check"></i>MARK</a>
                                    <a href="#" class="cancel"><i class="fa fa-ban"></i>CANCEL</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                {{csrf_field()}}
                <input type="hidden" name="student" value="{{$studentId}}">
                <input type="hidden" name="class" value="{{$classId}}">
            </form>
        </div>
        <div class="menu-togggle-btn">
            <a href="#menu-toggle" id="menu-toggle"><i class="fa fa-bars"></i></a>
        </div>
        @include('admin.partials.footer')
        <div id="deleteDetailModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><i class="fa fa-trash"></i>SUBMIT ATTENDANCE ?</h4>
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

    </div>
@endsection


@section('js')
    <script type="text/javascript">
        $(function () {
            $('.save-items').click(function (e) {
                e.preventDefault();
                $('#delete-form').submit();
            })
        })
    </script>
@endsection