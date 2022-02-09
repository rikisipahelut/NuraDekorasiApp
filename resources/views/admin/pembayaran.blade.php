@extends('template.admin.sidebar')
@section('title','Pembayaran Admin')
@section('container')

  

  <div class="container-full m-5">
    <div class="row mt-3">
        <div class="col-6">
          <h2><i class="fas fa-shopping-cart fa-fw"></i>Pembayaran Transaksi {{$id_transaksi}} | Admin</h2>

          <form method="post" action="/admin/transaksi">
                                    @csrf
                                
                                    <input type="hidden" name="id_transaksi" value="{{$id_transaksi}}">
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
                                   
                                    <h5 class="bg-warning p-3">Grand Total : {{$grandtotal}} </h5>
                                    <h5 class="bg-danger p-3">Dp 50% : {{$grandtotal/2}} </h5>
                                    <div class="form-group">
                                        <label for="bayar">Bayar</label>
                                        <input type="number" min="{{$grandtotal/2}}" max="{{$grandtotal}}" class="form-control @error('bayar') is-invalid @enderror" id="bayar" aria-describedby="emailHelp" name="bayar" value="{{$grandtotal}}">
                                   
                                        @error('bayar')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                    <!-- <div class="form-group">
                                        <label for="rekening">Rekening</label>
                                        <input type="text" disabled class="form-control" id="rekening" aria-describedby="emailHelp" name="rekening" value="BCA 678778 A/N YOGI SAPUTRA">
                                    </div> -->
                                    
                                    <button type="submit" name="submit" class="btn btn-primary mb-2">Bayar</button>
                                </form>
    </div>
    <!-- ========================== -->
   
  </div> <!-- /container -->
  
  @endsection

