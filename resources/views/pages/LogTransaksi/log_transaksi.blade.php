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
            <h4 class="page-title" style="padding-top: 10px;">Log Transaksi</h4>
            
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
                    <a href="">Log Transaksi</a>
                </li>
            </ul>
            </div>

  </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Log Transaksi</h3>
            </div>
           <div class="card-body">
              <div class="row">
                <div class="col-md-10">
                </div>
                <div class="col-md-2">
                  <label>Filter - Status</label>
                  <select id="filter-open-payment" class="form-control filter">
                    <option value="">semua</option>
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
                    <th>ID</th>
                    <th>Nama</th>
                    <th>E-mail</th>
                    <th>VA</th>
                    <th>Amount</th>
                    <th>Tanggal bayar</th>
                    <th>Status bayar</th>
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
              <p>Import data Mahasiswa sesuai format contoh berikut.<br/><a href="{{url('')}}/assets/Contoh_Format_Tagihan.xlsx"><i class="fas fa-download"></i> File Contoh Excel Mahasiswa</a></p>
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
      url: "{{url('')}}/log_transaksi/data",
      type: "POST",
    },
    columnDefs: [
      {targets:'_all', visible:true},
      {
        "targets": 0,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          list_pembayaran[row.id] = row;
          return row.id;
        }
      },
      {
        "targets": 1,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          return row.name;
        }
      },
      {
        "targets": 2,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          return row.email;
        }
      },
      {
        "targets": 3,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          return row.amount;
        }
      },
      {
        "targets": 4,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          return row.regis_number;
        }
      },
      {
        "targets": 5,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          return row.paid_date;
        }
      },
      {
        "targets": 6,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          if (row.paid === 1) {
                  return '<span style="color: blue;">Dibayar</span>';
              } else {
                  return  '<span style="color: red;">Belum Dibayar</span>';
              }
        }
      },
      {
        "targets": 7,
        "sortable":false,
        "render": function(data, type, row, meta){
          let tampilan = `
            <a href="{{url('')}}/log_transaksi/detail/${row.id}" class="btn btn-sm btn-warning btn-block"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Detail</a>
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

//   $("#row-tampilan input[type='checkbox']").on('change',function(){
//     let checkbox = $(this)
//     let kolom = $(this).data('kolom')
//     let is_checked = checkbox[0].checked
//     table.column(kolom).visible(is_checked)
//   })

//   $('#table tbody').on('change', 'input[type="checkbox"]', function() {
//         var selectedCount = table.column(0).nodes().to$().find(':checkbox:checked').length;
//         $('#selected-count').text(selectedCount);
//     });

//   $('#table thead').on('change', 'input[type="checkbox"]', function() {
//         var selectedCount = table.column(0).nodes().to$().find(':checkbox:checked').length;
//         $('#selected-count').text(selectedCount);
//   });

//   function filterTampilan(){
//     let all_columns = $("#view-tampilan div label input")
    
//   }

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

//   $("#head-cb").on('click',function(){
//     var isChecked = $("#head-cb").prop('checked')
//     $(".cb-child").prop('checked',isChecked)
//     $("#button-nonaktif-all,#button-export-terpilih,#button-aktivasi").prop('disabled',!isChecked)
//     $("#button-aktif-all,#button-export-terpilih,#button-aktivasi").prop('disabled',!isChecked)
//   })

//   $("#table tbody").on('click','.cb-child',function(){
//     if($(this).prop('checked')!=true){
//       $("#head-cb").prop('checked',false)
//     }

//     let semua_checkbox = $("#table tbody .cb-child:checked")
//     let button_non_aktif_status = (semua_checkbox.length>0)
//     let button_export_terpilih_status = button_non_aktif_status;
//     let button_aktivasi_status = button_non_aktif_status;

//     $("#button-nonaktif-all,#button-export-terpilih,#button-aktivasi").prop('disabled',!button_non_aktif_status)
//     $("#button-aktif-all,#button-export-terpilih,#button-aktivasi").prop('disabled',!button_non_aktif_status)
//   })

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

//   $(".filter").on('change',function(){
//     openPayment = $("#filter-open-payment").val()
//     semester = $("#filter-semester").val()
//     prodi = $("#filter-prodi").val()
//     tahun_akademik = $("#filter-tahun-akademik").val()
//     table.ajax.reload(null,false)
//   })

//   function aktivasi() {
//     let checkbox_terpilih = $("#table tbody .cb-child:checked")
//     let semua_id = []
//     $.each(checkbox_terpilih,function(index,elm){
//       semua_id.push(elm.value)
//     })
//     let ids = semua_id.join(',')
//     $("#form-aktivasi [name='ids']").val(ids)
    
    // $.ajax({
    //   url:"{{url('')}}/karyawan/export_terpilih",
    //   method:'POST',
    //   data:{ids:semua_id},
    //   success:function(res){
    //     console.log(res)
    //     $("#button-export-terpilih").prop('disabled',false)
    //   }
    // })
//   }

//   function exportDataTerpilih() {
//     let checkbox_terpilih = $("#table tbody .cb-child:checked")
//     let semua_id = []
//     $.each(checkbox_terpilih,function(index,elm){
//       semua_id.push(elm.value)
//     })
//     let ids = semua_id.join(',')
//     $("#button-export-terpilih").prop('disabled',true)
//     $("#form-export-terpilih [name='ids']").val(ids)
//     $("#form-export-terpilih").submit()
    // $.ajax({
    //   url:"{{url('')}}/karyawan/export_terpilih",
    //   method:'POST',
    //   data:{ids:semua_id},
    //   success:function(res){
    //     console.log(res)
    //     $("#button-export-terpilih").prop('disabled',false)
    //   }
    // })
//   }

//   function showConfirmDialogAktivasi() {

//     Swal.fire({
//       title: 'Confirm',
//       text: "Apakah anda yakin ingin mengaktivasi VA",
//       icon: 'warning',
//       showCancelButton: true,
//       confirmButtonColor: '#3085d6',
//       cancelButtonColor: '#d33',
//       confirmButtonText: 'aktivasi'
//     }).then((result) => {
//       if (result.isConfirmed) {
//         $("#form-aktivasi").submit()
//       }
//     });
//   }

</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
@stop
