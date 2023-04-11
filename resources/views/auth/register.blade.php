@extends('layouts/umumLayout')

@section('title', 'Register Page')

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/authentication.css')) }}">
@endsection

@section('content')
  <div class="auth-wrapper auth-basic px-2 bg-warning bg-darken-3">
    <div class="col-6 row my-2">
      <!-- Register Basic -->
      <div class="card mb-0">
        <div class="card-body">
          <div class="brand-logo">
            <div class="avatar bg-white">
              <img
                src="{{asset('images/logo/logo.png')}}"
                alt="avatar"
                width="130"
                height="80"
              />
            </div>
          </div>
          <a href="#" class="brand-logo">
            <h2 class="brand-text text-warning text-center ms-1">SISLASDU | DESA BAKUNGLOR</h2>
          </a>
          <form class="auth-register-form mt-2" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="col-12 my-2 justify-content-center">
              <input type="hidden" name="jabatan" value="warga"/>
                <div class="mb-1">
                  <label for="register-nik" class="form-label">NIK</label>
                  <input type="text" class="form-control @error('nik') is-invalid @enderror" id="register-nik" name="nik" placeholder="32xxxxx" aria-describedby="register-nik" tabindex="1" autofocus value="{{ old('nik') }}" />
                  @error('nik')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="mb-1">
                  <label for="register-name" class="form-label">Nama</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" id="register-name"
                    name="name" placeholder="Ulvi" aria-describedby="register-name" tabindex="2"
                    value="{{ old('name') }}" />
                  @error('name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="mb-1">
                  <label for="register-email" class="form-label">Email</label>
                  <input type="email" class="form-control @error('email') is-invalid @enderror" id="register-email"
                    name="email" placeholder="Ulvi" aria-describedby="register-name" tabindex="2"
                    value="{{ old('email') }}" />
                  @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="mb-1">
                  <label for="register-password" class="form-label">Password</label>
    
                  <div class="input-group input-group-merge form-password-toggle @error('password') is-invalid @enderror">
                    <input type="password" class="form-control form-control-merge @error('password') is-invalid @enderror"
                      id="register-password" name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="register-password" tabindex="3" />
                    <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                  </div>
                  @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
    
                <div class="mb-1">
                  <label for="register-password-confirm" class="form-label">Confirm Password</label>
    
                  <div class="input-group input-group-merge form-password-toggle">
                    <input type="password" class="form-control form-control-merge" id="register-password-confirm"
                      name="password_confirmation"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="register-password" tabindex="3" />
                    <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                  </div>
                </div>
            </div>
            <button type="submit" class="btn btn-warning w-100" tabindex="5">Buat Akun</button>
          </form>

          <p class="text-center mt-2">
            <span class="text-black">Sudah mempunyai akun?</span>
            @if (Route::has('login'))
              <a href="{{ route('login') }}">
                <span>Masuk</span>
              </a>
            @endif
          </p>
      <!-- /Register basic -->
    </div>
  </div>
@endsection
