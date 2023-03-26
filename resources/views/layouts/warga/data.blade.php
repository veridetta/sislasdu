
@extends('layouts/contentLayoutMaster')

@section('title', 'Data Saya')

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
        @if(auth()->user()->role=='warga')
        <button id="btn-add" class="dt-button add-new btn btn-warning mb-2"   @if ( $status>0) style="display:none" @endif
        aria-controls="DataTables_Table_0" type="button" data-bs-toggle="modal" data-bs-target="#backdrop"><span>Perbarui Data</span></button>
        @endif
        <div class="card">
          <div class="card-header bg-warning flex-column align-items-start">
            <div class="row col-12">
                <div class="col-lg-1 col-2">
                    <div class="avatar bg-light p-50 m-0">
                        <div class="avatar-content text-warning">
                          <i data-feather="users" class="font-medium-5"></i>
                        </div>
                      </div>
                </div>
                <div class="col-lg-11 col-10 my-auto">
                    <p class="h4 card-text text-white">Data Saya</p>
                </div>
            </div>
          </div>
          <div class="card-body" >
            <div class="card-datatable table-responsive pt-3">
              <table class="dt-anggota table">
                <thead class="table-light">
                  <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Kelamin</th>
                    <th>Golongan Darah</th>
                    <th>Agama</th>
                    <th>Pekerjaan</th>
                    <th>Pendidikan</th>
                    <th>Status Nikah</th>
                    <th>Status Tinggal</th>
                    <th>Status Warga</th>
                    <th>RT/RW</th>
                    <th>Desa</th>
                    <th>Kecamatan</th>
                    <th>Kabupaten</th>
                    <th>Provinsi</th>
                    <th>Provinsi</th>
                  </tr>
                </thead>
              </table>
            </div>
            
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
      aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel4">Perbarui Data Saya</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form class="add-new-user pt-0" method="POST" action="{{route('warga-add-warga')}}">
                @csrf
                <input type="hidden" name="id" value="" id="id_warga"/>
                <input type="hidden" name="id_users" value="" id="id_users"/>
                <div class="col-12 row">
                  <div class="col-6">
                    <div class="mb-1">
                      <label class="form-label" for="basic-icon-default-kode">NIK</label>
                      <input
                        type="text"
                        id="basic-icon-default-nik"
                        class="form-control dt-nik"
                        name="nik"
                        placeholder="320334XXX"
                        value="{{ Auth::user()->nik ?? old('nik')}}"
                      />
                      @error('nik')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>
                    <div class="mb-1">
                      <label class="form-label" for="basic-icon-default-nama">Nama </label>
                      <input
                        type="text"
                        id="basic-icon-default-nama"
                        class="form-control dt-nama"
                        name="nama"
                        placeholder="Ulvi S"
                        value="{{Auth::user()->name??old('nama')}}"
                      />
                      @error('nama')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>
                    <div class="mb-1">
                      <label class="form-label" for="basic-icon-default-keterangan">Tempat Lahir</label>
                      <input
                        type="text"
                        id="basic-icon-default-tempat_lahir"
                        class="form-control dt-tempat_lahir"
                        name="tempat_lahir"
                        placeholder="Tempat Lahir"
                        value="{{old('tempat_lahir')}}">
                      @error('tempat_lahir')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>
                    <div class="mb-1">
                      <label class="form-label" for="basic-icon-default-tanggal_lahir">Tenggal Lahir</label>
                      <input
                        type="text"
                        id="basic-icon-default-tanggal_lahir"
                        class="form-control dt-tanggal_lahir"
                        name="tanggal_lahir"
                        placeholder="21/02/1992"
                        value="{{old('tanggal_lahir')}}">
                      @error('tanggal_lahir')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>
                    <div class="mb-1">
                      <label class="form-label" for="basic-icon-default-jk">Jenis Kelamin</label>
                      <select
                        type="text"
                        id="basic-icon-default-jk"
                        class="form-control dt-jk"
                        name="jk"
                        value="{{old('jk')}}">
                        <option>Laki-laki</option>
                        <option>Perempuan</option>
                      </select>
                      @error('jk')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>
                    <div class="mb-1">
                      <label class="form-label" for="basic-icon-default-goldar">Golongan Darah</label>
                      <select
                        type="text"
                        id="basic-icon-default-goldar"
                        class="form-control dt-goldar"
                        name="goldar"
                        value="{{old('goldar')}}">
                        <option>Kosong</option>
                        <option>A</option>
                        <option>B</option>
                        <option>O</option>
                        <option>AB</option>
                      </select>
                      @error('goldar')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>
                    <div class="mb-1">
                      <label class="form-label" for="basic-icon-default-agama">Agama</label>
                      <select
                        type="text"
                        id="basic-icon-default-agama"
                        class="form-control dt-agama"
                        name="agama"
                        value="{{old('agama')}}">
                        <option>Islam</option>
                        <option>Hindu</option>
                        <option>Budha</option>
                        <option>Kristen</option>
                        <option>Konghucu</option>
                      </select>
                      @error('agama')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>
                    <div class="mb-1">
                      <label class="form-label" for="basic-icon-default-pekerjaan">Pekerjaan</label>
                      <select
                        type="text"
                        id="basic-icon-default-pekerjaan"
                        class="form-control dt-pekerjaan"
                        name="pekerjaan"
                        value="{{old('pekerjaan')}}">
                        <option>Pegawai Negeri</option>
                        <option>Pegawai Swasta</option>
                        <option>Wiraswasta</option>
                        <option>Buruh Lepas</option>
                        <option>Lainnya</option>
                      </select>
                      @error('pekerjaan')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>
                    <div class="mb-1">
                      <label class="form-label" for="basic-icon-default-pendidikan">Pendidikan</label>
                      <select
                        type="text"
                        id="basic-icon-default-pendidikan"
                        class="form-control dt-pendidikan"
                        name="pendidikan"
                        value="{{old('pendidikan')}}">
                        <option>Tidak Sekolah</option>
                        <option>SD /  Sederajat</option>
                        <option>SMP / Sederajat</option>
                        <option>SMA / Sederajat</option>
                        <option>S1</option>
                        <option>S2</option>
                        <option>S3</option>
                      </select>
                      @error('pendidikan')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="mb-1">
                      <label class="form-label" for="basic-icon-default-st_nikah">Status Nikah</label>
                      <select
                        type="text"
                        id="basic-icon-default-st_nikah"
                        class="form-control dt-st_nikah"
                        name="st_nikah"
                        value="{{old('st_nikah')}}">
                        <option>Belum Menikah</option>
                        <option>Menikah</option>
                        <option>Cerai</option>
                      </select>
                      @error('st_nikah')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>
                    <div class="mb-1">
                      <label class="form-label" for="basic-icon-default-st_tinggal">Status Tinggal</label>
                      <select
                        type="text"
                        id="basic-icon-default-st_tinggal"
                        class="form-control dt-st_tinggal"
                        name="st_tinggal"
                        value="{{old('st_tinggal')}}">
                        <option>Rumah Sendiri</option>
                        <option>Kontrak</option>
                        <option>Rumah Orang Tua / Saudara</option>
                        <option>Lainnya</option>
                      </select>
                      @error('st_tinggal')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>
                    <div class="mb-1">
                      <label class="form-label" for="basic-icon-default-st_data">Status Warga</label>
                      <select
                        type="text"
                        id="basic-icon-default-st_warga"
                        class="form-control dt-st_warga"
                        name="st_warga"
                        value="{{old('st_warga')}}">
                        <option>Penduduk</option>
                        <option>Bukan Penduduk</option>
                        <option>Lainnya</option>
                      </select>
                      @error('st_warga')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>
                    <div class="mb-1">
                      <label class="form-label" for="basic-icon-default-rtrw">RT/RW</label>
                      <select
                        type="text"
                        id="basic-icon-default-rtrw"
                        class="form-control dt-rtrw"
                        name="rtrw"
                        value="{{old('rtrw')}}">
                        @foreach ($rtrws as $rtrw)
                          <option>{{$rtrw->rt.'/'.$rtrw->rw}}</option>
                        @endforeach
                      </select>
                      @error('rtrw')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>
                    <div class="mb-1">
                      <label class="form-label" for="basic-icon-default-desa">Desa/Kelurahan</label>
                      <input
                        type="text"
                        id="basic-icon-default-desa"
                        class="form-control dt-desa"
                        name="desa"
                        value="Bakunglor">
                      @error('desa')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>
                    <div class="mb-1">
                      <label class="form-label" for="basic-icon-default-kecamatan">Kecamatan</label>
                      <input
                        type="text"
                        id="basic-icon-default-kecamatan"
                        class="form-control dt-kecamatan"
                        name="kecamatan"
                        value="Jamblang">
                      @error('kecamatan')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>
                    <div class="mb-1">
                      <label class="form-label" for="basic-icon-default-kota">Kota/Kabupaten</label>
                      <input
                        type="text"
                        id="basic-icon-default-kota"
                        class="form-control dt-kota"
                        name="kota"
                        value="Cirebon"
                        >
                      @error('kota')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>
                    <div class="mb-1">
                      <label class="form-label" for="basic-icon-default-provinsi">Provinsi</label>
                      <input
                        type="text"
                        id="basic-icon-default-provinsi"
                        class="form-control dt-provinsi"
                        name="provinsi"
                        value="Jawa Barat"
                        >
                      @error('provinsi')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>
                  </div>
                </div>

                <button type="submit" class="btn btn-primary me-1 data-submit">Kirim</button>
                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
              </form>
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
  /**
* DataTables Basic
*/

