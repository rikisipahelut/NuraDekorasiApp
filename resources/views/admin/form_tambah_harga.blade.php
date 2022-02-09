@extends('template.admin.sidebar')
@section('title','Form Tambah Harga')
@section('container')
                    <div class="container-fluid">
                        <h1 class="mt-4">Tambah Harga Barang {{$barang->id_barang}}</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Form Tambah Harga Barang</li>
                        </ol>
						            @if(session('status'))
                            <div class="alert alert-success mt-2">
                                {{session('status')}}
                            </div>
                        @endif

                       <div class="row">
                    	    <div class="col">
                              <form method="post" action="/admin/form_tambah_harga">
                                @csrf		
                                <div class="form-group">
                                  <label for="id_barang">ID Barang</label>
                                  <input type="text" class="form-control @error('id_barang') is-invalid @enderror" id="id_barang" aria-describedby="emailHelp" name="id_barang" value="{{$barang->id_barang}}">
                                  <small id="emailHelp" class="form-text text-muted">Masukan dengan dengan benar</small>
                                    @error('id_barang')
                                      <div class="invalid-feedback">
                                          {{$message}}
                                      </div>
                                    @enderror
                                </div>
                                <?php $nama_barang = strtolower($barang->nama_barang); ?>
                                <div class="form-group">
                                  <label for="kategori">Kategori</label>
                                  <select class="form-control @error('kategori') is-invalid @enderror" id="kategori" name="kategori">
                                    <option value="-">---</option>
                                    @if($nama_barang == 'tenda')          
                                    <option value="biasa">biasa</option>              
                                    <option value="dump">dump</option>              
                                    <option value="vip">vip</option>
                                    @endif
                                    @if($nama_barang == 'kursi')
                                      <option value="biasa">biasa</option>              
                                      <option value="bangket">bangket</option>              
                                      <option value="pengantin">pengantin</option>             
                                      <option value="vip">vip</option>
                                    @endif
                                    @if($nama_barang == 'gayor')
                                      <option value="sterofoam">sterofoam</option>              
                                      <option value="natural">natural</option>              
                                    @endif 
                                    @if($nama_barang == 'meja')
                                      <option value="bundar">bundar</option>              
                                      <option value="panjang">panjang</option>              
                                    @endif  
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
                                    <option value="-">---</option>   
                                    @if($nama_barang == 'tenda')              
                                        <option value="2x4">2x4 Meter</option>              
                                        <option value="2x5">2x5 Meter</option>              
                                        <option value="3x2">3x2 Meter</option>              
                                        <option value="3x4">3x4 Meter</option>              
                                        <option value="3x5">3x5 Meter</option>              
                                        <option value="4x5">4x5 Meter</option>              
                                        <option value="5x6">5x6 Meter</option>
                                    @endif
                                    @if($nama_barang == 'gayor')           
                                        <option value="3,5">3,5 Meter</option>
                                    @endif  
                                    @if($nama_barang == 'meja')           
                                        <option value="180">180 Cm</option>
                                        <option value="100">100 Cm</option>
                                    @endif   
                                  </select>
                                  @error('ukuran')
                                      <div class="invalid-feedback">
                                        {{$message}}
                                      </div>
                                  @enderror
                               </div>
                                <div class="form-group">
                                <label for="harga_barang">Harga</label>
                                <input type="number" class="form-control @error('harga_barang') is-invalid @enderror" id="harga_barang" name="harga_barang">
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
  