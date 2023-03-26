@extends('layouts/umumLayout')

@section('title', 'Dashboard')

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/authentication.css')) }}">
@endsection

@section('content')
  <div class="auth-wrapper auth-basic px-1 bg-muted bg-darken-3">
    <div class=" col-12 justify-content-center text-center">
      <!-- Login basic -->
      <h1>SELAMAT DATANG DI WEBSITE PELAYANAN DESA BAKUNGLOR</h1>
      <hr>
      <img src="{{asset('images/logo/bg.jpg')}}" class="img-fluid"/>
      </div>
      <!-- /Login basic -->
    </div>
  </div>
@endsection
