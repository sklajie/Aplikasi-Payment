@extends('layouts.app2')

@section('title' , 'Table Pembayaran' , 'active')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title" style="padding-top: 10px;">Data Pembayaran</h4>
					</div>
                        <br>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="d-flex align-items-center">
										<h4 class="card-title"><b>Data Pembayaran Anda</b></h4>
									</div>
								</div>

								<div class="card-body">
									
									<div class="table-responsive">
										<table id="add-row" class="display table table-striped table-hover">
											<thead>
												<tr>
													<th>No</th>
													<th>Nama</th>
													<th>NIM</th>
													<th>semester</th>
													<th>Virtual Account</th>
													<th>Status Pembayaran</th>
													<th>Amount</th>
													<th>Aksi</th>
												</tr>
											</thead>
											<tbody>
												@foreach ($pembayaran as $data)
												<tr>
													<td>{{ $loop->iteration }}</td>
													<td>{{ $data->nama }}</td>
													<td>{{ $data->nim }}</td>
													<td>{{ $data->semester }}</td>
													<td>{{ $data->va }}</td>
													<td>{{ $data->status }}</td>
													<td>{{ $data->amount }}</td>
													<td>
														<a href="{{ url('') }}/siakad/invoice/{{ $data->id }}" class="btn btn-primary btn-xs"><i class="">&nbsp;Cek Invoice</i></a>
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
