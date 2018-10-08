@extends('admin.index')

@push('css')

@endpush


@section('title','Admin')


@section('main')
    <div class="main-content" id="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 clear-padding-xs">
                    <h5 class="page-title"><i class="fa fa-info"></i>MANAGE DETAILS</h5>
                    <div class="section-divider"></div>
                    <div class="dashboard-stats">
                        <div class="col-sm-6 col-md-3">
                            <div class="stat-item">
                                <div class="stats">
                                    <div class="col-xs-8 count">
                                        <h1><a href="{{route('admin.details.fees')}}" class="btn btn-success">ADD</a></h1>
                                        <p>SET FEES</p>
                                    </div>
                                    <div class="col-xs-4 icon">
                                        <i class="fa fa-dollar success-icon"></i>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="status">
                                    <p class="text-ex"><i class="fa fa-pencil-square-o"></i>10 Students Paid today</p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="stat-item">
                                <div class="stats">
                                    <div class="col-xs-8 count">
                                        <h1><a href="{{route('admin.details.items')}}" class="btn btn-success">ADD</a></h1>
                                        <p>FEES BREAKDOWN</p>
                                    </div>
                                    <div class="col-xs-4 icon">
                                        <i class="fa fa-braille success-icon"></i>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="status">
                                    <p class="text-danger"><i class="fa fa-exclamation-triangle"></i>No item add</p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="clearfix visible-sm"></div>
                        <div class="col-sm-6 col-md-3">
                            <div class="stat-item">
                                <div class="stats">
                                    <div class="col-xs-8 count">
                                        <h1><a href="{{route('admin.details.terms')}}" class="btn btn-success">ADD</a></h1>
                                        <p>SET SCHOOL TERMS</p>
                                    </div>
                                    <div class="col-xs-4 icon">
                                        <i class="fa fa-diamond success-icon"></i>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="status">
                                    <p class="text-look"><i class="fa fa-clock-o"></i>TERM 1</p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="stat-item">
                                <div class="stats">
                                    <div class="col-xs-8 count">
                                        <h1><a href="{{route('admin.details.academic')}}" class="btn btn-success">ADD</a></h1>
                                        <p>ACADEMIC YEAR</p>
                                    </div>
                                    <div class="col-xs-4 icon">
                                        <i class="fa fa-envelope-o success-icon"></i>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="status">
                                    <p class="text-success"><i class="fa fa-folder-open-o"></i>Add academic year here</p>
                                </div>
                                <div class="clearfix"></div>
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