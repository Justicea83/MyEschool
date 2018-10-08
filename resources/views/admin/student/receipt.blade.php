@extends('admin.index')

@section('css')
    <style>
        @media print{
            #Print-button{
                display: none;
            }
            .dashboard-top-nav{
                display: none;
            }
            #sidebar-wrapper{
                display: none;
            }
            .first-dash-item{
                text-align: center !important;
            }
            .dash-footer{
                display: none;
            }
            table{
                background-color: gray !important;
                text-align-all: center !important;
                border: 2px solid black !important;
            }
        }
    </style>
@endsection


@section('title','Admin')


@section('main')
    <div class="main-content" id="content-wrapper">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12 clear-padding-xs">
                    <h5 class="page-title"><i class="fa fa-users"></i>STUDENT RECEIPT</h5>
                    <div class="section-divider"></div>
                </div>
            </div>
            @include('partials.alert')
            <div class="row">
                <div class="col-lg-12 clear-padding-xs">
                    <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                        <div class="dash-item first-dash-item">
                            <h6 class="item-title" style="text-transform: uppercase;"><i class="fa fa-user"></i>{{$info->lname}} {{$info->mname}} {{$info->fname}}</h6>
                            <div class="inner-item">
                                <table id="print-table" class="table table-striped table-bordered table-responsive">
                                    <thead>
                                    <tr>
                                        <th class="text-center">Username</th>
                                        <th class="text-center">Password</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th style="font-weight: normal" class="text-center">{{$info->username}}</th>
                                        <th style="font-weight: normal" class="text-center">password</th>
                                    </tr>
                                    </tbody>
                                </table>
                                <button id="Print-button" class="btn btn-success">Print</button>
                            </div>
                            <div class="clearfix"></div>
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
        $('#Print-button').click(function () {
            print();
        })
        function Popup(data) {
            //Create your new window
            var w = window.open('', 'Student Receipt', 'height=400,width=600');
            w.document.write('<html><head><title>Student Receipt</title>');
            //Include your stylesheet (optional)
            w.document.write('<link rel="stylesheet" href="/public/css/app.css" type="text/css" />');
            w.document.write('</head><body>');
            //Write your content
            w.document.write(data);
            w.document.write('</body></html>');
            w.print();
            w.close();

            return true;
        }
    </script>
@endsection