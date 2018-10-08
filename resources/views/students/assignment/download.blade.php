@extends('students.index')

@push('css')
    <style>
        .fa {
            color:white;
        }
    </style>
@endpush


@section('title','Student')


@section('main')
    <div class="main-content" id="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 clear-padding-xs">
                    <h5 class="page-title"><i class="fa fa-code"></i>ASSIGNMENTS</h5>
                    <div class="section-divider"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 clear-padding-xs">

                    <div class="col-md-6 col-md-offset-3">
                        <div class="dash-item">
                            <h6 class="item-title"><i class="fa fa-book"></i>RECENT ASSIGNMENTS</h6>
                            <div class="inner-item">
                                <table id="attendenceDetailedTable" class="display responsive nowrap" cellspacing="0" width="100%">
                                    <thead>

                                    <tr>
                                        <th><i class="fa fa-pencil-square-o"></i>DATE</th>
                                        <th><i class="fa fa-info"></i>ACTION</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($assigments as $assigment)
                                        <tr>
                                            <td>{{$assigment->date}}</td>
                                            <td>
                                                <a href="{{route('student.ass.down.detail',['date'=>$assigment->id])}}" class="btn btn-sm btn-primary"><span class="fa fa-eye"></span></a>
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