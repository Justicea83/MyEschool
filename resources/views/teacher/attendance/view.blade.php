@extends('admin.index')

@push('css')

@endpush


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
                    <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                        <div class="dash-item">
                            <h6 class="item-title"><i class="fa fa-info-circle"></i>VIEW ATTENDENCE</h6>
                            <div class="inner-item">
                                <table id="attendenceDetailedTable" class="display responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th><i class="fa fa-edit"></i>DATE</th>
                                        <th><i class="fa fa-tasks"></i>ACTIONS</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($dates as $date)
                                        <tr>
                                            <td>{{$date->date}}</td>
                                            <td class="action-link">
                                                <a class="edit" href="{{route('teacher.attendance.view.details',['id'=>$date->date])}}" title="Edit"><i class="fa fa-eye"></i></a>
                                                <a class="delete" href="#" title="Delete"><i class="fa fa-remove"></i></a>
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
@endsection


@push('scripts')

@endpush