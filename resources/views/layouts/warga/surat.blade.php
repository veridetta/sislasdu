
@extends('layouts/contentLayoutMaster')

@section('title', 'Layanan Surat')

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
        <button id="btn-add" class="dt-button add-new btn btn-warning mb-2 @if ( $status<1) style="display:none" @endif"  
        aria-controls="DataTables_Table_0" type="button" data-bs-toggle="modal" data-bs-target="#backdrop"><span>Buat Surat Baru</span></button>
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
                    <p class="h4 card-text text-white">Riwayat Surat</p>
                </div>
            </div>
          </div>
          <div class="card-body" >
            <div class="card-datatable table-responsive pt-3">
              <table class="dt-anggota table">
                <thead class="table-light">
                  <tr>
                    <th>No</th>
                    <th>Nomor Surat</th>
                    <th>Nama</th>
                    <th>Nik</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis-kelamin</th>
                    <th>Agama</th>
                    <th>Pekerjaan</th>
                    <th>Status Nikah</th>
                    <th>Alamat</th>
                    <th>Keperluan</th>
                    <th>Status</th>
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
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel4">Pengajuan Surat</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form class="add-new-user pt-0" method="POST" action="{{route('surat-add-warga')}}">
                @csrf
                <input type="hidden" name="id" value="" id="id_surat"/>
                <input type="hidden" name="kode" value="" id="kode"/>
                <div class="mb-1">
                  <label class="form-label" for="basic-icon-default-id_jenissurat">Jenis Surat</label>
                  <select
                    type="text"
                    id="basic-icon-default-id_jenissurat"
                    class="form-control dt-id_jenissurat"
                    name="id_jenissurat"
                    value="{{old('id_jenissurat')??$user->id_jenissurat}}">
                    @foreach ($jeniss as $jenis)
                    <option value="{{$jenis->kode}}">{{$jenis->nama}}</option>
                    @endforeach
                  </select>
                  @error('id_jenissurat')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
                <div class="mb-1">
                  <label class="form-label" for="basic-icon-default-kode">NIK</label>
                  <input
                    type="text"
                    id="basic-icon-default-nik"
                    class="form-control dt-nik"
                    name="nik"
                    placeholder="320334XXX"
                    value="{{old('nik') ?? $user->nik}}"
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
                    value="{{ old('nama')?? $user->nama}}"
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
                    value="{{old('tempat_lahir')?? $user->tempat_lahir}}">
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
                    value="{{old('tanggal_lahir')?? $user->tanggal_lahir}}">
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
                    value="{{old('jk')?? $user->jk}}">
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
                  <label class="form-label" for="basic-icon-default-agama">Agama</label>
                  <select
                    type="text"
                    id="basic-icon-default-agama"
                    class="form-control dt-agama"
                    name="agama"
                    value="{{old('agama')?? $user->agama}}">
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
                    value="{{old('pekerjaan')?? $user->pekerjaan}}">
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
                  <label class="form-label" for="basic-icon-default-st_nikah">Status Nikah</label>
                  <select
                    type="text"
                    id="basic-icon-default-st_nikah"
                    class="form-control dt-st_nikah"
                    name="st_nikah"
                    value="{{old('st_nikah')?? $user->st_nikah}}">
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
                  <label class="form-label" for="basic-icon-default-alamat">Alamat</label>
                  <?php
                  $alamatx = 'RT/RW '.$user->rt.' Desa '.$user->desa.' Kec. '.$user->kecamatan.' Kab/Kota '.$user->kota.' Provinsi '.$user->provinsi;
                  ?>
                  <textarea
                    type="text"
                    id="basic-icon-default-alamat"
                    class="form-control dt-alamat"
                    name="alamat">{{old('alamat')?? $alamatx}}</textarea>
                  @error('st_nikah')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
                <div class="mb-1">
                  <label class="form-label" for="basic-icon-default-keperluan">Keperluan</label>
                  <input
                    type="text"
                    id="basic-icon-default-keperluan"
                    class="form-control dt-keperluan"
                    name="keperluan"
                    placeholder="Pengantar dll"
                    value="{{old('keperluan')}}">
                  @error('keperluan')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
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
        ajax: "{{route('surat-data-warga')}}",
        columns: [
          { data: '' },
          { data: 'kode' },
          { data: 'nama' },
          { data: 'nik' },
          { data: 'tempat_lahir' },
          { data: 'tanggal_lahir' },
          { data: 'jk' },
          { data: 'agama' },
          { data: 'pekerjaan' },
          { data: 'st_nikah' },
          { data: 'alamat' },
          { data: 'keperluan' },
          { data: 'status' }
          @if(auth()->user()->role=='admin'){ data: '' }@endif
        ],
        columnDefs: [
          {
            "defaultContent": "-",
            "targets": "_all"
          },{
            //status
            targets: -1,
            title: 'Status',
            orderable: false,
            render: function (data, type, full, meta) {
              var ret="";
              var $status_number = full['status'];
              var $status = {
                "1": { title: 'Pengajuan Ketua RT', class: 'badge-light-primary' },
                "2": { title: 'Pengajuan Ketua RW', class: ' badge-light-primary' },
                "3": { title: 'Pengajuan Kades', class: ' badge-light-primary' },
                "4": { title: 'Disetujui', class: ' badge-light-success' },
              };
              if (typeof $status[$status_number] === 'undefined') {
                return data;
              }
              var ss='<span class="badge rounded-pill block-badge ' +
                $status[$status_number].class +
                '">' +
                $status[$status_number].title +
                '</span>';
                ret="<span class='badge badge-primary'>Menunggu Persetujuan Ketua RT</span>";
                print="<a class='mt-1 btn-sm a_delete btn btn-success disabled' pdf='"+full.id+"' href='//{{request()->getHttpHost()}}/warga/l/cetak/"+full.id+"''>"+
                feather.icons['donwload'].toSvg({ class: 'font-small-4 text-white' }) + " Unduh</a>";
              
              return ss+print;
            }
          },
            {
            //number
            targets: 0,
            title: 'No',
            orderable: false,
            render: function (data, type, full, meta) {
              return meta.row + meta.settings._iDisplayStart + 1;
            }
          }
          @if(auth()->user()->role=='admin'),
          {
            //number
            targets: -1,
            title: 'Aksi',
            orderable: false,
            render: function (data, type, full, meta) {
              return '<div class="text-center"><a class="a_edit btn-sm btn btn-primary" pdf="'+full.id+'">Ubah</a> <a class=" btn-sm a_delete btn btn-warning" pdf="'+full.id+'" href="//{{request()->getHttpHost()}}/warga/l/surat_delete/'+full.id+'">Hapus</a></div>';
            }
          }@endif
        ],
        dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        displayLength: 7,
        lengthMenu: [7, 10, 25, 50, 100, 75],
        language: {
          paginate: {
            // remove previous & next text from pagination
            previous: '&nbsp;',
            next: '&nbsp;'
          }
        }

      });
      feather.replace();
    }
  });
  $('.dt-anggota').on('click', '.a_edit', function () {
        //dt_anggota.row($(this).parents('tr')).remove().draw();
        var dat = $(this).attr('pdf');
        var url = "//{{request()->getHttpHost()}}/warga/l/surat_data_single/"+dat;
        $.ajax({
          type: "GET",
          url: url,
          success: function(data){
              //if request if made successfully then the response represent the data
              console.log(data);
            var id_users=data.data.id+'&&'+data.data.rt+'&&'+data.data.rw;
            $("#basic-icon-default-kode").val(data.data.rt).change();
            $("#basic-icon-default-nama").val(data.data.rw).change();
            $("#basic-icon-default-nik").val(data.data.rw).change();
            $("#basic-icon-default-tempat_lahir").val(data.data.rw).change();
            $("#basic-icon-default-tanggal_lahir").val(data.data.rw).change();
            $("#basic-icon-default-jk").val(data.data.rw).change();
            $("#basic-icon-default-agama").val(data.data.rw).change();
            $("#basic-icon-default-pekerjaan").val(data.data.rw).change();
            $("#basic-icon-default-st_nikah").val(data.data.rw).change();
            $("#basic-icon-default-alamat").val(data.data.rw).change();
            $("#basic-icon-default-keperluan").val(data.data.keperluan).change();
            $("#id_surat").val(data.data.id).change();
            $("#id_jenissurat").val(data.data.id_jenissurat).change();
            $("#btn-add").click();
          }
        });

    });
</script>

@endsection
