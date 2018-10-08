@extends('students.index')

@push('css')
    <style>
        /*.fa {
            color:white;
        }*/
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
                <div class="col-lg-12">
                    <div class="dash-item">
                        <h6 class="item-title"><i class="fa fa-book"></i>RECENT ASSIGNMENTS</h6>
                        <div class="inner-item">
                            <table id="attendenceDetailedTable" class="display responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th><i class="fa fa-book"></i>SUBJECT</th>
                                    <th><i class="fa fa-info-circle"></i>DESCRIPTION</th>
                                    <th><i class="fa fa-user"></i>TEACHER NAME</th>
                                    <th><i class="fa fa-calendar"></i>SUBMIT BY</th>
                                    <th><i class="fa fa-link"></i>LINK</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($assignments as $assignment)
                                    <tr>
                                        <td>{{$assignment->name}}</td>
                                        <td>{{$assignment->remarks}}</td>
                                        <td>{{$assignment->fname}} {{$assignment->lname}}</td>
                                        <td>{{$assignment->deadline}}</td>
                                        <td><a href="{{route('student.ass.down.file',['file'=>$assignment->id])}}"><i class="fa fa-download"></i>DOWNLOAD</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
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