@extends('layouts.app')

@section('content')
    @include('partials.header')
    <div class="parent-wrapper" id="outer-wrapper">
        @include('partials.sidebar')

        @yield('main')
    </div>

@endsection
