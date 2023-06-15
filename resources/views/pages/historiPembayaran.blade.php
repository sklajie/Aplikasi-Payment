@extends('layouts.app')

@section('title' , 'Histori Pembayaran' , 'active')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

		<div class="main-panel">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title" style="padding-top: 10px;">Histori Pembayaran</h4>
					</div>
                    <div>
						<ul class="breadcrumbs">
							<li class="nav-home">
								<a href="/home">
									<i class="flaticon-home"></i>
								</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
						
							<li class="nav-item">
								<a href="/histori_pembayaran">HIstori Pembayaran</a>
							</li>
						</ul>
                        </div>
                        <br>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="d-flex align-items-center">
										<h4 class="card-title"><b>Histori Pemnbayaran</b></h4>
										{{-- <a href="{{route('users.create')}}" class="btn btn-primary btn-round ml-auto" >
											<i class="fa fa-plus"></i>
											&NonBreakingSpace;Tambahkan
										</a> --}}
									</div>
								</div>

								<div class="card-body">
									
									<div class="table-responsive">
										<table id="add-row" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>No</th>
													<th>Nama</th>
													<th>VA</th>
													<th>Nominal Tagihan</th>
													<th>Np Tagihan</th>
													<th>tanggal Bayar</th>
												</tr>
											</thead>
											
											<tbody>	
												@foreach ($data as $item)	
												<tr>
													<td>{{$loop->iteration}}</td>
													<td>{{$item->nama_pembayar}}</td>
													<td>{{$item->va}}</td>
													<td>{{$item->amount}}</td>
													<td>{{$item->number}}</td>
													<td>{{ $item->tanggal_bayar }}
					
														{{-- <form action="{{ route('users.destroy', $item->id )}}" method="POST">
															@csrf
															@method('delete')
													
															<a href="{{ route('users.edit', $item->id )}}" class="btn btn-primary btn-xs"><i class="fa fa-print">&NonBreakingSpace; Edit</i></a>
															<!-- Button trigger modal -->
															<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#exampleModalCenter{{$item->id}}" >
																<i class="fa fa-trash">&NonBreakingSpace;</i>Hapus
															</button>

															<!-- Modal -->
															<div class="modal fade" id="exampleModalCenter{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
																<div class="modal-dialog modal-dialog-centered" role="document">
																<div class="modal-content">
																	<div class="modal-header">
																	<h5 class="modal-title" id="exampleModalLongTitle">Konfirmasi Hapus Pengguna</h5>
																	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																		<span aria-hidden="true">&times;</span>
																	</button>
																	</div>
																	
																	<div class="modal-body">
																		Yakin Untuk Menghapus {{$item->name}} Dari Daftar Pengguna?
																	</div>

																	<div class="modal-footer">
																	<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
																	<button type="submit" class="btn btn-danger">Hapus</button>
																	</div>
																</div>
																</div>
															</div>
														
														</form> --}}
													</td>
												</tr>
												@endforeach
											</tbody>
											
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

	<!--   Core JS Files   -->
	<script src="../../assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="../../assets/js/core/popper.min.js"></script>
	
	<!-- jQuery Scrollbar -->
	<script src="../../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
	<!-- Datatables -->
	<script src="../../assets/js/plugin/datatables/datatables.min.js"></script>

	<script src="../../js/jquery.3.6.1.min.js"></script>

	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script>
	$(document).ready(function() {
		$('.js-example-basic-multiple').select2();
	});
	</script>
	<script>
	$(document).ready(function() {
		$('.js-multiple').select2();
	});
	</script>

	


	<script >
		$(document).ready(function() {
			$('#basic-datatables').DataTable({
			});

			$('#multi-filter-select').DataTable( {
				"pageLength": 5,
				initComplete: function () {
					this.api().columns().every( function () {
						var column = this;
						var select = $('<select class="form-control"><option value=""></option></select>')
						.appendTo( $(column.footer()).empty() )
						.on( 'change', function () {
							var val = $.fn.dataTable.util.escapeRegex(
								$(this).val()
								);

							column
							.search( val ? '^'+val+'$' : '', true, false )
							.draw();
						} );

						column.data().unique().sort().each( function ( d, j ) {
							select.append( '<option value="'+d+'">'+d+'</option>' )
						} );
					} );
				}
			});

			// Add Row
			$('#add-row').DataTable({
				"pageLength": 5,
			});

			var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" data-target="#addRowModal" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

			// $('#addRowButton').click(function() {
			// 	$('#add-row').dataTable().fnAddData([
			// 		$("#addNamaPenyakit").val(),
			// 		action
			// 		]);
			// 	$('#addRowModal').modal('hide');

			// });
		});
	</script>
@endsection