$(function () {
    'use strict';
    var dt_anggota = $('.dt-anggota');
    // DATA ANGGOTA
    if (dt_anggota.length) {
      var dt_ang = dt_anggota.DataTable({
        ajax: "{{route('warga-data-warga')}}",
        columns: [
          { data: '' },
          { data: 'nik' },
          { data: 'nama' },
          { data: 'tempat_lahir' },
          { data: 'tanggal_lahir' },
          { data: 'jk' },
          { data: 'goldar' },
          { data: 'agama' },
          { data: 'pekerjaan' },
          { data: 'pendidikan' },
          { data: 'st_nikah' },
          { data: 'st_tinggal' },
          { data: 'st_warga' },
          { data: 'rt' },
          { data: 'desa' },
          { data: 'kecamatan' },
          { data: 'kota' },
          { data: 'provinsi' },
          @if(auth()->user()->role=='warga'){ data: '' }@endif
        ],
        columnDefs: [
          {
            "defaultContent": "-",
            "targets": "_all"
          },
            {
            //number
            targets: 0,
            title: 'No',
            orderable: false,
            render: function (data, type, full, meta) {
              return meta.row + meta.settings._iDisplayStart + 1;
            }
          }@if(auth()->user()->role=='warga'),
          {
            //number
            targets: -1,
            title: 'Aksi',
            orderable: false,
            render: function (data, type, full, meta) {
              return '<div class="text-center"><a class="a_edit btn-sm btn btn-primary" pdf="'+full.id+'">Ubah</a></div>';
            }
          }@endif
        ],
        dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        displayLength: 7,
        lengthMenu: [7, 10, 25, 50, 75, 100],
        language: {
          paginate: {
            // remove previous & next text from pagination
            previous: '&nbsp;',
            next: '&nbsp;'
          }
        }
      });
    }
  });
  $('.dt-anggota').on('click', '.a_edit', function () {
        //dt_anggota.row($(this).parents('tr')).remove().draw();
        var dat = $(this).attr('pdf');
        var url = "//{{request()->getHttpHost()}}/warga/d/warga_data_single/"+dat;
        $.ajax({
          type: "GET",
          url: url,
          success: function(data){
              //if request if made successfully then the response represent the data
              console.log(data);
            var id_users=data.data.id+'&&'+data.data.kode+'&&'+data.data.id_users;
            $("#basic-icon-default-nik").val(data.data.nik).change();
            $("#basic-icon-default-nama").val(data.data.nama).change();
            $("#basic-icon-default-tempat_lahir").val(data.data.tempat_lahir).change();
            $("#basic-icon-default-jk").val(data.data.jk).change();
            $("#basic-icon-default-goldar").val(data.data.goldar).change();
            $("#basic-icon-default-agama").val(data.data.agama).change();
            $("#basic-icon-default-pekerjaan").val(data.data.pekerjaan).change();
            $("#basic-icon-default-pendidikan").val(data.data.pendidikan).change();
            $("#basic-icon-default-st_nikah").val(data.data.st_nikah).change();
            $("#basic-icon-default-st_tinggal").val(data.data.st_tinggal).change();
            $("#basic-icon-default-st_warga").val(data.data.st_warga).change();
            $("#basic-icon-default-rtrw").val(data.data.rt).change();
            $("#id_warga").val(data.data.id).change();
            $("#id_users").val(data.data.id_users).change();
            $("#btn-add").click();
          }
        });
    });

</script>

@endsection
