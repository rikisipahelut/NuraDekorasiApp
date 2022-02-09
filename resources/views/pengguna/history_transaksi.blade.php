@extends('template.pengguna.navbar')
@section('title','History Transaksi')
@section('container')

  

  <div class="container">
    <div class="row mt-3">
        <div class="col">
          <h1><i class="fas fa-shopping-cart fa-fw"></i> History Transaksi Anda</h1>
          <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Id transaksi</th>
                                                <th>Tgl transaksi</th>
                                                <th>Nama Pelanggan</th>
                                                <th>Alamat</th>
                                                <th>No telp</th>
                                                <th>Tgl pemasangan</th>
                                                <th>Tgl selesai</th>
                                                <th>Grand total</th>
                                                <th>Bayar</th>
                                                <th>Sisa pembayaran</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                        @if(session('username'))
                                                
                                                @foreach( $history as $hist)
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$hist->id_transaksi}}</td>
                                                        <td>{{$hist->tgl_transaksi}}</td>
                                                        <td>{{$hist->nama_pelanggan}}</td>
                                                        <td>{{$hist->alamat}}</td>
                                                        <td>{{$hist->no_telp}}</td>
                                                        <td>{{$hist->tgl_pemasangan}}</td>
                                                        <td>{{$hist->tgl_selesai}}</td>
                                                        <td>{{$hist->grand_total}}</td>
                                                        <td>{{$hist->bayar}}</td>
                                                        <td>{{$hist->sisa_pembayaran}}</td>
                                                        <td>{{$hist->status}}</td>
                                                    </tr>
                                                @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                   
                                </div>
                            </div>

        </div>
    </div>
    <!-- ========================== -->
   
  </div> <!-- /container -->
  
  @endsection

