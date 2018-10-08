@extends('admin.index')

@section('css')
    <style>
        .view{
            text-align: center;
        }
        table .fa{
            color: white;
        }
    </style>
@endsection


@section('title','Admin')


@section('main')
    <div class="main-content" id="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 clear-padding-xs">
                    <h5 class="page-title"><i class="fa fa-user-secret"></i>ALL ROLES</h5>
                    <div class="section-divider"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 clear-padding-xs">
                    <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                        <div class="dash-item first-dash-item">
                            <h6 class="item-title"><i class="fa fa-user"></i>ROLES</h6>
                            <div class="inner-item">
                                <table id="attendenceDetailedTable" class="display responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th><i class="fa fa-user"></i>NAME</th>
                                        <th><i class="fa fa-phone"></i>DISPLAY NAME</th>
                                        <th><i class="fa fa-tasks"></i>ACTION</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($roles as $role)
                                        <tr>
                                            <td>{{$role->name}}</td>
                                            <td>{{$role->display_name}}</td>
                                            <td>
                                                <a href="{{route('roles.show',['id'=>$role->id])}}" class="btn btn-primary btn-sm"><span class="fa fa-pencil"></span></a>
                                                <a href="" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></a>
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
    </div>
    <!-- Delete Modal -->
    <div id="deleteDetailModal" class="modal fade" role="dialog">
        <form action="{{route('accountants.destroy','$accountant->id')}}" method="post">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><i class="fa fa-trash"></i>DELETE TEACHER</h4>
                    </div>
                    <div class="modal-body">
                        <div class="table-action-box">
                            <button type="submit" href="#" class="save"><i class="fa fa-check"></i>YES</button>
                            <a href="#" class="cancel" data-dismiss="modal"><i class="fa fa-ban"></i>CLOSE</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            {cssrf_field()}
            {{method_field('DELETE')}}
        </form>
    </div>


    <!--Edit details modal-->
    <div id="editDetailModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-edit"></i>EDIT ACCONTANT DETAILS</h4>
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

@endsection

