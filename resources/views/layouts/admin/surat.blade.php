
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
        ajax: "{{route('surat-data-admin')}}",
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
                print="<a class='mt-1 btn-sm a_delete btn btn-success' pdf='"+full.id+"' href='//{{request()->getHttpHost()}}/admin/l/cetak/"+full.id+"''>"+
                feather.icons['download'].toSvg({ class: 'font-small-4 text-white' }) + " Unduh</a>";
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
  
</script>

@endsection
