@extends('layouts.app')

@push('css')
    <style>
        body{
            background-image: url({{asset('img/register.jpeg')}});
            background-size: cover;
        }
    </style>
@endpush


@section('title','Login')


@section('content')
    @include('partials.alert')
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
            <login-component></login-component>
        </div>
    </div>
@endsection


@push('scripts')

@endpush