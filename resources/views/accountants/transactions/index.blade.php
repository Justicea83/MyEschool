@extends('admin.index')

@section('css')
    <style>
        .view{
            text-align: center;
        }
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
                    <h5 class="page-title"><i class="fa fa-user-secret"></i>ALL ACCOUNTANTS</h5>
                    <div class="section-divider"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 clear-padding-xs">
                    <div class="col-lg-12">
                        <div class="dash-item first-dash-item">
                            <div class="inner-item">
                                <div>

                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Today</a></li>
                                        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">This Week</a></li>
                                        <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">This Term</a></li>
                                        <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">This Year</a></li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="home">
                                            <br>
                                            @include('accountants.partials.today')
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="profile">
                                            <br>
                                            @include('accountants.partials.week')
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="messages">
                                            <br>
                                            @include('accountants.partials.term')
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="settings">
                                            <br>
                                            @include('accountants.partials.year')
                                        </div>
                                    </div>

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
        @include('admin.partials.footer')
    </div>



@endsection

@section('js')
    <script>
        $(function () {
            $('#weekTable').dataTable();
            $('#termTable').dataTable();
            $('#yearTable').dataTable();
        })
    </script>
    @endsection

