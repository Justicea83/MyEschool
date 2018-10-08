@extends('admin.index')

@section('css')
    <style>
        .view{
            text-align: center;
        }
    </style>
@endsection


@section('title','Admin')


@section('main')
    <div class="main-content" id="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 clear-padding-xs">
                    <h5 class="page-title"><i class="fa fa-user-secret"></i>FEE COLLECTION</h5>
                    <div class="section-divider"></div>
                </div>
            </div>
        </div>
        <add-fees></add-fees>
        <div class="menu-togggle-btn">
            <a href="#menu-toggle" id="menu-toggle"><i class="fa fa-bars"></i></a>
        </div>
        @include('admin.partials.footer')
    </div>


@endsection


@push('scripts')

@endpush