@extends('admin.index')

@section('css')
    <style>
        @media screen and (max-width: 700px){
            td:nth-child(4),td:nth-child(2),td:nth-child(5){
                display: none;
            }

        }
    </style>
@endsection


@section('title','Admin')


@section('main')
    <div class="main-content" id="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 clear-padding-xs">
                    <h5 class="page-title"><i class="fa fa-cogs"></i>ALL SUBJECTS</h5>
                    <div class="section-divider"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 clear-padding-xs">
                    <course-component></course-component>
                    <div class="col-sm-8">
                        <div class="dash-item first-dash-item">
                            <h6 class="item-title"><i class="fa fa-sliders"></i>ALL PAIRINGS</h6>
                            <div class="inner-item">
                                <table id="datatable" class="display responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th><i class="fa fa-book"></i>SUBJECT</th>
                                        <th class="hidden-xs"><i class="fa fa-code"></i>CODE</th>
                                        <th><i class="fa fa-cogs"></i>CLASS</th>
                                        <th class="hidden-xs"><i class="fa fa-user-secret"></i>TEACHER</th>
                                        <th class="hidden-xs"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="menu-togggle-btn">
            <a href="#menu-toggle" id="menu-toggle"><i class="fa fa-bars"></i></a>
        </div>
    @include('admin.partials.footer')

        <!-- Delete Modal -->
        <div id="deleteDetailModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><i class="fa fa-trash"></i>DELETE SUBJECT</h4>
                    </div>
                    <div class="modal-body">
                        <div class="table-action-box">
                            <a href="#" class="save"><i class="fa fa-check"></i>YES</a>
                            <a href="#" class="cancel" data-dismiss="modal"><i class="fa fa-ban"></i>CLOSE</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>

        <!--Edit details modal-->
        <div id="editDetailModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><i class="fa fa-edit"></i>EDIT SUBJECT DETAILS</h4>
                    </div>
                    <div class="modal-body dash-form">
                        <div class="col-sm-3">
                            <label class="clear-top-margin"><i class="fa fa-book"></i>NAME</label>
                            <input type="text" placeholder="Name" value="Mathematics" />
                        </div>
                        <div class="col-sm-3">
                            <label class="clear-top-margin"><i class="fa fa-code"></i>CODE</label>
                            <input type="text" placeholder="Code" value="MTH101" />
                        </div>
                        <div class="col-sm-3">
                            <label class="clear-top-margin"><i class="fa fa-book"></i>CLASS</label>
                            <select>
                                <option>-- Select --</option>
                                <option>5 STD</option>
                                <option>6 STD</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label class="clear-top-margin"><i class="fa fa-user-secret"></i>TEACHER</label>
                            <select>
                                <option>-- Select --</option>
                                <option>Lennore</option>
                                <option>John</option>
                            </select>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-sm-12">
                            <label><i class="fa fa-info-circle"></i>DESCRIPTION</label>
                            <textarea placeholder="Enter Description Here"></textarea>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="modal-footer">
                        <div class="table-action-box">
                            <a href="#" class="save"><i class="fa fa-check"></i>SAVE</a>
                            <a href="#" class="cancel" data-dismiss="modal"><i class="fa fa-ban"></i>CLOSE</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection


@section('js')
    <script type="text/javascript">
        $(function() {
            var table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('date.class_courses.show.all') !!}',
                columns: [
                    { data: 'course_name', },
                    { data: 'code', },
                    { data: 'class_name' },
                    {
                        mRender:function (data, type, row) {
                            return row.fname + ' ' + row.lname;
                        }
                    },
                    /* DELETE */ {
                        mRender: function (data, type, row) {
                            return '<a class="btn btn-sm btn-primary edit" href="#" title="Edit" id="'+row.id+'"><i class="fa fa-edit"></i></a>'+
                            ' <a class="btn btn-sm btn-danger delete" href="" id="'+row.id+'" title="Delete" ><i class="fa fa-trash"></i></a>';
                        },
                    }
                ]
            });
            // Making TD editable exept td with action button
            setInterval( function () {
                table.ajax.reload( null, false ); // user paging is not reset on reload
            }, 300000000 );
        });
    </script>
@endsection

@section('css')
    <style>
        .fa{
            color: white;
        }
        td{
            text-align: center;
        }
        th{
            text-align: center;
        }
    </style>
    @endsection