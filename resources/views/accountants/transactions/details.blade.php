@extends('admin.index')

@section('css')
    <style>
        tr > td{
            text-align: left;
        }
    </style>
@endsection


@section('title','Admin')


@section('main')
    <div class="main-content" id="content-wrapper">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12 clear-padding-xs">
                    <h5 class="page-title"><i class="fa fa-money"></i>TRANSACTION DETAILS</h5>
                    <div class="section-divider"></div>
                </div>
            </div>
            @include('partials.alert')
            <div class="row">
                <div class="col-lg-12 clear-padding-xs">
                    <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                        <div class="dash-item first-dash-item">
                            <h6 class="item-title" style="text-transform: uppercase;">PAYMENT MODE : {{$item->payment_mode == 'cash' ? 'CASH':'CHEQUE'}}
                                <br>
                                <br> STUDENT NAME : {{$item->lname}} {{$item->mname}} {{$item->fname}}</h6>
                            <div class="inner-item {{$item->payment_mode == 'cheque' ? 'hide':''}}">
                                {{--//cash--}}
                                <table class="table table-striped table-bordered table-responsive">
                                    <tbody>
                                    <tr>
                                        <td class="text-center">Class</td>
                                        <td class="text-center">{{$item->name}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Term</td>
                                        <td class="text-center">{{$item->display_name}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Academic Year</td>
                                        <td class="text-center">{{$item->year_name}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Amount Payable</td>
                                        <td class="text-center">{{number_format($item->amount_payable,2)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Amount Payed</td>
                                        <td class="text-center">{{number_format($item->amount,2)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Amount Owing</td>
                                        <td class="text-center">{{number_format($item->balance,2)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Received By</td>
                                        <td class="text-center">{{$item->accountant}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Period Received</td>
                                        <td class="text-center">{{$item->created_at}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="inner-item {{$item->payment_mode == 'cash' ? 'hide':''}}" >
                                {{--//cheques--}}
                                <table class="table table-striped table-bordered table-responsive">
                                    <tbody>
                                    <tr>
                                        <td class="text-center">Class</td>
                                        <td class="text-center">{{$item->name}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Term</td>
                                        <td class="text-center">{{$item->display_name}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Academic Year</td>
                                        <td class="text-center">{{$item->year_name}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Bank Name</td>
                                        <td class="text-center">{{$item->bank_name}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Branch</td>
                                        <td class="text-center">{{$item->branch}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Amount Payable</td>
                                        <td class="text-center">{{number_format($item->amount_payable,2)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Cheque Number</td>
                                        <td class="text-center">{{$item->cheque_no}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Cheque Date</td>
                                        <td class="text-center">{{$item->cheque_date}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Amount Payed</td>
                                        <td class="text-center">{{number_format($item->amount,2)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Amount Owing</td>
                                        <td class="text-center">{{number_format($item->balance,2)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Received By</td>
                                        <td class="text-center">{{$item->accountant}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Period Received</td>
                                        <td class="text-center">{{$item->created_at}}</td>
                                    </tr>
                                    </tbody>
                                </table>
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

@endsection