@extends('template.admin.sidebar')
@section('title','Form Tambah Gallery')
@section('container')
                    <div class="container-fluid">
                        <h1 class="mt-4">Tambah Gallery</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Form Tambah Gallery</li>
                        </ol>
						@if(session('status'))
                                <div class="alert alert-success mt-2">
                                    {{session('status')}}
                                </div>
                        @endif

                       <div class="row">
                    	<div class="col">
                    		<form method="post" action="/admin/tambah_gallery" enctype="multipart/form-data">
							@csrf
							  <div class="form-group">
							    <label for="nama_barang">Nama Barang</label>
							    <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" id="nama_barang" aria-describedby="emailHelp" name="nama_barang" value="{{old('nama_barang')}}">
							    <small id="emailHelp" class="form-text text-muted">Masukan dengan dengan benar</small>
								@error('nama_barang')
									<div class="invalid-feedback">
										{{$message}}
									</div>
								@enderror
							  </div>
														   
							  <div class="form-group">
                                <label>Masukan Foto Dokumentasi : jpeg, jpg, png</label>
                                <input type="file" class="form-control-file @error('foto_barang') is-invalid @enderror" name="foto_barang">
                                @error('foto_barang')
                                    <div class="invalid-feedback">
                                      {{$message}}
                                    </div>
                                @enderror
                              </div>  

							  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
							</form>
                    	</div>
                    </div>	
                    
                       
                    </div>
@endsection
  