@extends('admin.index')

@section('css')
    <style>
        .fa-eye{
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
                    <h5 class="page-title"><i class="fa fa-sliders"></i>FEES BREAKDOWN</h5>
                    <div class="section-divider"></div>
                </div>
            </div>
            @include('partials.alert')
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                    <div class="dash-item first-dash-item">
                        <h6 class="item-title" style="text-transform: uppercase;"><i class="fa fa-user"></i>{{$name}}</h6>
                        <div class="inner-item">
                            <table id="datatable" class="table table-responsive table-bordered table-striped display responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th class="hidden-xs text-center"><i class="fa fa-code"></i>ACADEMIC YEAR</th>
                                    <th class="hidden-xs text-center">ACTION</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $item)
                                    <tr>
                                        <td class="hidden-xs text-center">{{$item->academic}}</td>
                                        <td class="hidden-xs text-center">
                                            <a class="btn btn-primary btn-sm " href="{{route('admin.details.fees.term.details',['id'=>$item->id])}}" title="Edit"><i class="fa fa-eye"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="clearfix"></div>
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
        <form id="delete-form" action="{{ route("admin.details.fees.delete", ":id") }}" style="display: none;" method="post">
            {{csrf_field()}}
            {{method_field('DELETE')}}
        </form>
    </div>
@endsection


@section('js')
    <script>
        $(function () {
            $('#datatable').DataTable();
        });

        $(function(){
            $(document).on('click','.delete',function (e) {
                var id = $(this).data('id');
                e.preventDefault();
                $('#deleteDetailModal').modal('show');
                $('#deleteDetailModal .save-items').click(function (e) {
                    var url = $('#delete-form').attr('action');
                    url = url.replace(':id', id);
                    $('#delete-form').attr('action', url).submit();
                })
            })
        })

    </script>
@endsection