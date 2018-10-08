@extends('admin.index')

@section('css')
    <style>
        .fa{
            color: white;
        }
    </style>
@endsection


@section('title','Teacher')


@section('main')
    <div class="main-content" id="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 clear-padding-xs">
                    <h5 class="page-title"><i class="fa fa-eye"></i>VIEW ATTENDENCE</h5>
                    <div class="section-divider"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 clear-padding-xs">
                    <div class="col-lg-12">
                        <div class="dash-item">
                            <h6 class="item-title"><i class="fa fa-info-circle"></i>MARK ATTENDENCE</h6>
                            <div class="inner-item">
                                <table id="attendenceDetailedTable" class="display responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th><i class="fa fa-user"></i>NAME</th>
                                        <th><i class="fa fa-check"></i>STATUS</th>
                                        <th class="hidden-xs">REMARKS</th>
                                        <th class="hidden-xs">ACTIONS</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($details as $detail)
                                        <tr>
                                            <td>{{$detail->fname}} {{$detail->lname}}</td>
                                            @if($detail->status == 'present')
                                                <td class="text-success"><span class="label label-success">
                                                    {{$detail->status}}
                                                </span></td>
                                                @else
                                                <td class="text-success"><span class="label label-danger">
                                                    {{$detail->status}}
                                                </span></td>
                                                @endif
                                            <td class="hidden-xs"><strong>{{$detail->remarks}}</strong></td>
                                            <td class=" hidden-xs">
                                                <a class="btn btn-primary btn-sm edit-item" data-id="{{$detail->id}}" href="#" title="Edit"><i class="fa fa-pencil"></i></a>
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
                            <label><i class="fa fa-info-circle"></i>NAME</label>
                            <input type="text" class="name">
                        </div>
                        <div class="col-sm-4">
                            <label><i class="fa fa-info-circle"></i>STATUS</label>
                            <select name="" id="" class="status">
                                <option value="present">Present</option>
                                <option value="absent">Absent</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label><i class="fa fa-info-circle"></i>REMARKS</label>
                            <input type="text" class="remarks">
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
        @include('admin.partials.footer')
    </div>
@endsection


@section('js')
    <script type="text/javascript">
        $(function () {
            $(document).on('click','.edit-item',function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                var url = '/teacher/attendance-view/'+id;
                console.log(url)
                $.ajax({
                    url:url,
                    success:function (data) {
                        var options = $('#editDetailModal select option');
                        options.each(function (index) {
                            if($(this).attr('value') == data.status){
                                $(this).prop('selected',true);
                            }
                        });
                        var name = data.fname + ' '+data.lname;
                        $('#editDetailModal .name').val(name);
                        $('#editDetailModal .remarks').val(data.remarks);
                        $('#editDetailModal').modal('show');
                    }
                });
                $('#editDetailModal .save').click(function (e) {
                    e.preventDefault();
                    axios.post('/teacher/attendance-view/update',{
                        status:$('#editDetailModal select').val(),
                        id:id,
                        remarks:$('#editDetailModal .remarks').val()
                    }).then(function(data){
                        $('#editDetailModal').modal('hide');
                        location.reload();
                    }).catch(function(error){

                    })
                })
            })
        })
    </script>
@endsection