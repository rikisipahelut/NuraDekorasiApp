@extends('template.admin.sidebar')
@section('title','Form Tambah Harga')
@section('container')
                    <div class="container-fluid">
                        <h1 class="mt-4">Ubah Harga Barang</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Form Ubah Harga Barang</li>
                        </ol>
						            @if(session('status'))
                            <div class="alert alert-success mt-2">
                                {{session('status')}}
                            </div>
                        @endif

                       <div class="row">
                    	    <div class="col">
                              <form method="post" action="/admin/update_harga/{{$tb_harga[0]->id}}">
                                @method('patch')
                                @csrf	
                                <div class="form-group">
                                  <label for="id_barang">ID Barang</label>
                                  <input type="text" class="form-control @error('id_barang') is-invalid @enderror" id="id_barang" aria-describedby="emailHelp" name="id_barang" value="{{$tb_harga[0]->id_barang}}">
                                  <small id="emailHelp" class="form-text text-muted">Masukan dengan dengan benar</small>
                                    @error('id_barang')
                                      <div class="invalid-feedback">
                                          {{$message}}
                                      </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                  <label for="kategori">Kategori</label>
                                  <select class="form-control @error('kategori') is-invalid @enderror" id="kategori" name="kategori" >
                                    <option value="{{$tb_harga[0]->kategori}}">{{$tb_harga[0]->kategori}}</option>              
                                    <option value="biasa">biasa</option>              
                                    <option value="dump">dump</option>              
                                    <option value="vip">vip</option>              
                                  </select>
                                    @error('kategori')
                                        <div class="invalid-feedback">
                                          {{$message}}
                                        </div>
                                    @enderror
                                </div>
							                  <div class="form-group">
                                  <label for="ukuran">Ukuran</label>
                                  <select class="form-control @error('ukuran') is-invalid @enderror" id="ukuran" name="ukuran">
                                    <option value="{{$tb_harga[0]->ukuran}}">{{$tb_harga[0]->ukuran}} Meter</option>              
                                    <option value="2x4">2x4 Meter</option>              
                                    <option value="2x5">2x5 Meter</option>              
                                    <option value="3x2">3x2 Meter</option>              
                                    <option value="3x4">3x4 Meter</option>              
                                    <option value="3x5">3x5 Meter</option>              
                                    <option value="4x5">4x5 Meter</option>              
                                    <option value="5x6">5x6 Meter</option>            
                                  </select>
                                  @error('ukuran')
                                      <div class="invalid-feedback">
                                        {{$message}}
                                      </div>
                                  @enderror
                               </div>
                                <div class="form-group">
                                <label for="harga_barang">Harga</label>
                                <input type="number" class="form-control @error('harga_barang') is-invalid @enderror" id="harga_barang" name="harga_barang" value="{{$tb_harga[0]->harga}}">
                                  @error('harga_barang')
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
  