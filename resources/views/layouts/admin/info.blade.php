
@extends('layouts/contentLayoutMaster')

@section('title', 'Informasi Desa')

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
      <div class="col-lg-12 col-sm-12 col-12">
        @if(auth()->user()->role=='admin')
        <button id="btn-add" class="dt-button add-new btn btn-warning mb-2"  
        aria-controls="DataTables_Table_0" type="button" data-bs-toggle="modal" data-bs-target="#backdrop"><span>Tambah Informasi</span></button>
        @endif
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
      <!-- Modal to add new user starts-->
      <div
      class="modal modal-warning fade text-start"
      id="backdrop"
      tabindex="-1"
      aria-labelledby="myModalLabel4"
      data-bs-backdrop="false"
      aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel4">Tambah Informasi</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form class="add-new-user pt-0" enctype="multipart/form-data"  method="POST" action="{{route('info-add-admin')}}">
                @csrf
                <input type="hidden" name="id" value="" id="id_info"/>
                <div class="mb-1">
                  <label class="form-label" for="basic-icon-default-judul">Judul Informasi</label>
                  <input
                    type="text"
                    id="basic-icon-default-rt"
                    class="form-control dt-rt"
                    name="judul"
                    placeholder="Judul"
                    value="{{old('judul')}}"
                  />
                  @error('judul')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
                <div class="mb-1">
                  <label class="form-label" for="basic-icon-default-isi">Isi Informasi</label>
                  <textarea
                    type="text"
                    id="basic-icon-default-isi"
                    class="form-control dt-isi"
                    name="isi"
                    placeholder="Isi"
                    value="{{old('isi')}}"></textarea>
                  @error('isi')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
                <div class="mb-1">
                  <label class="form-label" for="basic-icon-default-tanggal">Tanggal dibuat</label>
                  <input
                    type="date"
                    id="basic-icon-default-tanggal"
                    class="form-control dt-tanggal"
                    placeholder="12/02/2022"
                    name="tanggal"
                    value="{{old('tanggal')}}"
                  />
                  @error('tanggal')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
                <div class="mb-1">
                  <label class="form-label" for="basic-icon-default-email">Foto</label>
                  <input
                    type="file"
                    id="basic-icon-default-file"
                    class="form-control dt-file"
                    placeholder="upload image"
                    name="info_file"
                  />
                </div>
                <button type="submit" class="btn btn-primary me-1 data-submit">Kirim</button>
                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="disabled-backdrop-ex">
        <!-- Button trigger modal -->
        <button type="button" class="d-none btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#backdrop2" id="img_button">
          Disabled Backdrop
        </button>
        <!-- Modal -->
        <div
          class="modal modal-primary fade text-start"
          id="backdrop2"
          tabindex="-1"
          aria-labelledby="myModalLabelx"
          data-bs-backdrop="false"
          aria-hidden="true"
        >
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabelx">Disabled Backdrop</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body text-center">
                <img src="" alt="" id="img_modal" title="" class="img-fluid"/>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Kembali</button>
              </div>
            </div>
          </div>
        </div>
      </div>
</section>
<!-- Dashboard Analytics end -->
@endsection

@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/jszip.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/pdfmake.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/vfs_fonts.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.html5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.print.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.rowGroup.min.js')) }}"></script>
@endsection
@section('page-script')
<script>
  function viewImage(image,judul){
    var locat = "{{ asset('/storage/images/') }}"+"/"+image;
    $("#myModalLabelx").html(judul);
    $('#img_button').trigger('click');
    $("#img_modal").attr("src",locat);
  }
</script>

@endsection
