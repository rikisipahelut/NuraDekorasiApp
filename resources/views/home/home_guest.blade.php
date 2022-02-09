@extends('template.guest.navbar_guest')
@section('title','Beranda')
@section('container')
                        @if(session('status'))
                                <script>alert("{{session('status')}}")</script>
                        @endif
  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron" id="bg">
    <div class="container text-white text-center">
      <h1 class="display-3">NURA DEKORASI</h1>
      <p>Serahkan semua kebutuhan dekorasi anda pada kami</p>
      <p><a class="btn btn-outline-warning btn-lg" href="#" role="button"  data-toggle="modal" data-target="#daftar">Daftar Sekarang &raquo;</a></p>
    </div>
  </div>

  <div class="container">
    
    <!-- ========================== -->
    <div class="row">
      <div class="col">
        <div class="card-deck">
            <?php $i="a"; ?>
            @foreach($tb_barang as $barang)
            <div class="card">
                <img src="/image/foto_barang/{{$barang->foto_barang}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{$barang->nama_barang}} </h5>
                    <p class="card-text">Semua Bahan Dekorasi Lengkap</p>
                    
                    
                </div>
                <div class="card-footer">
                <h5><a href="" class="text-right"  data-toggle="modal" data-target="#{{$i}}"><i class="fas fa-shopping-cart fa-fw"></i> Tambahkan ke keranjang</a></h5>
                <!-- <small class="text-muted">Last updated 3 mins ago</small> -->
                </div>
            </div>

            <!-- Modal Gambar -->
            <div class="modal fade" id="{{$i}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="aboutLabel">Pilih Kategori dan Jenis {{$barang->nama_barang}}</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                      <!-- ============ Modal Body =========== -->
                        <div class="container">
                          <div class="row mt-3 text-center mt-5 mb-5">
                              <div class="col mb-5">
                                  <h3><i class="far fa-sad-cry fa-4x"></i></h3>
                                  <h1>Anda Belum Login</h1>
                                  <br>
                              </div>
                          </div>
                        </div>
                      <!-- =================================== -->
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                      </div>
                  </div>
                </div>
            </div>


            <?php $i++;?>
            @endforeach
           
        </div>
    </div>
    </div>
    <hr>

  </div> <!-- /container -->

    <!-- Modal Daftar Sekarang -->
    <div class="modal fade" id="daftar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="aboutLabel"><i class="fas fa-user-plus"></i>  Daftar Akun Nura Dekorasi</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                      <!-- ============ Modal Body =========== -->
                          <form method="post" action="/guest/daftar_akun">
                            @csrf
                        
                              <div class="form-group">
                                  <label for="nama">Nama</label>
                                  <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{old('nama')}}">
                                    @error('nama')
                                      <div class="invalid-feedback">
                                        {{$message}}
                                      </div>
                                    @enderror
                              </div>
                              <div class="form-group">
                                  <label for="alamat">Alamat</label>
                                  <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" value="{{old('alamat')}}">
                                    @error('alamat')
                                      <div class="invalid-feedback">
                                        {{$message}}
                                      </div>
                                    @enderror
                              </div>
                              <div class="form-group">
                                  <label for="no_telp">No Telpon</label>
                                  <input type="number" min="0" class="form-control @error('no_telp') is-invalid @enderror" id="no_telp" name="no_telp" value="{{old('no_telp')}}" >
                                    @error('no_telp')
                                      <div class="invalid-feedback">
                                        {{$message}}
                                      </div>
                                    @enderror
                              </div>
                              <div class="form-group">
                                  <label for="email">Email</label>
                                  <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{old('email')}}">
                                    @error('email')
                                      <div class="invalid-feedback">
                                        {{$message}}
                                      </div>
                                    @enderror
                              </div>
                              <div class="form-group">
                                  <label for="password">Password</label>
                                  <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{old('password')}}">
                                    @error('password')
                                      <div class="invalid-feedback">
                                        {{$message}}
                                      </div>
                                    @enderror
                              </div>
                              <div class="form-group">
                                  <label for="konfirm">Konfirmasi Password</label>
                                  <input type="password" class="form-control @error('konfirm') is-invalid @enderror" id="konfirm" name="konfirm" value="{{old('konfirm')}}">
                                    @error('konfirm')
                                      <div class="invalid-feedback">
                                        {{$message}}
                                      </div>
                                    @enderror
                              </div>
                            
                            <button type="submit" name="submit" class="btn btn-primary mb-2">Daftar Sekarang</button>
                          </form>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                      </div>
                  </div>
                </div>
            </div>

         
   
  @endsection

