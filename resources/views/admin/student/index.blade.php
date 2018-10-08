@extends('admin.index')

@push('css')

@endpush


@section('title','Admin')


@section('main')
    <div class="main-content" id="content-wrapper">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12 clear-padding-xs">
                    <h5 class="page-title"><i class="fa fa-users"></i>ALL STUDENT</h5>
                    <div class="section-divider"></div>
                </div>
            </div>
            @include('partials.alert')
            <div class="row">
                <div class="col-lg-12 clear-padding-xs">
                    <div class="col-lg-12">
                        <div class="dash-item first-dash-item">
                            <h6 class="item-title"><i class="fa fa-user"></i>STUDENTS</h6>
                            <div class="inner-item">
                                <table id="attendenceDetailedTable" class="display responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th><i class="fa fa-user"></i>NAME</th>
                                        <th class="hidden-xs"><i class="fa fa-id-card"></i>REG #</th>
                                        <th><i class="fa fa-book"></i>CLASS</th>
                                        <th class="hidden-xs"><i class="fa fa-phone"></i>CONTACT #</th>
                                        <th class="hidden-xs"><i class="fa fa-envelope-o"></i>EMAIL</th>
                                        <th class="hidden-xs"><i class="fa fa-tasks"></i>ACTION</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $item)
                                        <tr>
                                            <td>{{$item->fname}} {{$item->lname}}</td>
                                            <td class="hidden-xs">{{$item->reg_no}}</td>
                                            <td>{{$item->class_name}}</td>
                                            <td class="hidden-xs">{{$item->parent_contact}}</td>
                                            <td class="hidden-xs">{{$item->parent_email}}</td>
                                            <td class="action-link hidden-xs">
                                                <a class="edit" href="#" title="Edit" id="{{$item->id}}"><i class="fa fa-edit"></i></a>
                                                <a class="delete" href="#" title="Delete" id="{{$item->id}}"><i class="fa fa-remove"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
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
                        <h4 class="modal-title"><i class="fa fa-trash"></i>DELETE STUDENT</h4>
                    </div>
                    <div class="modal-body">
                        <div class="table-action-box">
                            <a href="#" class="save save-items"><i class="fa fa-check"></i>YES</a>
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
                        <h4 class="modal-title"><i class="fa fa-edit"></i>EDIT STUDENT DETAILS</h4>
                    </div>
                    <div class="modal-body dash-form">
                        <div class="col-sm-3">
                            <label class="clear-top-margin"><i class="fa fa-user"></i>FIRST NAME</label>
                            <input type="text" placeholder="First Name" value="John" />
                        </div>
                        <div class="col-sm-3">
                            <label class="clear-top-margin"><i class="fa fa-user"></i>MIDDLE NAME</label>
                            <input type="text" placeholder="Middle Name" value="Fidler" />
                        </div>
                        <div class="col-sm-3">
                            <label class="clear-top-margin"><i class="fa fa-user"></i>LAST NAME</label>
                            <input type="text" placeholder="Last Name" value="Doe" />
                        </div>
                        <div class="col-sm-3">
                            <label class="clear-top-margin"><i class="fa fa-book"></i>CLASS</label>
                            <input type="text" placeholder="Standard" value="5 STD" />
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-sm-3">
                            <label><i class="fa fa-cogs"></i>SECTION</label>
                            <input type="text" placeholder="Section" value="PTH05A" />
                        </div>
                        <div class="col-sm-3">
                            <label><i class="fa fa-puzzle-piece"></i>ROLL #</label>
                            <input type="text" placeholder="Roll Number" value="Fidler" />
                        </div>
                        <div class="col-sm-3">
                            <label><i class="fa fa-phone"></i>CONTACT #</label>
                            <input type="text" placeholder="Contact Number" value="1234567890" />
                        </div>
                        <div class="col-sm-3">
                            <label><i class="fa fa-envelope-o"></i>EMAIL</label>
                            <input type="text" placeholder="Email" value="john@gmail.com" />
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
    <form id="delete-form" action="{{ route("students.destroy", ":id") }}" style="display: none;" method="post">
        {{csrf_field()}}
        {{method_field('DELETE')}}
    </form>
@endsection


@section('js')
    <script>
        $(function(){
            $(document).on('click','.delete',function (e) {
                var id = $(this).attr('id');
                e.preventDefault();
                $('#deleteDetailModal').modal('show');
                $('#deleteDetailModal .save-items').click(function (e) {
                    e.preventDefault();
                    var url = $('#delete-form').attr('action');
                    url = url.replace(':id', id);
                    $('#delete-form').attr('action',url).submit();

                })
            })
        });
    </script>
@endsection