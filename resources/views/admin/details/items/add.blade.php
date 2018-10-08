@extends('admin.index')

@section('css')
    <style>
        @media screen and (max-width: 700px){
            td:nth-child(4),td:nth-child(3),td:nth-child(5){
                display: none;
            }
        }
        .fa-trash{
            color: white;
        }
        .fa-edit{
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
                    <h5 class="page-title"><i class="fa fa-sliders"></i>ALL ITEMS</h5>
                    <div class="section-divider"></div>
                </div>
            </div>
            @include('partials.alert')
            <div class="row">
                <div class="col-lg-12 clear-padding-xs">
                    <breakdown-component></breakdown-component>
                    <div class="col-sm-8">
                        <div class="dash-item first-dash-item">
                            <h6 class="item-title"><i class="fa fa-sliders"></i>ALL CLASSES</h6>
                            <div class="inner-item">
                                <table id="datatable" class="display responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th><i class="fa fa-book"></i>Name</th>
                                        <th><i class="fa fa-code"></i>Amount</th>
                                        <th class="hidden-xs"><i class="fa fa-user-secret"></i>Academic Year</th>
                                        <th class="hidden-xs"><i class="fa fa-info-circle"></i>Term</th>
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
            <form action="{{route('classes.update', ":id")}}" method="post">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"><i class="fa fa-edit"></i>EDIT CLASS DETAILS</h4>
                        </div>
                        <div class="modal-body dash-form">
                            <div class="col-sm-4">
                                <label class="clear-top-margin"><i class="fa fa-book"></i>CLASS</label>
                                <input type="text" name="name" id="class-name" placeholder="CLASS"  />
                            </div>
                            <div class="col-sm-4">
                                <label class="clear-top-margin"><i class="fa fa-code"></i>CLASS CODE</label>
                                <input type="text" name="code" id="class-code" placeholder="CLASS CODE"  />
                            </div>
                            <input type="hidden" name="hidden" id="hidden-input">
                            <div class="col-sm-4">
                                <label class="clear-top-margin"><i class="fa fa-user-secret"></i>CLASS TEACHER</label>
                                <select name="teacher" id="teachers">

                                </select>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-sm-12">
                                <label><i class="fa fa-info-circle"></i>DESCRIPTION</label>
                                <textarea name="description" placeholder="Enter Description Here" id="class-description"></textarea>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="modal-footer">
                            <div class="table-action-box">
                                <a href="#" id="modal-submit-button" class="save"><i class="fa fa-check"></i>SAVE</a>
                                <a href="#" class="cancel" data-dismiss="modal"><i class="fa fa-ban"></i>CLOSE</a>
                            </div>
                        </div>
                    </div>
                </div>
                {{method_field('PUT')}}
                {{csrf_field()}}
            </form>
        </div>
        <form id="delete-form" action="{{ route("admin.details.items.delete", ":id") }}" style="display: none;" method="post">
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
                ajax: '{!! route('items.fees.endpoint') !!}',
                columns: [
                    { data: 'name', },
                    { data: 'amount', },
                    { data: 'academic', },
                    { data: 'term',  },

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
                    //console.log(url);
                    $('#delete-form').attr('action',url).submit();

                })
            })
        });
    </script>
@endsection

@section('css')
    <style>
        .fa{
            color: white;
        }
    </style>
    @endsection