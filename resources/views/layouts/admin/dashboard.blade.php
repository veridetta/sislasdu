
@extends('layouts/contentLayoutMaster')

@section('title', 'Beranda')

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
@endsection
@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
@endsection

@section('content')
<!-- Dashboard Analytics Start -->
<section id="dashboard-analytics">
  @include('panels.flash')
      <!-- Greetings Card starts -->
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card card-profile">
          <img src="{{asset('images/logo/bg.jpg')}}" class="img-fluid card-img-top" alt="Profile Cover Photo">
          <div class="card-body text-center">
            <div class="profile-image-wrapper" bis_skin_checked="1">
              <div class="profile-image" bis_skin_checked="1">
                <div class="avatar bg-white" bis_skin_checked="1">
                  <img src="{{ Auth::user() ? Auth::user()->profile_photo_url : asset('images/portrait/small/avatar-s-11.jpg') }}" alt="Profile Picture">
                </div>
              </div>
            </div>
            <h3>{{$user->name}}</h3>
              <h6 class="text-muted">{{$user->nik}}</h6>
          </div>
        </div>
      </div>
      <div class="row match-height">
        <!-- Subscribers Chart Card starts -->
        <div class="col-lg-3 col-sm-6 col-12">
          <div class="card pb-2">
            <div class="card-header flex-column align-items-start pb-0">
              <div class="avatar bg-light-primary p-50 m-0">
                <div class="avatar-content">
                  <i data-feather="user-check" class="font-medium-5"></i>
                </div>
              </div>
              <h2 class="fw-bolder mt-1">{{$laki}}</h2>
              <p class="card-text">Total Laki-laki</p>
            </div>
          </div>
        </div>
        <!-- Subscribers Chart Card ends -->
        <!-- Subscribers Chart Card starts -->
        <div class="col-lg-3 col-sm-6 col-12">
          <div class="card pb-2">
            <div class="card-header flex-column align-items-start pb-0">
              <div class="avatar bg-light-primary p-50 m-0">
                <div class="avatar-content">
                  <i data-feather="user-check" class="font-medium-5"></i>
                </div>
              </div>
              <h2 class="fw-bolder mt-1">{{$perem}}</h2>
              <p class="card-text">Total Perempuan</p>
            </div>
          </div>
        </div>
        <!-- Subscribers Chart Card ends -->
        <!-- Subscribers Chart Card starts -->
        <div class="col-lg-3 col-sm-6 col-12">
          <div class="card pb-2">
            <div class="card-header flex-column align-items-start pb-0">
              <div class="avatar bg-light-primary p-50 m-0">
                <div class="avatar-content">
                  <i data-feather="user-check" class="font-medium-5"></i>
                </div>
              </div>
              <h2 class="fw-bolder mt-1">{{$anak}}</h2>
              <p class="card-text">Warga < 17</p>
            </div>
          </div>
        </div>
        <!-- Subscribers Chart Card ends -->
        <!-- Subscribers Chart Card starts -->
        <div class="col-lg-3 col-sm-6 col-12">
          <div class="card pb-2">
            <div class="card-header flex-column align-items-start pb-0">
              <div class="avatar bg-light-primary p-50 m-0">
                <div class="avatar-content">
                  <i data-feather="user-check" class="font-medium-5"></i>
                </div>
              </div>
              <h2 class="fw-bolder mt-1">{{$dewasa}}</h2>
              <p class="card-text">Warga > 17</p>
            </div>
          </div>
        </div>
        <!-- Subscribers Chart Card ends -->
        <!-- Subscribers Chart Card starts -->
        <div class="col-lg-3 col-sm-6 col-12">
          <div class="card pb-2">
            <div class="card-header flex-column align-items-start pb-0">
              <div class="avatar bg-light-primary p-50 m-0">
                <div class="avatar-content">
                  <i data-feather="users" class="font-medium-5"></i>
                </div>
              </div>
              <h2 class="fw-bolder mt-1">{{$terdaftar}}</h2>
              <p class="card-text">Warga Terdaftar</p>
            </div>
          </div>
        </div>
        <!-- Subscribers Chart Card ends -->
        <!-- Subscribers Chart Card starts -->
        <div class="col-lg-3 col-sm-6 col-12">
          <div class="card pb-2">
            <div class="card-header flex-column align-items-start pb-0">
              <div class="avatar bg-light-primary p-50 m-0">
                <div class="avatar-content">
                  <i data-feather="users" class="font-medium-5"></i>
                </div>
              </div>
              <h2 class="fw-bolder mt-1">3365</h2>
              <p class="card-text">Total Warga</p>
            </div>
          </div>
        </div>
        <!-- Subscribers Chart Card ends -->
      </div>
</section>
<!-- Dashboard Analytics end -->
@endsection

@section('vendor-script')
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
@endsection
@section('page-script')
  <!-- Page js files -->

@endsection
