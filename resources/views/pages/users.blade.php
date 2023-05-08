@extends('layouts.app')

@section('title' , 'Users' , 'active')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

		<div class="main-panel">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title" style="padding-top: 10px;">Data Pengguna</h4>
                        
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
								<a href="/admin/datapenyakit">Data Pengguna</a>
							</li>
						</ul>
                        </div>
                        <br>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="d-flex align-items-center">
										<h4 class="card-title"><b>Data Pengguna</b></h4>
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
													<th>No</th>
													<th>Nama</th>
													<th>Username</th>
													<th>Email</th>
													<th>No Handphone</th>
													<th>Status</th>
													<th style="width: 5%">Action</th>
												</tr>
											</thead>
											
											<tbody>	
												@foreach ($user as $data)	
												<tr>
													<td>{{$loop->iteration}}</td>
													<td>{{$data->name}}</td>
													<td>{{$data->username}}</td>
													<td>{{$data->email}}</td>
													<td>{{$data->no_hp}}</td>
													<td>{{$data->level['nama_level']}}</td>
													
													<td>
														<form action="{{route('users.destroy', $data->id)}}" method="POST">
															@csrf
															@method('delete')
															<a href="{{ route('users.edit', $data->id )}}"><i class="fa fa-print">&NonBreakingSpace; Edit</i></a>
															<button class="btn btn-danger btn-sm">Hapus</button>
														</form>
														
														

															
															{{-- <form action="" method="POST">
																@csrf
																@method('delete')
																<button type="submit" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove" onclick="return confirm('apakah anda yakin ingin menghapus ?')">
																	<i class="fa fa-trash">&NonBreakingSpace; Delete</i>
																</button>
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

@endsection
