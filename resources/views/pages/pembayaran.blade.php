@extends('layouts.app')

@section('css')
<style type="text/css">
  #row-tampilan div label{
    display: block;
  }
</style>
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
	{{-- <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Karyawan</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Karyawan</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid --> --}}
  </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <button class="btn btn-primary" style="margin-bottom: 1rem;" data-toggle="modal" data-target="#modal-create">Tambah Mahasiswa</button>
          <button class="btn btn-warning" style="margin-bottom: 1rem;" data-toggle="modal" data-target="#modal-import">Import Data Mahasiswa Excel</button>
          <a download class="btn btn-success" style="margin-bottom: 1rem;" href="{{url('')}}/karyawan/export">Export Data Pembayaran Excel</a>
          {{-- <button type="button" id="button-nonaktif-all" disabled onclick="nonAktifkanTerpilih()" class="btn btn-danger" style="margin-bottom: 1rem;">Non Aktifkan</button>
          <button type="button" id="button-aktif-all" disabled onclick="aktifkanTerpilih()" class="btn btn-danger" style="margin-bottom: 1rem;">Aktifkan</button> --}}
          <button disabled type="button" class="btn btn-success" style="margin-bottom: 1rem;" id="button-export-terpilih" onclick="exportKaryawanTerpilih()">Export Karyawan Terpilih</button>
          
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Pembayaran</h3>
            </div>
           <div class="card-body">
              <div class="row" id="row-tampilan">
                <div class="col-md-12">
                  <h4>Pilih Tampilan</h4>
                </div>
                <div class="col-md-3">
                  <label>
                    <input type="checkbox" class="tampilan" data-kolom="1"> ID
                  </label>
                  <label>
                    <input type="checkbox" class="tampilan" data-kolom="2"> Kategori Pembayaran
                  </label>
                  <label>
                    <input type="checkbox" class="tampilan" data-kolom="3" checked="true"> Nama
                  </label>
                </div>
                <div class="col-md-3">
                  <label>
                    <input type="checkbox" class="tampilan" data-kolom="4" checked="true"> Email
                  </label>
                  <label>
                    <input type="checkbox" class="tampilan" data-kolom="5"> HandPhone
                  </label>
                  <label>
                    <input type="checkbox" class="tampilan" data-kolom="6"> Alamat
                  </label>
                </div>
                <div class="col-md-3">
                  <label>
                    <input type="checkbox" class="tampilan" data-kolom="7" checked="true"> Semester
                  </label>
                  <label>
                    <input type="checkbox" class="tampilan" data-kolom="8" checked="true"> Prodi
                  </label>
                  <label>
                    <input type="checkbox" class="tampilan" data-kolom="9"> VA
                  </label>
                </div>
                <div class="col-md-3">
                  <label>
                    <input type="checkbox" class="tampilan" data-kolom="10" checked="true"> Tahun Akademik
                  </label>
                  <label>
                    <input type="checkbox" class="tampilan" data-kolom="11" checked="true"> Tanggal Bayar
                  </label>
                  <label>
                    <input type="checkbox" class="tampilan" data-kolom="12" checked="true"> Status
                  </label>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-12">
                  <h4>Filter Data</h4>
                </div>
                <div class="col-md-4">
                  <label>Semester</label>
                  <select id="filter-organisasi" class="form-control filter">
                    <option value="">pilih semester</option>
                    <option value="">Genap</option>
                    <option value=""></option>
                    {{-- @foreach($list_organisasi as $organisasi)
                    <option value=""></option>
                    @endforeach --}}
                  </select>
                </div>
                <div class="col-md-4">
                  <label>Prodi</label>
                  <select id="filter-bpjs-kesehatan" class="form-control filter">
                    <option value="">Pilih prodi</option>
                    <option value="1">Teknik Mesin</option>
                    <option value="2">Teknik Informatika</option>
                    <option value="3">Teknik Pendingin dan Tata udara</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <label>Status</label>
                  <select id="filter-bpjs-ketenagakerjaan" class="form-control filter">
                    <option value="">Status</option>
                    <option value="1">Lunas</option>
                    <option value="0">Belum lunas</option>
                  </select>
                </div>
              </div>
              <div class="divider"></div>
              <div class="table-responsive">
                <table id="table" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th  style="width: 2%">
                      <input type="checkbox" id="head-cb">
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
                    <th>Tanggal Bayar</th>
                    <th>Status VA</th>
                    <th>Status Pembayaran</th>
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

 <div class="modal fade" id="modal-create">
    <div class="modal-dialog modal-lg">
      <form method="post" id="form-create" action="{{url('karyawan')}}" enctype="multipart/form-data" class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Data Karyawan Baru</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {{csrf_field()}}
          <div class="row">
            <div class="col-md-12">
              <label>Nama <small class="text-danger">*</small></label>
              <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label>Nomor KTP <small class="text-danger">*</small></label>
              <input type="text" name="nomor_ktp" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label>NIK <small class="text-danger">*</small></label>
              <input type="text" name="nik" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label>Telp <small class="text-danger">*</small></label>
              <input type="text" name="telp" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label>Email</label>
              <input type="email" name="email" class="form-control">
            </div>
            <div class="col-md-12">
              <label>Detail Alamat</label>
              <textarea class="form-control" name="detail_alamat"></textarea>
            </div>
            <div class="col-md-12">
              <label>Status</label>
              <select name="status" class="form-control" required>
                <option value="aktif">Aktif</option>
                <option value="non aktif">Non Aktif</option>
              </select>
            </div>
            <div class="col-md-12">
              <label>Nomor BPJS Kesehatan</label>
              <input type="text" name="nomor_bpjs_kesehatan" class="form-control">
            </div>
            <div class="col-md-12">
              <label>Nomor BPJS Ketenagakerjaan</label>
              <input type="text" name="nomor_bpjs_ketenagakerjaan" class="form-control">
            </div>
            <div class="col-md-12">
              <label>Organisasi</label>
              <select name="organisasi_id" class="form-control" required>
                <option value="">Pilih Organisasi</option>
                {{-- @foreach($list_organisasi as $organisasi)
                <option value="{{$organisasi->id}}">{{$organisasi->nama}}</option>
                @endforeach --}}
              </select>
            </div>
            <div class="col-md-12" style="margin-top: 4px;">
              <input type="file" name="foto" accept="image/*">
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
 {{-- 
  <div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-lg">
      <form method="post" id="form-edit" action="{{url('karyawan')}}" enctype="multipart/form-data" class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Data Karyawan Baru</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {{csrf_field()}}
          <input type="hidden" name="id">
          {{method_field('PATCH')}}
          <div class="row">
            <div class="col-md-12">
              <label>Nama <small class="text-danger">*</small></label>
              <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label>Nomor KTP <small class="text-danger">*</small></label>
              <input type="text" name="nomor_ktp" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label>NIK <small class="text-danger">*</small></label>
              <input type="text" name="nik" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label>Telp <small class="text-danger">*</small></label>
              <input type="text" name="telp" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label>Email</label>
              <input type="email" name="email" class="form-control">
            </div>
            <div class="col-md-12">
              <label>Detail Alamat</label>
              <textarea class="form-control" name="detail_alamat"></textarea>
            </div>
            <div class="col-md-12">
              <label>Status</label>
              <select name="status" class="form-control" required>
                <option value="aktif">Aktif</option>
                <option value="non aktif">Non Aktif</option>
              </select>
            </div>
            <div class="col-md-12">
              <label>Nomor BPJS Kesehatan</label>
              <input type="text" name="nomor_bpjs_kesehatan" class="form-control">
            </div>
            <div class="col-md-12">
              <label>Nomor BPJS Ketenagakerjaan</label>
              <input type="text" name="nomor_bpjs_ketenagakerjaan" class="form-control">
            </div>
            <div class="col-md-12">
              <label>Organisasi</label>
              <select name="organisasi_id" class="form-control" required>
                <option value="">Pilih Organisasi</option>
                @foreach($list_organisasi as $organisasi)
                <option value="{{$organisasi->id}}">{{$organisasi->nama}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-12" style="margin-top: 4px;">
              <input type="file" name="foto" accept="image/*">
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

  <div class="modal fade" id="modal-import">
    <div class="modal-dialog modal-lg">
      <form method="post" id="form-import" action="{{url('karyawan')}}" enctype="multipart/form-data" class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Import Data Karyawan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {{method_field('PUT')}}
          {{csrf_field()}}
          <div class="row">
            <div class="col-md-12">
              <p>Import data karyawan sesuai format contoh berikut.<br/><a href="{{url('')}}/excel-karyawan.xlsx"><i class="fas fa-download"></i> File Contoh Excel Karyawan</a></p>
            </div>
            <div class="col-md-12">
              <label>File Excel Karyawan</label>
              <input type="file" name="excel-karyawan" required>
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

  <form action="{{url('')}}/karyawan/export_terpilih" method="post" id="form-export-terpilih" class="hidden">
    <input type="hidden" name="ids">
    <button class="hidden" style="display: none;" type="submit">S</button>
  </form> --}}

    </div>
</div> 
@stop

@section('js')
<script type="text/javascript">
  // let list_pembayaran = [];
  // let organisasi = $("#filter-organisasi").val()
  // ,bpjs_kesehatan = $("#filter-bpjs-kesehatan").val()
  // ,bpjs_ketenagakerjaan = $("#filter-bpjs-ketenagakerjaan").val()
  
  const table = $('#table').DataTable({
    "pageLength": 25,
    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'semua']],
    "bLengthChange": true,
    "bFilter": true,
    "bInfo": true,
    "processing":true,
    "bServerSide": true,
    "order": [[ 1, "desc" ]],
    "autoWidth": false,
    "ajax":{
      url: "{{url('')}}/pembayaran/data",
      type: "POST",
      // data:function(d){
      //   // d.organisasi = organisasi;
      //   // d.bpjs_kesehatan = bpjs_kesehatan;
      //   // d.bpjs_ketenagakerjaan = bpjs_ketenagakerjaan;
      //   return d
      // }
    },
    // "initComplete": function(settings, json) {
    //   const all_checkbox_view = $("#row-tampilan div input[type='checkbox']")
    //   $.each(all_checkbox_view,function(key,checkbox){
    //     let kolom = $(checkbox).data('kolom')
    //     let is_checked = checkbox.checked
    //     table.column(kolom).visible(is_checked)
    //   })
    //   setTimeout(function(){
    //     table.columns.adjust().draw();
    //   },3000)
    // },
    columnDefs: [
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
          return row.openPayment;
        }
      },
      {
        "targets": 15,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          return row.Status;
        }
      },
      {
        "targets": 16,
        "sortable":false,
        "render": function(data, type, row, meta){
          let tampilan = `
            <a target="_blank" href="{{url('')}}/karyawan/download_pdf/${row.id}" class="btn btn-sm btn-primary btn-block">Download Pdf</a>
            <button onclick="showDetailKaryawan('${row.id}')" class="btn btn-sm btn-warning btn-block">Edit</button>
          `;
          if(row.status=='aktif'){
            tampilan+=`<button onclick="toggleStatus('${row.id}')" class="btn btn-sm btn-danger btn-block">Nonaktifkan</button>`
          }else{
            tampilan+=`<button onclick="toggleStatus('${row.id}')" class="btn btn-sm btn-success btn-block">Aktifkan</button>`
          }
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

  function filterTampilan(){
    let all_columns = $("#view-tampilan div label input")
    
  }

  // $("#form-create").on('submit',function(e){
  //   e.preventDefault()
    

  //   $("#form-create").ajaxSubmit({
  //     success:function(res){
  //       table.ajax.reload(null,false)
  //       // SET SEMUA KE DEFAULT
  //       $("#form-create input:not([name='_token'])").val('')
  //       $("#form-create textarea").val('')
  //       $("#form-create select:not([name='status'])").val('')


  //       $("#modal-create").modal('hide')
  //     }
  //   })
  // })

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

  // $("#head-cb").on('click',function(){
  //   var isChecked = $("#head-cb").prop('checked')
  //   $(".cb-child").prop('checked',isChecked)
  //   $("#button-nonaktif-all,#button-export-terpilih").prop('disabled',!isChecked)
  //   $("#button-aktif-all,#button-export-terpilih").prop('disabled',!isChecked)
  // })

  // $("#table tbody").on('click','.cb-child',function(){
  //   if($(this).prop('checked')!=true){
  //     $("#head-cb").prop('checked',false)
  //   }

  //   let semua_checkbox = $("#table tbody .cb-child:checked")
  //   let button_non_aktif_status = (semua_checkbox.length>0)
  //   let button_export_terpilih_status = button_non_aktif_status;
  //   $("#button-nonaktif-all,#button-export-terpilih").prop('disabled',!button_non_aktif_status)
  //   $("#button-aktif-all,#button-export-terpilih").prop('disabled',!button_non_aktif_status)
  // })

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

  // $(".filter").on('change',function(){
  //   organisasi = $("#filter-organisasi").val()
  //   bpjs_kesehatan = $("#filter-bpjs-kesehatan").val()
  //   bpjs_ketenagakerjaan = $("#filter-bpjs-ketenagakerjaan").val()
  //   table.ajax.reload(null,false)
  // })

  // function exportKaryawanTerpilih() {
  //   let checkbox_terpilih = $("#table tbody .cb-child:checked")
  //   let semua_id = []
  //   $.each(checkbox_terpilih,function(index,elm){
  //     semua_id.push(elm.value)
  //   })
  //   let ids = semua_id.join(',')
  //   $("#button-export-terpilih").prop('disabled',true)
  //   $("#form-export-terpilih [name='ids']").val(ids)
  //   $("#form-export-terpilih").submit()
  //   // $.ajax({
  //   //   url:"{{url('')}}/karyawan/export_terpilih",
  //   //   method:'POST',
  //   //   data:{ids:semua_id},
  //   //   success:function(res){
  //   //     console.log(res)
  //   //     $("#button-export-terpilih").prop('disabled',false)
  //   //   }
  //   // })
  // }
</script>
@stop
