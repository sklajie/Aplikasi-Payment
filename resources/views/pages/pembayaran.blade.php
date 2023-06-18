@extends('layouts.app')

@section('css')
<style type="text/css">
  #row-tampilan div label{
    display: block;
  }
</style>

<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet">
@stop

@section('content')
<div class="main-panel">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title" style="padding-top: 10px;">Data Pembayaran</h4>
            
        </div>
        <div>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="/">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a>Manajemen Data</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="/admin/datapenyakit">Data Pembayaran</a>
                </li>
            </ul>
            </div>

  </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          {{-- <button class="btn btn-primary" style="margin-bottom: 1rem;" data-toggle="modal" data-target="#modal-create">Tambah Mahasiswa</button> --}}

          <a class="btn btn-default" style="margin-bottom: 1rem;" href="{{ url('') }}/cek_store">Perbarui Data Siakad</a>
          <button type="button" class="btn btn-primary" style="margin-bottom: 1rem;" data-toggle="modal" data-target="#modal-create-tagihan" id="button-update-va" disabled>Buat Tagihan</button>
          <button class="btn btn-warning" style="margin-bottom: 1rem;" data-toggle="modal" data-target="#modal-import" disabled>Import Data Excel</button>
          <a download class="btn btn-success" style="margin-bottom: 1rem;" href="{{ url('') }}/pembayaran/export">Export Data Excel</a>
          {{-- <button type="button" id="button-nonaktif-all" disabled onclick="nonAktifkanTerpilih()" class="btn btn-danger" style="margin-bottom: 1rem;">Non Aktifkan</button>
          <button type="button" id="button-aktif-all" disabled onclick="aktifkanTerpilih()" class="btn btn-danger" style="margin-bottom: 1rem;">Aktifkan</button> --}}
          <button disabled type="button" class="btn btn-success" style="margin-bottom: 1rem;" id="button-export-terpilih" onclick="exportDataTerpilih()">Export Data Terpilih</button>
          <button disabled type="button" class="btn btn-info" style="margin-bottom: 1rem;" data-toggle="modal" data-target="#modal-aktivasi" onclick="aktivasi()" id="button-aktivasi">Aktivasi</button>
          <button disabled type="button" class="btn btn-primary" style="margin-bottom: 1rem;" data-toggle="modal" data-target="#modal-update-va" onclick="updateVA()" id="button-update-va">Update VA</button>
          
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Pembayaran</h3>
            </div>
           <div class="card-body">
              <div class="row" id="row-tampilan">
                <div class="col-md-12">
                  <h4>Pilih Tampilan</h4>
                </div>
                <div class="col-md-2">
                  <label>
                    <input type="checkbox" class="tampilan" data-kolom="1"> ID
                  </label>
                  <label>
                    <input type="checkbox" class="tampilan" data-kolom="2" checked="true"> Kategori Pembayaran
                  </label>
                    <input type="checkbox" class="tampilan" data-kolom="3" checked="true"> Nama
                  </label>
                </div>
                <div class="col-md-2">
                  <label>
                    <input type="checkbox" class="tampilan" data-kolom="4" checked="true"> NIM
                  </label>
                  <label>
                    <input type="checkbox" class="tampilan" data-kolom="5"> E-mail
                  </label>
                  <label>
                    <input type="checkbox" class="tampilan" data-kolom="6"> Handphone
                  </label>
                </div>
                <div class="col-md-2">
                  <label>
                    <input type="checkbox" class="tampilan" data-kolom="7"> Alamat
                  </label>
                  <label>
                    <input type="checkbox" class="tampilan" data-kolom="8" checked="true"> Semester
                  </label>
                  <label>
                    <input type="checkbox" class="tampilan" data-kolom="9" checked="true"> Prodi
                  </label>
                </div>
                <div class="col-md-2">
                  <label>
                    <input type="checkbox" class="tampilan" data-kolom="10"> VA
                  </label>
                  <label>
                    <input type="checkbox" class="tampilan" data-kolom="11" checked="true"> Tahun Akademik
                  </label>
                  <label>
                    <input type="checkbox" class="tampilan" data-kolom="12" checked="true"> Amount
                  </label>
                </div>
                <div class="col-md-2">
                  <label>
                    <input type="checkbox" class="tampilan" data-kolom="13"> Active date
                  </label>
                  <label>
                    <input type="checkbox" class="tampilan" data-kolom="14"> Inactive date
                  </label>
                  <label>
                    <input type="checkbox" class="tampilan" data-kolom="15" checked="true">Tanggal bayar
                  </label>
                  <label>
                    <input type="checkbox" class="tampilan" data-kolom="16" checked="true"> Status
                  </label>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-12">
                  <h4>Filter Data</h4>
                </div>
                <div class="col-md-3">
                  <label>Tahun Akademik</label>
                  <select id="filter-tahun-akademik" class="form-control filter">
                    <option value="">Semua</option>
                    @foreach($datatahunakademik as $tahunakademik)
                    <option value="{{ $tahunakademik }}">{{ $tahunakademik }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-3">
                  <label>Prodi</label>
                  <select id="filter-prodi" class="form-control filter">
                    <option value="">Semua</option>
                    @foreach($dataprodi as $prodi)
                    <option value="{{ $prodi }}">{{ $prodi }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-3">
                  <label>Semester</label>
                  <select id="filter-semester" class="form-control filter">
                    <option value="">Semua</option>
                    @foreach($datasemester as $semester)
                    <option value="{{ $semester }}">Semester {{ $semester }}</option>
                    @endforeach
                  </select>
                </div>
                {{-- <div class="col-md-3">
                  <label>Semester</label>
                  <select id="filter-semester" class="form-control filter">
                    <option value="">semua</option>
                    <option value="1">Semester 1</option>
                    <option value="2">Semester 2</option>
                    <option value="3">Semester 3</option>
                    <option value="4">Semester 4</option>
                    <option value="5">Semester 5</option>
                    <option value="6">Semester 6</option>
                    <option value="7">Semester 7</option>
                    <option value="8">Semester 8</option>
                  </select>
                </div> --}}
                <div class="col-md-3">
                  <label>Status</label>
                  <select id="filter-status" class="form-control filter">
                    <option value="">semua</option>
                    <option value="va_nonaktif">VA Nonaktif</option>
                    <option value="menunggu_pembayaran">Menunggu Pembayaran</option>
                  </select>
                </div>
              </div>
              <div class="divider"></div>
              <div class="table-responsive">
                <table id="table" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th  style="width: 2%">
                      <input type="checkbox" id="head-cb" >
                    </th>
                    <th>ID</th>
                    <th>Kategori Pembayaran</th>
                    <th>Nama</th>
                    <th>Nim</th>
                    <th>E-mail</th>
                    <th>Handphone</th>
                    <th>Alamat</th>
                    <th>Semester</th>
                    <th>Prodi</th>
                    <th>VA</th>
                    <th>Tahun Akademik</th>
                    <th>Amount</th>
                    <th>Active Date</th>
                    <th>Inactive Date</th>
                    <th>Tanggal Bayar</th>
                    <th>Status</th>
                    <th>###</th>
                  </tr>
                  </thead>
                  <tbody></tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  <div class="modal fade" id="modal-aktivasi">
    <div class="modal-dialog modal-lg">
      <form method="post" id="form-aktivasi" action="{{ url('') }}/pembayaran/aktivasi_va" enctype="multipart/form-data" class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Aktivasi VA</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {{csrf_field()}}
          <div class="row">
            <div class="col-md-12">
              <input type="text" name="ids" hidden>
              <p>Jumlah data terpilih: <span id="selected-count">0</span></p>
            </div>
            <div class="col-md-12">
              <label>Active date <small class="text-danger">*</small></label>
              <input type="date" name="activeDate" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label>Inactive date <small class="text-danger">*</small></label>
              <input type="date" name="inactiveDate" class="form-control" required>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button type="button" class="btn btn-primary" onclick="showConfirmDialogAktivasi()">Aktivasi</button>
        </div>
      </form>
    </div>
  </div>

  <div class="modal fade" id="modal-update-va">
    <div class="modal-dialog modal-lg">
      <form method="post" id="form-update-invoice" action="{{ url('') }}/pembayaran/update_invoice" enctype="multipart/form-data" class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Update Invoice</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {{csrf_field()}}
          <div class="row">
            <div class="col-md-12">
              <input type="text" name="ids" hidden>
              <p>Jumlah data terpilih: <span id="selected">0</span></p>
            </div>
            <div class="col-md-12">
              <label>Active date <small class="text-danger">*</small></label>
              <input type="date" name="activeDate" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label>Inactive date <small class="text-danger">*</small></label>
              <input type="date" name="inactiveDate" class="form-control" required>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button type="button" class="btn btn-primary" onclick="showConfirmDialogUpdate()">Update</button>
        </div>
      </form>
    </div>
  </div>

  <div class="modal fade" id="modal-update-data-siakad">
    <div class="modal-dialog modal-lg">
      <form method="post" id="form-update-data-siakad" action="{{ url('') }}/pembayaran/update_invoice" enctype="multipart/form-data" class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Perbarui Data Siakad</h4>
          <p>Pilih prodi yang datanya akan diupdate</p>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {{csrf_field()}}
          <div class="row">
            <div class="col-md-12">
              <label>Pilih Prodi <small class="text-danger">*</small></label>
              <select name="prodi" id="prodi" class="form-control">
                <option value="">D3 Teknik Informatika</option>
                <option value="">D3 Teknik Mesin</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button type="button" class="btn btn-primary" onclick="showConfirmDialogUpdate()">Update</button>
        </div>
      </form>
    </div>
  </div>


  <div class="modal fade" id="modal-create-tagihan">
    <div class="modal-dialog modal-lg">
      <form method="post" id="form-create-tagihan" action="{{ url('') }}/pembayaran/store" enctype="multipart/form-data" class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambahkan Data Pembayaran</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {{csrf_field()}}
          <div class="row">
            {{-- <div class="col-md-12">
              <input type="text" name="ids" hidden>
              <p>Jumlah data terpilih: <span id="selected">0</span></p>
            </div> --}}
            <div class="col-md-12">
              <label>Nama <small class="text-danger">*</small></label>
              <input type="text" name="nama" class="form-control" required><br>
            </div>
            <div class="col-md-12">
              <label>Nim <small class="text-danger">*</small></label>
              <input type="text" name="nim" class="form-control"><br>
            </div>
            <div class="col-md-12">
              <label>Email <small class="text-danger">*</small></label>
              <input type="email" name="email" class="form-control" required><br>
            </div>
            <div class="col-md-12">
              <label>Phone <small class="text-danger">*</small></label>
              <input type="text" name="phone" class="form-control"><br>
            </div>
            <div class="col-md-12">
              <label>Prodi <small class="text-danger">*</small></label>
              <input type="text" name="prodi" class="form-control"><br>
            </div>
            <div class="col-md-12">
              <label>Tahun Akademik <small class="text-danger">*</small></label>
              <input type="text" name="tahun_akademik" class="form-control"><br>
            </div>
            <div class="col-md-12">
              <label>Semester<small class="text-danger">*</small></label>
              <input type="text" name="semester" class="form-control"><br>
            </div>
            <div class="col-md-12">
              <label>Amount<small class="text-danger">*</small></label>
              <input type="text" name="amount" class="form-control"><br>
            </div>
            <div class="col-md-12">
              <label>Kategori Pembayaran <small class="text-danger">*</small></label>
              {{-- <select name="kategori_pembayaran" id="">
                @foreach ($data_kategori as $item)
                    <option value="{{ $item->kategori_pembayaran }}">{{ $item->kategori_pembayaran }}</option>
                @endforeach
              </select> --}}
              <input type="" name="kategori_pembayaran" class="form-control" required><br>
            </div>
            <div class="col-md-12">
              <label>VA <small class="text-danger">*</small></label>
              <input type="number" name="va" id="va" class="form-control" required><br>
            </div>
            <div class="col-md-12">
              <label>Alamat <small class="text-danger">*</small></label>
              <input type="text" name="address" class="form-control"><br>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <input type="submit" class="btn btn-primary" value="Tambahkan">
          {{-- <button type="submit" class="btn btn-primary">Tambahkan</button> --}}
        </div>
      </form>
    </div>
  </div>

  <div class="modal fade" id="modal-import">
    <div class="modal-dialog modal-lg">
      <form method="post" id="form-import" action="{{url('')}}/pembayaran/import-excel" enctype="multipart/form-data" class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Import Data Mahasiswa</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {{method_field('PUT')}}
          {{csrf_field()}}
          <div class="row">
            <div class="col-md-12">
              <p>Import data Mahasiswa sesuai format contoh berikut dan beri nama "Tagihan.xlsx" pada file yang diupload. <br/><a href="{{url('')}}/assets/Contoh_Format_Tagihan.xlsx"><i class="fas fa-download"></i> File Contoh Excel Mahasiswa</a></p>
            </div>
            <div class="col-md-12">
              <label>File Excel Mahasiswa</label>
              <input type="file" name="Tagihan" required>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>



  <form action="{{url('')}}/pembayaran/export_data_terpilih" method="post" id="form-export-terpilih" class="hidden">
    <input type="hidden" name="ids">
    <button class="hidden" style="display: none;" type="submit">S</button>
  </form> 

    </div>
</div> 
@stop

@section('js')
<script type="text/javascript">
  let list_pembayaran = [];
  let status = $("#filter-status").val()
  ,semester = $("#filter-semester").val()
  ,prodi = $("#filter-prodi").val()
  ,tahun_akademik = $("#filter-tahun-akademik").val()
  
  const table = $('#table').DataTable({
    "pageLength": 25,
    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'semua']],
    "bLengthChange": true,
    "bFilter": true,
    "bInfo": true,
    "processing":true,
    "bServerSide": true,
    "order": [[ 1, "asc" ]],
    "autoWidth": false,
    "ajax":{
      url: "{{url('')}}/pembayaran/data",
      type: "POST",
      data:function(d){
        d.status = status;
        d.semester = semester;
        d.prodi = prodi;
        d.tahun_akademik = tahun_akademik;
        return d
      }
    },
    "initComplete": function(settings, json) {
      const all_checkbox_view = $("#row-tampilan div input[type='checkbox']")
      $.each(all_checkbox_view,function(key,checkbox){
        let kolom = $(checkbox).data('kolom')
        let is_checked = checkbox.checked
        table.column(kolom).visible(is_checked)
      })
      setTimeout(function(){
        table.columns.adjust().draw();
      },2000)
    },
    columnDefs: [
      {targets:'_all', visible:true},
      {
        "targets": 0,
        "class":"text-nowrap",
        "sortable":false,
        "render": function(data, type, row, meta){
          return `<input type="checkbox" class="cb-child" value="${row.id}">`;
        }
      },
      {
        "targets": 1,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          list_pembayaran[row.id] = row;
          return row.id;
        }
      },
      {
        "targets": 2,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          return row.kategori_pembayaran;
        }
      },
      {
        "targets": 3,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          return row.nama;
        }
      },
      {
        "targets": 4,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          return row.nim;
        }
      },
      {
        "targets": 5,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          return row.email;
        }
      },
      {
        "targets": 6,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          return row.phone;
        }
      },
      {
        "targets": 7,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          return row.address;
        }
      },
      {
        "targets": 8,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          return row.semester;
        }
      },
      {
        "targets": 9,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          return row.prodi;
        }
      },
      {
        "targets": 10,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          return row.va;
        }
      },
      {
        "targets": 11,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          return row.tahun_akademik;
        }
      },
      {
        "targets": 12,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          return row.amount;
        }
      },
      {
        "targets": 13,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          return row.date;
        }
      },
      {
        "targets": 14,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          return row.activeDate;
        }
      },
      {
        "targets": 15,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          return row.inactiveDate;
        }
      },
      {
        "targets": 16,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          if (row.status == 'dibayar') {
                  return '<span style="color: blue;">Dibayar</span>';
              } else if (row.status == 'menunggu_pembayaran') {
                  return  '<span style="color: orange;">Menunggu Pembayaran</span>';
              } else {
                return  '<span style="color: red;">VA nonaktif</span>';
              }
        }
      },
      // {
      //   "targets": 15,
      //   "class":"text-nowrap",
      //   "render": function(data, type, row, meta){
      //     return row.Status;
      //   }
      // },
      {
        "targets": 17,
        "sortable":false,
        "render": function(data, type, row, meta){
          let tampilan = `
            <a target="_blank" href="{{url('')}}/pembayaran/invoice/${row.id}" class="btn btn-sm btn-danger btn-block"><i class="fa fa-print" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Cetak Invoice</a>
            `;
          // if(row.status=='aktif'){
          //   tampilan+=`<button onclick="toggleStatus('${row.id}')" class="btn btn-sm btn-danger btn-block">Nonaktifkan</button>`
          // }else{
          //   tampilan+=`<button onclick="toggleStatus('${row.id}')" class="btn btn-sm btn-success btn-block">Aktifkan</button>`
          // }
          return tampilan;
        }
      }
      
    ]
  });

  $("#row-tampilan input[type='checkbox']").on('change',function(){
    let checkbox = $(this)
    let kolom = $(this).data('kolom')
    let is_checked = checkbox[0].checked
    table.column(kolom).visible(is_checked)
  })

  $('#table tbody').on('change', 'input[type="checkbox"]', function() {
        var selectedCount = table.column(0).nodes().to$().find(':checkbox:checked').length;
        $('#selected-count').text(selectedCount);
    });

  $('#table thead').on('change', 'input[type="checkbox"]', function() {
        var selectedCount = table.column(0).nodes().to$().find(':checkbox:checked').length;
        $('#selected-count').text(selectedCount);
  });

  $('#table tbody').on('change', 'input[type="checkbox"]', function() {
        var selected = table.column(0).nodes().to$().find(':checkbox:checked').length;
        $('#selected').text(selected);
    });

  $('#table thead').on('change', 'input[type="checkbox"]', function() {
        var selected = table.column(0).nodes().to$().find(':checkbox:checked').length;
        $('#selected').text(selected);
  });

  function filterTampilan(){
    let all_columns = $("#view-tampilan div label input")
    
  }

  // function showDetailKaryawan(id) {
  //   const karyawan = list_pembayaran[id]
  //   $("#modal-edit").modal('show')
  //   // SET SEMUA KE DEFAULT
  //   $("#form-edit input:not([name='_token']):not([name='_method'])").val('')
  //   $("#form-edit textarea").val('')
  //   $("#form-edit select:not([name='status'])").val('')


  //   $("#form-edit [name='id']").val(id)
  //   $("#form-edit [name='nama']").val(karyawan.nama)
  //   $("#form-edit [name='nomor_ktp']").val(karyawan.nomor_ktp)
  //   $("#form-edit [name='nik']").val(karyawan.nik)
  //   $("#form-edit [name='telp']").val(karyawan.telp)
  //   $("#form-edit [name='email']").val(karyawan.email)
  //   $("#form-edit [name='detail_alamat']").val(karyawan.detail_alamat)
  //   $("#form-edit [name='status']").val(karyawan.status)
  //   $("#form-edit [name='nomor_bpjs_kesehatan']").val(karyawan.nomor_bpjs_kesehatan)
  //   $("#form-edit [name='nomor_bpjs_ketenagakerjaan']").val(karyawan.nomor_bpjs_ketenagakerjaan)
  //   $("#form-edit [name='organisasi_id']").val(karyawan.organisasi_id)
  // }

  // $("#form-edit").on('submit',function(e){
  //   e.preventDefault()
  //   $("#form-edit").ajaxSubmit({
  //     success:function(res){
  //       if(res===true){
  //         alert("BERHASIL UPDATE KARYAWAN")
  //         table.ajax.reload(null,false)
  //         $("#modal-edit").modal('hide')
  //       }
  //     }
  //   })
  // })

  // function toggleStatus(id) {
  //   const _c = confirm("Anda yakin akan melakukan operasi ini ?")
  //   if(_c===true){
  //     let karyawan = list_pembayaran[id]
  //     let status_update = ''
  //     if(karyawan.status=='aktif'){
  //       status_update = 'non aktif'
  //     }else{
  //       status_update = 'aktif'
  //     }
  //     $.ajax({
  //       url:'{{url('')}}/karyawan/update_status',
  //       method:'POST',
  //       data:{id:id,status:status_update,_token:'{{csrf_token()}}'},
  //       success:function(res){
  //         if(res===true){
  //           table.ajax.reload(null,false)
  //         }
  //       }
  //     })
  //   }
  // }

  $("#head-cb").on('click',function(){
    var isChecked = $("#head-cb").prop('checked')
    $(".cb-child").prop('checked',isChecked)
    $("#button-nonaktif-all,#button-export-terpilih,#button-aktivasi,#button-update-va").prop('disabled',!isChecked)
    $("#button-aktif-all,#button-export-terpilih,#button-aktivasi,#button-update-va").prop('disabled',!isChecked)
  })

  $("#table tbody").on('click','.cb-child',function(){
    if($(this).prop('checked')!=true){
      $("#head-cb").prop('checked',false)
    }

    let semua_checkbox = $("#table tbody .cb-child:checked")
    let button_non_aktif_status = (semua_checkbox.length>0)
    let button_export_terpilih_status = button_non_aktif_status;
    let button_aktivasi_status = button_non_aktif_status;
    let button_update_va_status = button_non_aktif_status;

    $("#button-nonaktif-all,#button-export-terpilih,#button-aktivasi,#button-update-va").prop('disabled',!button_non_aktif_status)
    $("#button-aktif-all,#button-export-terpilih,#button-aktivasi,#button-update-va").prop('disabled',!button_non_aktif_status)
  })

  // function nonAktifkanTerpilih () {
  //   let checkbox_terpilih = $("#table tbody .cb-child:checked")
  //   let semua_id = []
  //   $.each(checkbox_terpilih,function(index,elm){
  //     semua_id.push(elm.value)
  //   })
  //   $("#button-nonaktif-all").prop('disabled',true)
  //   $.ajax({
  //     url:"{{url('')}}/karyawan/non-aktifkan",
  //     method:'post',
  //     data:{ids:semua_id},
  //     success:function(res){
  //       table.ajax.reload(null,false)
  //       $("#button-nonaktif-all").prop('disabled',false)
  //       $("#head-cb").prop('checked',false)
  //     }
  //   })
  // }

  // function aktifkanTerpilih () {
  //   let checkbox_terpilih = $("#table tbody .cb-child:checked")
  //   let semua_id = []
  //   $.each(checkbox_terpilih,function(index,elm){
  //     semua_id.push(elm.value)
  //   })
  //   $("#button-nonaktif-all").prop('disabled',true)
  //   $.ajax({
  //     url:"{{url('')}}//pembayaran/aktivasi",
  //     method:'post',
  //     data:{ids:semua_id},
  //     success:function(res){
  //       table.ajax.reload(null,false)
  //       $("#button-aktif-all").prop('disabled',false)
  //       $("#head-cb").prop('checked',false)
  //     }
  //   })
  //   // console.log(semua_id)
  //   // console.log("YANG TERPILIH AKAN DINONAKTIFKAN")
  // }

  // $(document).ready(function() {
  //   var table = $('#data-table').DataTable({
  //       processing: true,
  //       serverSide: true,
  //       ajax: {
  //           url: '{{ url('') }}/pembayaran/aktivasi',
  //           type: 'POST'
  //       },
  //       columns: [
  //           { data: 'checkbox', name: 'checkbox', orderable: false, searchable: false },
  //           { data: 'id', name: 'id' },
  //           { data: 'name', name: 'name' },
  //           { data: 'email', name: 'email' }
  //       ]
  //   });
    
  //   $('#select-all').on('click', function() {
  //       $('input[type="checkbox"]').prop('checked', $(this).prop('checked'));
  //   });
  // });

  $(".filter").on('change',function(){
    status = $("#filter-status").val()
    semester = $("#filter-semester").val()
    prodi = $("#filter-prodi").val()
    tahun_akademik = $("#filter-tahun-akademik").val()
    table.ajax.reload(null,false)
  })

  function aktivasi() {
    let checkbox_terpilih = $("#table tbody .cb-child:checked")
    let semua_id = []
    $.each(checkbox_terpilih,function(index,elm){
      semua_id.push(elm.value)
    })
    let ids = semua_id.join(',')
    $("#form-aktivasi [name='ids']").val(ids)
    
    // $.ajax({
    //   url:"{{url('')}}/karyawan/export_terpilih",
    //   method:'POST',
    //   data:{ids:semua_id},
    //   success:function(res){
    //     console.log(res)
    //     $("#button-export-terpilih").prop('disabled',false)
    //   }
    // })
  }

  function updateVA() {
    let checkbox_terpilih = $("#table tbody .cb-child:checked")
    let semua_id = []
    $.each(checkbox_terpilih,function(index,elm){
      semua_id.push(elm.value)
    })
    let ids = semua_id.join(',')
    $("#form-update-invoice [name='ids']").val(ids)
    
    // $.ajax({
    //   url:"{{url('')}}/karyawan/export_terpilih",
    //   method:'POST',
    //   data:{ids:semua_id},
    //   success:function(res){
    //     console.log(res)
    //     $("#button-export-terpilih").prop('disabled',false)
    //   }
    // })
  }

  function exportDataTerpilih() {
    let checkbox_terpilih = $("#table tbody .cb-child:checked")
    let semua_id = []
    $.each(checkbox_terpilih,function(index,elm){
      semua_id.push(elm.value)
    })
    let ids = semua_id.join(',')
    $("#button-export-terpilih").prop('disabled',true)
    $("#form-export-terpilih [name='ids']").val(ids)
    $("#form-export-terpilih").submit()
    // $.ajax({
    //   url:"{{url('')}}/karyawan/export_terpilih",
    //   method:'POST',
    //   data:{ids:semua_id},
    //   success:function(res){
    //     console.log(res)
    //     $("#button-export-terpilih").prop('disabled',false)
    //   }
    // })
  }

  function showConfirmDialogAktivasi() {

    Swal.fire({
      title: 'Confirm',
      text: "Apakah anda yakin ingin mengaktivasi VA",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'aktivasi'
    }).then((result) => {
      if (result.isConfirmed) {
        $("#form-aktivasi").submit()
      }
    });
  }

  function showConfirmDialogUpdate() {

  Swal.fire({
    title: 'Confirm',
    text: "Apakah anda yakin ingin update VA",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Update'
  }).then((result) => {
    if (result.isConfirmed) {
      $("#form-update-invoice").submit()
    }
  });
  }

  function showConfirmDialogUpdateDataSiakad() {

Swal.fire({
  title: 'Confirm',
  text: "Apakah anda yakin ingin perbarui data",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Update'
}).then((result) => {
  if (result.isConfirmed) {
    $("#form-update-data-siakad").submit()
  }
});
}


</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
@stop
