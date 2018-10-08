@extends('admin.index')

@push('css')

@endpush


@section('title','Admin')


@section('main')
    <div class="main-content" id="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 clear-padding-xs">
                    <h5 class="page-title"><i class="fa fa-users"></i>CLASS TIMETABLE</h5>
                    <div class="section-divider"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 clear-padding-xs">
                    <div class="col-lg-12">
                        <div class="dash-item first-dash-item">
                            <h6 class="item-title"><i class="fa fa-search"></i>MAKE SELECTION</h6>
                            <div class="inner-item dash-search-form">

                                <div class="col-sm-4">
                                    <label>CLASS</label>
                                    <select name="stage" id="class12" required>
                                      <option value="">--SELECT--</option>
                                        @foreach($view_stage as $viewstage)
                                        <option value="{{$viewstage->id}}">{{$viewstage->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                              <!--
                                <div class="col-sm-4">
                                    <label>SECTION</label>
                                    <select>
                                        <option>PTH05A</option>
                                        <option>PTH05B</option>
                                        <option>PTH06A</option>
                                        <option>PTH06B</option>
                                    </select>
                                </div>
                              -->
                                <div class="col-sm-4">
                                    <button type="submit" id="select_class" class="submit-btn"><i class="fa fa-search"></i>SELECT</button>

                                </div>

                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="dash-item">
                            <h6 class="item-title"><i class="fa fa-edit"></i>EDIT TIMETABLE</h6>
                            <div class="inner-item">
                                <table id="datatable" class="display responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>

                                        <th><i class="fa fa-calendar"></i>THURSDAY</th>

                                    </tr>
                                    </thead>

                                </table>
                                <div class="table-action-box">
                                    <a href="#" class="save"><i class="fa fa-check"></i>SAVE</a>
                                    <a href="#" class="cancel"><i class="fa fa-ban"></i>CANCEL</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="menu-togggle-btn">
            <a href="#menu-toggle" id="menu-toggle"><i class="fa fa-bars"></i></a>
        </div>
        <div class="dash-footer col-lg-12">
            <p>Copyright Pathshala</p>
        </div>
        <form id="getData" action="{{route('timetables.show',":id")}}" method="get">

        </form>
    </div>
@endsection

@section('js')
<script type="text/javascript">

$(function() {
  $('#select_class').on('click',function (e) {
    e.preventDefault();
    var table = null;
  //  var test = document.getElementById("class12").value;
  //  var url = '/admin/timetables/'+test;
  var  id = $('#class12').val();
  var url = $('#getData').attr('action');
  url = url.replace(":id",id);
  //alert(url);
      table = $('#datatable').DataTable({
      processing: true,
      serverSide: true,
      ajax: url,
      columns: [
          { data: 'class_name', }


      ]
  });
  // Making TD editable exept td with action button
  setInterval( function () {
      table.ajax.reload( null, false ); // user paging is not reset on reload
  }, 300000000 );
});

});


</script>
@endsection

@push('scripts')

@endpush
