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
										<button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
											<i class="fa fa-plus"></i>
											&NonBreakingSpace;Tambahkan
										</button>
									</div>
								</div>
								<div class="card-body">
									<!-- Modal new-->
									<div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header no-bd">
													<h5 class="modal-title">
														<span class="fw-mediumbold">
														Tambahkan</span> 
														<span class="fw-light">
															penyakit
														</span>
													</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
														<div class="row">
															<div class="col-sm-12">
																<div class="form-group form-group-default">
																	<form action="" method="POST">
																		@csrf
																	<div>
																	<label>Kode Penyakit</label>
																	<input type="text" class="form-control" value="" name="kode_penyakit" placeholder="masukan kode penyakit" style="border: 1px solid #f1f1f1; line-height:40px; padding-left:10px;" readonly>
																	<br>
																	<label>Nama Penyakit</label>
																	<input type="text" class="form-control" name="nama_penyakit" placeholder="masukan nama penyakit" style="border: 1px solid #f1f1f1; line-height:40px; padding-left:10px;">
																	<br>
																	<label>Deskripsi Penyakit</label>
																	<textarea name="deskripsi" placeholder="masukan deskripsi" class="form-control" id="" cols="30" rows="10" style="border: 1px solid #f1f1f1; padding-left:10px;"></textarea>
																	{{-- <input type="textarea" class="form-control" name="deskripsi" placeholder="masukan deskripsi penyakit" style="border: 1px solid #f1f1f1; line-height:40px; padding-left:10px;"> --}}
																	{{-- <label>Gejala</label>
																	<select id="gejala[]" class="form-control js-example-basic-multiple" name="id_gejala[]" multiple="multiple" style="border: 1px solid #f1f1f1; line-height:40px; padding-left:10px; width:100%;">
																		
																		@foreach ($gejala as $item)
																			<option value="{{ $item->id }}">{{ $item->nama_gejala }}</option>
																		@endforeach
																	</select>
																	<label>Gejala</label>
																	<select id="gejala[]" class="form-control js-multiple" name="id_gejala[]" multiple="multiple" style="border: 1px solid #f1f1f1; line-height:40px; padding-left:10px; width:100%;">
																		
																		@foreach ($gejala as $item)
																			<option value="{{ $item->id }}">{{ $item->nama_gejala }}</option>
																		@endforeach
																	</select> --}}
																	</div>
																	<div class="modal-footer no-bd">
																		<input type="submit" class="btn btn-primary" name="submit" value="Add">
																		{{-- <button type="submit" id="addRowButton" class="btn btn-primary" name="submit">Add</button> --}}
																		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																	</div>
																</form>
																</div>
															</div>
														</div>		
												</div>
											</div>
										</div>
									</div>

									
									<div class="table-responsive">
										<table id="add-row" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th style="width: 2%">
                                                        <input type="checkbox">
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
																<i class="fa fa-print">&NonBreakingSpace; Edit</i>
															</button>

																{{-- modal update --}}
																<div class="modal fade" id="updateRowModal" tabindex="-1" role="dialog" aria-hidden="true">
																	<div class="modal-dialog" role="document">
																		<div class="modal-content">
																			<div class="modal-header no-bd">
																				<h5 class="modal-title">
																					<span class="fw-mediumbold">
																					Edit</span> 
																					<span class="fw-light">
																						nama penyakit
																					</span>
																				</h5>
																				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																					<span aria-hidden="true">&times;</span>
																				</button>
																			</div>
																			<div class="modal-body">
																					<div class="row">
																						<div class="col-sm-12">
																							<div class="form-group form-group-default">
																								<form action="" method="POST">
																									@method('put')
																									@csrf
																								<div>
																								<label>Kode Penyakit</label>
																								<input type="text" class="form-control" disabled value="" name="kode_penyakit" placeholder="masukan kode penyakit" style="border: 1px solid #f1f1f1; line-height:40px; padding-left:10px;">
																								<br>
																								<label>Nama Penyakit</label>
																								<input type="text" class="form-control" name="nama_penyakit" value="" placeholder="masukan nama penyakit" style="border: 1px solid #f1f1f1; line-height:40px; padding-left:10px;">
																								<br>
																								<label>Deskripsi Penyakit</label>
																								<textarea name="deskripsi" class="form-control" id="" cols="30" rows="10" value="" style="border: 1px solid #f1f1f1; padding-left:10px;"></textarea>
																								{{-- <input type="text" class="form-control" name="nama_penyakit" value="{{ $data->nama_penyakit }}" placeholder="masukan nama penyakit" style="border: 1px solid #f1f1f1; line-height:40px; padding-left:10px;"> --}}
																								<br>
																								{{-- <label for="">Gejala</label>
																									<ul>
																										@foreach ($data->tgejala as $item)
																											<li>{{ $item->nama_gejala }}</li>
																										@endforeach
																										
																										
																									</ul>
																								<label for="">Gejala baru</label>
																								<select id="id_gejala" class="form-control select-multiple" name="id_gejala[]" multiple="multiple" style="border: 1px solid #f1f1f1; line-height:40px; padding-left:10px; width:100%;">
																									@foreach ($gejala as $item)
																										<option value="{{ $item->id }}">{{ $item->nama_gejala }}</option>
																									@endforeach
																								</select>
																								<script>
																									$(document).ready(function() {
																										$('.select-multiple').select2();
																									});
																									</script> --}}
																								</div>
																								<div class="modal-footer no-bd">
																									<input type="submit" class="btn btn-warning" name="submit" value="Update">
																									{{-- <button type="submit" id="addRowButton" class="btn btn-primary" name="submit">Add</button> --}}
																									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																								</div>
																							</form>
																							</div>
																						</div>
																					</div>		
																			</div>
																			
																		</div>
																	</div>
																</div>

															
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
