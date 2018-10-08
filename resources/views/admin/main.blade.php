@extends('admin.index')

@push('css')

@endpush


@section('title','Admin')


@section('main')
    <div class="main-content" id="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 clear-padding-xs">
                    <h5 class="page-title"><i class="fa fa-home"></i>HOME</h5>
                    <div class="section-divider"></div>
                    <div class="dashboard-stats">
                        <div class="col-sm-6 col-md-3">
                            <div class="stat-item">
                                <div class="stats">
                                    <div class="col-xs-8 count">
                                        <h1>{{$student_count}}</h1>
                                        <p>STUDENTS</p>
                                    </div>
                                    <div class="col-xs-4 icon">
                                        <i class="fa fa-users ex-icon"></i>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="status">
                                    <p class="text-ex"><i class="fa fa-pencil-square-o"></i>10 Absent Today</p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="stat-item">
                                <div class="stats">
                                    <div class="col-xs-8 count">
                                        <h1>{{$teacher_count}}</h1>
                                        <p>TEACHERS</p>
                                    </div>
                                    <div class="col-xs-4 icon">
                                        <i class="fa fa-user-secret danger-icon"></i>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="status">
                                    <p class="text-danger"><i class="fa fa-exclamation-triangle"></i>5 On Leave Today</p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="clearfix visible-sm"></div>
                        <div class="col-sm-6 col-md-3">
                            <div class="stat-item">
                                <div class="stats">
                                    <div class="col-xs-8 count">
                                        <h1>0</h1>
                                        <p>EVENTS</p>
                                    </div>
                                    <div class="col-xs-4 icon">
                                        <i class="fa fa-flag look-icon"></i>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="status">
                                    <p class="text-look"><i class="fa fa-clock-o"></i>1 Event tomorrow</p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="stat-item">
                                <div class="stats">
                                    <div class="col-xs-8 count">
                                        <h1>0</h1>
                                        <p>MESSAGES</p>
                                    </div>
                                    <div class="col-xs-4 icon">
                                        <i class="fa fa-envelope-o success-icon"></i>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="status">
                                    <p class="text-success"><i class="fa fa-folder-open-o"></i>10 Unread messages</p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="clearfix visible-sm"></div>

                        @if(Auth::user()->can('add_student_fee_payments'))
                            <div class="col-sm-6 col-md-3 top-margin">
                                <div class="stat-item">
                                    <div class="stats">
                                        <div class="col-xs-8 count">
                                            <h1>{{number_format($today_amount,2)}}</h1>
                                            <p>Today Amount</p>
                                        </div>
                                        <div class="col-xs-4 icon">
                                            <i class="fa fa-code ex-icon"></i>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="status">
                                        <p class="text-ex"><i class="fa fa-pencil-square-o"></i>No Pending Transactions</p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3 top-margin">
                                <div class="stat-item">
                                    <div class="stats">
                                        <div class="col-xs-8 count">
                                            <h1>{{number_format($term_amount,2)}}</h1>
                                            <p>Term Transactions</p>
                                        </div>
                                        <div class="col-xs-4 icon">
                                            <i class="fa fa-line-chart danger-icon"></i>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="status">
                                        <p class="text-danger"><i class="fa fa-exclamation-triangle"></i></p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            @endif
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