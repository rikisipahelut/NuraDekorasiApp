@extends('template.pengguna.navbar')
@section('title','Keranjang')
@section('notif',"$notif")
@section('container')

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <!-- <div class="jumbotron" id="bg">
    <div class="container text-white text-center">
      <h1 class="display-3">NURA DEKORASI</h1>
      <p>Serahkan semua kebutuhan dekorasi anda pada kami</p>
      <p><a class="btn btn-outline-warning btn-lg" href="#" role="button">Daftar Sekarang &raquo;</a></p>
    </div>
  </div> -->
@if(session('id_transaksi'))
  <div class="container">
    <div class="row mt-3">
        <div class="col">
          @if($tb_detail_transaksi[0]->id_transaksi != 0)
          <h1><i class="fas fa-shopping-cart fa-fw"></i> Details Transaksi {{$tb_detail_transaksi[0]->id_transaksi}}</h1>
          @endif
          <div class="card-body">
                        @if(session('status'))
                                <div class="alert alert-success mt-2">
                                    {{session('status')}}
                                </div>
                        @endif
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                             
                                                <th>id_transaksi</th>
                                                <th>id_barang</th>
                                                <th>nama_barang</th>
                                                <th>harga</th>
                                                <th>qty</th>
                                                <th>sub_total</th>
                                                <th>pembeli</th>
                                                <th>aksi</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                            
                                                <th>id_transaksi</th>
                                                <th>id_barang</th>
                                                <th>nama_barang</th>
                                                <th>harga</th>
                                                <th>qty</th>
                                                <th>sub_total</th>
                                                <th>pembeli</th>
                                                <th>aksi</th>
                                                
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                          <!-- data tidak ada -->
                                          @if($tb_detail_transaksi == null)
                                            <tr>
                                              <td colspan="8" class="text-center text-danger"><h6>Belum ada barang yang anda tambahkan</h6> </td>
                                            </tr>
                                          @else
                                          <?php $grandtotal=0; ?>
                                            @foreach($tb_detail_transaksi as $detail)
                                            <tr>
                                              <td>{{$detail->id_transaksi}}</td>
                                              <td>{{$detail->id_barang}}</td>
                                              <td>{{$detail->nama_barang}}</td>
                                              <td>{{$detail->harga}}</td>
                                              <td>{{$detail->qty}}</td>
                                              <td>{{$detail->subtotal}}</td>
                                              <td>{{$detail->pembeli}}</td>
                                              <td><form method="post" action="/pengguna/hapus_detail_transaksi/{{$detail->id_detail}}">
                                                 @method('delete')
                                                 @csrf
                                                 <button type="submit" name= submit class="btn btn-danger" onclick="return confirm('Yakin Ingin Hapus')"><i class="fas fa-trash-alt"></i></button>
                                              </form>
                                              </td>
                                            </tr>
                                            <?php $grandtotal=$grandtotal+$detail->subtotal;?>
                                            @endforeach
                                            <?php $dp=$grandtotal*50/100;?> 
                                          @endif               
                                           
                                        </tbody>
                                    </table>
                                    <table class="table border-0" id="dataTable" width="100%" cellspacing="0">
                                                <!-- <thead> -->
                                                    <tr>
                                                        <td colspan="5" class="text-right bg-info"><h4>Grand Total :</h4></td>
                                                        <td colspan="1" class="text-center bg-warning"><h4>Rp {{$grandtotal}}</h4></td>
                                                        <td colspan="1" class="text-center bg-danger text-white"><h4> Minimal DP 50% = Rp {{$dp}}</h4></td>
                                                        <form action="/pengguna/form_pembayaran" method="get">
                                                        @csrf
                                                            <td colspan="1" class="text-center bg-danger text-white">
                                                                <label for="hari_sewa">X Hari</label>
                                                                <input type="number" min="1" name="hari_sewa" id="hari_sewa" placeholder="Berapa Hari" value=1></td>
                                                            <td class="text-center border-0"><button type="submit" name="submit" class="btn btn-success">Pembayaran</a></td>
                                                        </form>
                                                        <!-- <td class="text-center border-0"><a href="#" data-toggle="modal" data-target="#id" class="btn btn-success">Pembayaran</a></td> -->
                                                    </tr>  
                                                <!-- </thead> -->
                                            </table>
                                </div>
                            </div>

        </div>
    </div>
    <!-- ========================== -->
   
  </div> <!-- /container -->

  <!-- ============Modal================ -->
   <!-- Modal Gambar -->
   <div class="modal fade" id="id" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="aboutLabel">Pembayaran Transaksi No : {{$detail->id_transaksi}}</h5>
                                   
                                    
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                        <div class="modal-body">
                                       
                                           <!-- ==================== -->
                                <form method="post" action="/pengguna/transaksi" enctype="multipart/form-data">
                                    @csrf
                                
                                    <input type="hidden" name="id_transaksi" value="{{$detail->id_transaksi}}">
                                    <input type="hidden" name="grandtotal" value="{{$grandtotal}}">
                                    <div class="form-group">
                                        <label for="tgl_pemasangan">Tgl Pemasangan</label>
                                        <input type="date" class="form-control @error('tgl_pemasangan') is-invalid @enderror" id="tgl_pemasangan" aria-describedby="emailHelp" name="tgl_pemasangan" value="">
                                        @error('tgl_pemasangan')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_selesai">Tgl selesai</label>
                                        <input type="date" class="form-control @error('tgl_selesai') is-invalid @enderror" id="tgl_selesai" aria-describedby="emailHelp" name="tgl_selesai" value="">
                                   
                                        @error('tgl_selesai')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_pelanggan">Nama_pelanggan</label>
                                        <input type="text" class="form-control @error('nama_pelanggan') is-invalid @enderror" id="nama_pelanggan" aria-describedby="emailHelp" name="nama_pelanggan" value="">
                                   
                                        @error('nama_pelanggan')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" aria-describedby="emailHelp" name="alamat" value="">
                                   
                                        @error('alamat')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="no_telp">No Handphone</label>
                                        <input type="text" class="form-control @error('no_telp') is-invalid @enderror" id="no_telp" aria-describedby="emailHelp" name="no_telp" value="">
                                   
                                        @error('no_telp')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Upload Bukti Transfer: jpeg, jpg, png</label>
                                        <input type="file" class="form-control-file @error('bukti_transfer') is-invalid @enderror" name="bukti_transfer">
                                        @error('bukti_transfer')
                                            <div class="invalid-feedback">
                                            {{$message}}
                                            </div>
                                        @enderror
                                    </div> 
                                    <h5 class="bg-warning p-3">Grand Total : {{$grandtotal}}</h5>
                                    <h5 class="bg-danger p-3">Dp 50% : {{$dp}}</h5>
                                    <div class="form-group">
                                        <label for="bayar">Bayar</label>
                                        <input type="number" min="{{$dp}}" max="{{$grandtotal}}" class="form-control @error('bayar') is-invalid @enderror" id="bayar" aria-describedby="emailHelp" name="bayar" value="{{$dp}}">
                                   
                                        @error('bayar')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="rekening">Rekening</label>
                                        <input type="text" disabled class="form-control" id="rekening" aria-describedby="emailHelp" name="rekening" value="BCA 678778 A/N YOGI SAPUTRA">
                                    </div>
                                    
                                    <button type="submit" name="submit" class="btn btn-primary mb-2">Bayar</button>
                                </form>
<!-- =========================================================================== -->
                                </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>

  @else
  <div class="container">
    <div class="row mt-3 text-center mt-5 mb-5">
        <div class="col mb-5">
            <h1><i class="far fa-sad-cry fa-7x"></i></h1>
            <h1>Anda Belum Belanja !!!</h1>
            <br>
            <br>
            
            
          
          
        </div>
    </div>
  </div>
  @endif
  @endsection

