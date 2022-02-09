@extends('template.pengguna.navbar')
@section('title','Beranda')
@section('notif',"$notif")
@section('container')
                        @if(session('status'))
                                <script>alert("{{session('status')}}")</script>
                        @endif
  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron" id="bg">
    <div class="container text-white text-center">
      <h1 class="display-3">NURA DEKORASI</h1>
      <p>Serahkan semua kebutuhan dekorasi anda pada kami</p>
      <!-- <p><a class="btn btn-outline-warning btn-lg" href="#" role="button">Daftar Sekarang &raquo;</a></p> -->
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
                          <form method="post" action="/pengguna/detail_transaksi">
                            @csrf
                                <input type="hidden" name="id_barang" value="{{$barang->id_barang}}">

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
                                        <option value="180">180 Cm </option>
                                        <option value="100">100 Cm </option>
                                    @endif         
                              
                                  </select>
                                  @error('ukuran')
                                      <div class="invalid-feedback">
                                        {{$message}}
                                      </div>
                                  @enderror
                               </div>
                               <div class="form-group">
                                <label for="qty">Qty</label>
                                <input type="number" min="1" max="{{$barang->ketersediaan_barang}}" class="form-control @error('qty') is-invalid @enderror" id="qty" name="qty">
                                  @error('qty')
                                    <div class="invalid-feedback">
                                      {{$message}}
                                    </div>
                                  @enderror
                                </div>
                            
                            <button type="submit" name="submit" class="btn btn-primary mb-2">Tambahkan</button>
                          </form>
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

  
   
  @endsection

