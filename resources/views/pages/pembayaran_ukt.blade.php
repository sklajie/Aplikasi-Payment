@extends('layouts.app')

@section('title' , 'Pembayaran' , 'active')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

		<div class="main-panel">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title" style="padding-top: 10px;">Data Pembayaran</h4>
                        
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
                        <br>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="d-flex align-items-center">
										<h4 class="card-title"><b>Data Pembayaran</b></h4>
									</div>
								</div>
								<div class="card-body">
									<form action="">
										
									</form>
								</div>
									
									<div class="table-responsive">
										<table id="add-row" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th style="width: 2%">
                                                        <input type="checkbox" id="head-cb">
                                                    </th>
													<th>Nim</th>
													<th>Nama</th>
													<th>Semester</th>
													<th>Tahun Akademik</th>
													<th>Tanggal Bayar</th>
													<th>Status</th>
													<th style="width: 5%">Action</th>
												</tr>
											</thead>
											{{-- <tfoot>
												<tr>
													<th>No</th>
													<th>Nama Penyakit</th>
													<th>Action</th>
												</tr>
											</tfoot> --}}
											<tbody>
													
												<tr>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td>
														<div class="form-button-action">
															<button type="button" data-toggle="modal" data-original-title="Edit"  title="" data-target="#updateRowModal" class="btn btn-link btn-info btn-lg" data-original-title="Edit Task">
																<i class="fa fa-print">&NonBreakingSpace;Print</i>
															</button>

						
															
															{{-- <form action="" method="POST">
																@csrf
																@method('delete')
																<button type="submit" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove" onclick="return confirm('apakah anda yakin ingin menghapus ?')">
																	<i class="fa fa-trash">&NonBreakingSpace; Delete</i>
																</button>
															</form> --}}
														</div>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
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
