@extends('admin.index')

@push('css')

@endpush


@section('title','Admin')


@section('main')
    <div class="main-content" id="content-wrapper">
        <div class="container-fluid">
          <div class="row">
              <div class="col-lg-12 clear-padding-xs">
                  <h5 class="page-title"><i class="fa fa-clock-o"></i>TIME SLOTS</h5>
                  <div class="section-divider"></div>
              </div>
          </div>

          <div class="row">
                <div class="col-lg-12 clear-padding-xs">
                    <div class="col-sm-12">
                        <div class="dash-item first-dash-item">
                            <h6 class="item-title"><i class="fa fa-plus-circle"></i>ADD SLOT</h6>
                            <div class="inner-item">
                                <div class="dash-form">

                                <form method="post" action="{{route('timetables.store')}}">
                                   {{csrf_field()}}

                                    <div class="col-sm-3">
                                        <label class="clear-top-margin"><i class="fa fa-calendar"></i>DAY</label>
                                        <select name="day" required>
                                            <option value="">-- Select --</option>
                                            <option value="1">Monday</option>
                                            <option value="2">TUESDAY</option>
                                            <option value="3">WEDNESDAY</option>
                                            <option value="4">THURSDAY</option>
                                            <option value="5">FRIDAY</option>
                                            <option value="6">SATURDAY</option>
                                            <option value="7">SUNDAY</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-3">
                                        <label class="clear-top-margin"><i class="fa fa-clock-o"></i>PERIOD</label>
                                        <select name="slot">
                                          <option value="">select</option>
                                          @foreach ($slot as $slot)
                                            <option value="{{$slot->id}}">{{$slot->period}}</option>
                                          @endforeach
                                        </select>

                                    </div>

                                    <div class="col-sm-3">
                                        <label class="clear-top-margin"><i class="fa fa-book"></i>CLASS</label>
                                        <select name="stage" required>
                                            <option value="">-- Select --</option>
                                            @foreach ($stage as $stage)
                                              <option value="{{$stage->id}}">{{$stage->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-3">
                                        <label class="clear-top-margin"><i class="fa fa-users"></i>SLOT ENDS</label>
                                        <input type="time" name="slot2" required></input>
                                    </div>

                                    <div class="col-sm-3">
                                        <label><i class="fa fa-code"></i>SUBJECT</label>
                                        <select name="subject" required>
                                            <option value="">-- Select --</option>
                                            @foreach ($courses as $courses)
                                              <option value="{{$courses->id}}">{{$courses->name}}</option>
                                            @endforeach;
                                        </select>
                                    </div>

                                    <div class="col-sm-3">
                                        <label><i class="fa fa-user"></i>TEACHER</label>
                                        <select name="teacher" required>
                                            <option value="">-- Select --</option>
                                            @foreach ($teachers as $teachers)
                                              <option value="{{$teachers->id}}">{{$teachers->fname.' '.$teachers->lname}}</option>
                                            @endforeach;
                                        </select>
                                    </div>

                                    <div class="col-sm-3">
                                        <label><i class="fa fa-home"></i>CLASS ROOM</label>
                                        <select name="room" required>
                                            <option value="">-- Select --</option>
                                            <option value="101">101</option>
                                            <option value="103">103</option>
                                         </select>
                                    </div>

                                    <div class="col-sm-4" style="margin-top:10px">
                                     <button type="submit" class="btn btn-success btn-block">SAVE</button>
                                      </div>

                                 </form>

                                    <div class="clearfix"></div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                          </div>
                       </div>
                    <div class="col-sm-12">
                        <div class="dash-item">
                            <h6 class="item-title"><i class="fa fa-sliders"></i>ALL SLOTS</h6>
                            <div class="inner-item">
                                <table id="datatable" class="display responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th><i class="fa fa-calendar"></i>DAY</th>
                                        <th><i class="fa fa-clock-o"></i>SLOT</th>
                                        <th><i class="fa fa-book"></i>CLASS</th>
                                        <th><i class="fa fa-code"></i>SUBJECT</th>
                                        <th><i class="fa fa-user"></i>TEACHER</th>
                                        <th><i class="fa fa-home"></i>ROOM</th>
                                        <th><i class="fa fa-sliders"></i>ACTION</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $datum)
                                    <tr>
                                        <td>{{$datum->day}}</td>
                                        <td>{{$datum->slot}}</td>
                                        <td>{{$datum->class_name}}</td>
                                        <td>{{$datum->course_name}}</td>
                                        <td>{{$datum->teacher_fname." ".$datum->teacher_lname}}</td>
                                        <td>{{$datum->room}}</td>
                                        <td class="actionlink">
                                          <a class="edit" data-id="{{$datum->id}}" href="#" title="Edit"><i class="fa fa-edit"></i></a>
                                            <a class="delete" href="#" data-id="{{$datum->id}}" title="Delete" data-toggle="modal" data-target="#deleteDetailModal"><i class="fa fa-remove"></i></a>
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
          <div class="dash-footer col-lg-12">
              <p>Copyright Pathshala</p>
          </div>

        </div>
        </div>
          <!-- Delete Modal -->
          <div id="deleteDetailModal" class="modal fade" role="dialog">
              <div class="modal-dialog">
                  <!-- Modal content-->
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title"><i class="fa fa-trash"></i>DELETE SECTION</h4>
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
                          <h4 class="modal-title"><i class="fa fa-edit"></i>EDIT SECTION DETAILS</h4>
                      </div>

                      <div class="modal-body dash-form">
                          <div class="col-sm-4">
                              <label class="clear-top-margin"><i class="fa fa-book"></i>DAY</label>
                              <select name="day" class="day_select" >
                                  <option value="MONDAY">Monday</option>
                                  <option value="TUESDAY">TUESDAY</option>
                                  <option value="WEDNESDAY">WEDNESDAY</option>
                                  <option value="FRIDAY">FRIDAY</option>
                                  <option value="SATURDAY">SATURDAY</option>
                                  <option value="SUNDAY">SUNDAY</option>
                              </select>
                          </div>

                          <div class="col-sm-4">
                              <label class="clear-top-margin"><i class="fa fa-code"></i>SLOTS</label>
                              <select name="slot" class="slot_select">
                                   <option value=""></option>
                                  <option value="09-10">09-10 AM</option>
                                  <option value="10-11">10-11 PM</option>
                              </select>

                          </div>

                          <div class="col-sm-4">
                              <label class="clear-top-margin"><i class="fa fa-user-secret"></i> CLASS</label>
                              <select name="stage" class="class_select">
                                  @foreach ($calass as $calass)
                                    <option>{{$calass->name}}</option>
                                  @endforeach
                              </select>
                          </div>

                          <div class="col-sm-4">
                              <label><i class="fa fa-user-secret"></i>SUBJECT</label>
                              <select class="course_select">

                                  @foreach ($courso as $courso)
                                    <option value="{{$courso->id}}">{{$courso->name}}</option>
                                  @endforeach;
                              </select>
                          </div>

                          <div class="col-sm-4">
                              <label><i class="fa fa-user-secret"></i>TEACHER</label>
                              <select class="teacher-select">
                                @foreach ($teachor as $teachor)
                                  <option value="{{$teachor->id}}">{{$teachor->fname.' '.$teachor->lname}}</option>
                                @endforeach;
                              </select>
                          </div>

                          <div class="col-sm-4">
                              <label><i class="fa fa-user-secret"></i>ROOM</label>
                              <select class="room_select">
                                  <option>5 STD</option>
                                  <option>6 STD</option>
                              </select>
                          </div>

                          <div class="clearfix"></div>

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


          <form id="DeleteForm" action="{{route('timetables.destroy',":id")}}" method="post">
            {{method_field('DELETE')}}
            {{csrf_field()}}
          </form>

@endsection


@section('js')
  <script type="text/javascript">
  $(function(){
    $('#datatable').DataTable();
    //alert('sdfsdf');
  //  $('.chosen').chosen();
  });

  $(function(){
    $('.edit').click(function(e){
      e.preventDefault()
      var id = $(this).data('id');
     var url = '/admin/timetables/'+id+'/edit';
     $.ajax({
       url:url,
       success:function(data){
         var id = data.teacher;
         console.log(id);
         var teacher = $('.teacher-select option');
         teacher.each(function(){
           if($(this).attr('value') == id){
             $(this).prop('selected',true);
           }
         })

         var day = $('.day_select option');
          day.each(function () {
            if ($(this).attr('value') == data.day) {
              $(this).prop('selected',true);
            }
          })

          var course = $('.course_select option');
           course.each(function () {
             if ($(this).attr('value') == data.stage) {
               $(this).prop('selected',true);
             }
           })

           var slot = $('.slot_select option');
            slot.each(function () {
              if ($(this).attr('value') == data.slot) {
                $(this).prop('selected',true);
              }
            })

            var clas = $('.class_select option');
             clas.each(function () {
               if ($(this).attr('value') == data.stage) {
                 $(this).prop('selected',true);
               }
             })

             var room = $('.room_select option');
              room.each(function () {
                if ($(this).attr('value') == data.stage) {
                  $(this).prop('selected',true);
                }
              })

         $('#editDetailModal').modal('show');
       }
     });

    });
  })

  $(function(){
    $('#deleteDetailModal .save').click(function (e) {
      e.preventDefault()
      var id = $('.delete').data('id');
      var url = $('#DeleteForm').attr('action');
      url= url.replace(':id',id);
      $('#DeleteForm').attr('action',url).submit();
  })
})
  </script>
@endsection
