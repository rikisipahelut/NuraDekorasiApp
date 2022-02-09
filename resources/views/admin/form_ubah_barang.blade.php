@extends('template.admin.sidebar')
@section('title','Form Ubah Barang')
@section('container')
					
                    <div class="container-fluid">
                        <h1 class="mt-4">Ubah Barang Id : {{$barang->id_barang}}</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Form Ubah Barang</li>
                        </ol>
						@if(session('status'))
                                <div class="alert alert-success mt-2">
                                    {{session('status')}}
                                </div>
                        @endif

                       <div class="row">
                    	<div class="col">
                    		<form method="post" action="/admin/update_barang/{{$barang->id_barang}}" enctype="multipart/form-data">
							@method('patch')
							@csrf
								<input type="hidden" name="id_barang" value="{{$barang->id_barang}}">
							  <div class="form-group">
							    <label for="nama_barang">Nama Barang</label>
							    <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" id="nama_barang" aria-describedby="emailHelp" name="nama_barang" value="{{$barang->nama_barang}}">
							    <small id="emailHelp" class="form-text text-muted">Masukan dengan dengan benar</small>
								@error('nama_barang')
									<div class="invalid-feedback">
										{{$message}}
									</div>
								@enderror
							  </div>
							  <!-- <div class="form-group">
							    <label for="harga_barang">Harga</label>
							    <input type="number" class="form-control @error('harga_barang') is-invalid @enderror" id="harga_barang" name="harga_barang" value="{{$barang->harga_barang}}">
								@error('harga_barang')
									<div class="invalid-feedback">
										{{$message}}
									</div>
								@enderror
							  </div> -->
							  <div class="form-group">
							    <label for="ketersediaan_barang">Ketersediaan Barang</label>
							    <input type="number" class="form-control @error('ketersediaan_barang') is-invalid @enderror" id="ketersediaan_barang" name="ketersediaan_barang" value="{{$barang->ketersediaan_barang}}">
								@error('ketersediaan_barang')
									<div class="invalid-feedback">
										{{$message}}
									</div>
								@enderror
							  </div>
							  <div class="form-group">
                                <label>Masukan Foto Dokumentasi : jpeg, jpg, png</label>
                                <input type="file" class="form-control-file @error('foto_barang') is-invalid @enderror" name="foto_barang" value="$barang->foto_barang">
                                @error('foto')
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
  