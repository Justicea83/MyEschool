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
                    <h5 class="page-title"><i class="fa fa-sliders"></i>ALL TERMS</h5>
                    <div class="section-divider"></div>
                </div>
            </div>
            @include('partials.alert')
            <div class="row">
                <div class="col-lg-12 clear-padding-xs">
                    <term-component></term-component>
                    <div class="col-sm-8">
                        <div class="dash-item first-dash-item">
                            <h6 class="item-title"><i class="fa fa-sliders"></i>ALL TERMS</h6>
                            <div class="inner-item">
                                <table id="datatable" class="display responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th><i class="fa fa-book"></i>NAME</th>
                                        <th class="hidden-xs"><i class="fa fa-code"></i>NUMBER</th>
                                        <th><i class="fa fa-user-secret"></i>STATUS</th>
                                        <th class="hidden-xs"><i class="fa fa-info-circle"></i>ACADEMIC YEAR</th>
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
                        <h4 class="modal-title"><i class="fa fa-trash"></i>DELETE CLASS</h4>
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

        <!--Edit details modal-->
        <div id="editDetailModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><i class="fa fa-edit"></i>EDIT TERM DETAILS</h4>
                    </div>
                    <div class="modal-body dash-form">
                        <div class="clearfix"></div>
                        <div class="col-sm-4">
                            <label><i class="fa fa-info-circle"></i>DISPLAY NAME</label>
                            <input type="text" class="display_name">
                        </div>
                        <div class="col-sm-8">
                            <label><i class="fa fa-info-circle"></i>STATUS</label>
                            <select name="" id="" class="status">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
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
        <form id="delete-form" action="{{ route("admin.details.terms.delete", ":id") }}" style="display: none;" method="post">
            {{method_field('DELETE')}}
            {{csrf_field()}}
        </form>
    </div>
@endsection


@section('js')
    <script>
        $(function() {
            var table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('date.academic.terms') !!}',
                columns: [
                    { data: 'display_name', },
                    { data: 'number', },
                    {
                        data: 'status',
                        render:function (status) {
                            if(status == 'active')
                                return '<span class="label label-success">Active</span>';
                            return '<span class="label label-danger">Inactive</span>';
                        }
                    },
                    {
                        data: 'academic',

                    },
                    /* DELETE */ {
                        mRender: function (data, type, row) {
                            return '<a class="btn btn-sm btn-primary edit" href="#" title="Edit" id="'+row.id+'"><i class="fa fa-pencil"></i></a>'+
                            ' <a class="btn btn-sm btn-danger delete" href="" id="'+row.id+'" title="Delete" ><i class="fa fa-trash"></i></a>';
                           ;
                        },
                    }
                ]
            });
            // Making TD editable exept td with action button
            setInterval( function () {
                table.ajax.reload( null, false ); // user paging is not reset on reload
            }, 90000 );
        });
        $(function(){
            $(document).on('click','.delete',function (e) {
                var id = $(this).attr('id');
                e.preventDefault();
                $('#deleteDetailModal').modal('show');
                $('#deleteDetailModal .save-items').click(function (e) {
                    e.preventDefault();
                    var url = $('#delete-form').attr('action');
                    // console.log(url);
                    url = url.replace(':id', id);
                    $('#delete-form').attr('action',url).submit();

                })
            })
        });
        $(function () {
            $(document).on('click','.edit',function (e) {
                e.preventDefault();
                var id = $(this).attr('id');
                var url = '/admin/school-details/terms-year/'+id;
                $.ajax({
                    url:url,
                    success:function (data) {
                        var options = $('#editDetailModal select option');
                        options.each(function (index) {
                            if($(this).attr('value') == data.status){
                                $(this).prop('selected',true);
                            }
                        });
                        $('#editDetailModal .display_name').val(data.display_name);
                        $('#editDetailModal').modal('show');
                    }
                });
                $('#editDetailModal .save').click(function (e) {
                    e.preventDefault();
                    axios.post('/admin/school-details/terms-year/update',{
                        status:$('#editDetailModal select').val(),id:id,display_name:  $('#editDetailModal .display_name').val()
                    }).then(function(data){
                       $('#editDetailModal').modal('hide');
                    }).catch(function(error){

                    })
                })
            })
        })
    </script>
@endsection

@section('css')
    <style>
        .fa{
            color: white;
        }
    </style>
    @endsection