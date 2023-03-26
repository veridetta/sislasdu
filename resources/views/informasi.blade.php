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
      <div class="col-lg-12 col-sm-12 col-12">
        <div class="card">
          <div class="card-header bg-light-primary flex-column align-items-start">
            <div class="row col-12">
                <div class="col-lg-1 col-2">
                    <div class="avatar bg-light-primary p-50 m-0">
                        <div class="avatar-content">
                          <i data-feather="bell" class="font-medium-5"></i>
                        </div>
                      </div>
                </div>
                <div class="col-lg-11 col-10 my-auto">
                    <p class="h4 card-text">Informasi Terkini</p>
                </div>
            </div>
          </div>
          <div class="card-body" bis_skin_checked="1">
            @foreach ($data as $datas)
            <?php 
              $k = array_rand($val);
              $timestamp = strtotime($datas->tanggal);
              $day = $result = substr(date('l', $timestamp), 0, 3);
            ?>
              <div class="card card-user-timeline mb-0">
                <div class="card-body pb-0">
                    <ul class="timeline ms-50">
                      <li class="timeline-item pb-0">
                          <span class="timeline-point timeline-point-{{$val[$k]}} timeline-point-indicator"></span>
                          <div class="timeline-event">
                            <div class="card card-developer-meetup pt-0 ps-0 mb-0">
                                <div class="card-body  pt-0 ps-0 pb-0">
                                  <div class="meetup-header d-flex align-items-center  pt-0 ps-0">
                                    <div class="meetup-day">
                                      <h6 class="mb-0 text-uppercase">{{$day}}</h6>
                                      <h4 class="mb-0">{{date('d',$timestamp)}}</h4>
                                      <h6 class="mb-0">{{date('Y',$timestamp)}}</h6>
                                    </div>
                                    <div class="my-auto">
                                      <h5 class="card-title mb-25">{{$datas->judul}}</h5>
                                      <p class="card-text mb-0">{{$datas->isi}}</p>
                                      @if ($datas->foto)
                                        <a class="d-flex flex-row p-1 align-items-center" onclick="viewImage('{{$datas->foto}}','{{$datas->judul}}')">
                                          <img class="me-1" src="http://sislasdu.test/images/icons/jpg.png" alt="data.json" height="18">
                                          <span class="mb-0 h6 badge badge-light-primary badge-glow">buka lampiran</span>
                                        </a>
                                      @else
                                        <span class="mb-0 h6 badge badge-light-secondary">tidak ada lampiran</span>
                                      @endif
                                    </div>
                                  </div>
                                </div>
                            </div>
                          </div>
                      </li>
                    </ul>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
      <!-- /Login basic -->
    </div>
  </div>
@endsection
