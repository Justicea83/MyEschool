@extends('admin.index')

@section('css')
    <style>
        .view{
            text-align: center;
        }
        table .fa{
            color: white;
        }
        ul{
            list-style: none;
        }
        ul > li > ul > li > label{
            font-weight: normal;
        }
    </style>
@endsection


@section('title','Admin')


@section('main')
    <div class="main-content" id="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 clear-padding-xs">
                    <h5 class="page-title"><i class="fa fa-user-secret"></i>EDIT ROLES</h5>
                    <div class="section-divider"></div>
                </div>
            </div>
            @include('partials.alert')
            <div class="row">
                <div class="col-lg-12 clear-padding-xs">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="dash-item first-dash-item">
                            <h6 class="item-title"><i class="fa fa-user"></i>ALL PERMISSIONS</h6>
                            <div class="inner-item">
                                <form action="{{route('roles.update',['id'=>$role_id])}}" method="post">
                                    {{ method_field("PUT") }}
                                    <ul>
                                        <li>
                                            <div class="form-group">
                                                <label for="" class="control-label">Display Name</label>
                                                <input type="text" name="display_name" disabled value="{{$display_name}}" class="form-control">
                                            </div>
                                        </li>
                                    </ul>
                                    <ul>
                                    @foreach($tables as $table=>$permission)
                                            <li>
                                                <input type="checkbox" id="{{$table}}" class="permission-group">
                                                <label for="{{$table}}">{{title_case(str_replace('_',' ',$table))}}</label>
                                                <ul>
                                                    @foreach($permission as $perm)
                                                        <li>
                                                            <input type="checkbox" id="permission-{{$perm->id}}" name="permissions[]" class="the-permission" value="{{$perm->id}}" @if(in_array($perm->name, $role_permissions)) checked @endif>
                                                            <label for="permission-{{$perm->id}}">{{title_case(str_replace('_', ' ', $perm->name))}}</label>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <ul>
                                        <li>
                                            <button type="submit" class="btn btn-success">Submit</button>
                                        </li>
                                    </ul>
                                    {{csrf_field()}}
                                </form>
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

@section('js')
    <script>
        $('document').ready(function () {
            //$('.toggleswitch').bootstrapToggle();

            $('.permission-group').on('change', function(){
                $(this).siblings('ul').find("input[type='checkbox']").prop('checked', this.checked);
            });

            $('.permission-select-all').on('click', function(){
                $('ul.permissions').find("input[type='checkbox']").prop('checked', true);
                return false;
            });

            $('.permission-deselect-all').on('click', function(){
                $('ul.permissions').find("input[type='checkbox']").prop('checked', false);
                return false;
            });

            function parentChecked(){
                $('.permission-group').each(function(){
                    var allChecked = true;
                    $(this).siblings('ul').find("input[type='checkbox']").each(function(){
                        if(!this.checked) allChecked = false;
                    });
                    $(this).prop('checked', allChecked);
                });
            }

            parentChecked();

            $('.the-permission').on('change', function(){
                parentChecked();
            });
        });
    </script>
@endsection

