@extends('layouts.app')

@section('content')
    @include('admin.partials.header')
    <div class="parent-wrapper" id="outer-wrapper">
        @include('admin.partials.sidebar')

        @yield('main')
    </div>

@endsection
