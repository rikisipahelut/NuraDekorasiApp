@extends('template.admin.sidebar')
@section('title','Data Detail Transaksi')
@section('container')
                    <div class="container-fluid">
                        <h1 class="mt-4">Detail Transaksi {{$tb_detail_transaksi[0]->id_transaksi}}</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Data Detail Transaksi</li>
                        </ol>
                       <div class="row mb-2">
                        <div class="col">
                            <!-- <a href="/admin/form_tambah_barang"class="btn btn-success">Tambah Data Barang</a> -->
                        </div>
                      
                       </div>
                       @if(session('status'))
                                <div class="alert alert-success mt-2">
                                    {{session('status')}}
                                </div>
                        @endif
                      
                    
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Tabel Data Transaksi
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>id_detail</th>
                                                <th>id_transaksi</th>
                                                <th>id_barang</th>
                                                <th>nama_barang</th>
                                                <th>harga</th>
                                                <th>qty</th>
                                                <th>sub_total</th>
                                                <th>pembeli</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>id_detail</th>
                                                <th>id_transaksi</th>
                                                <th>id_barang</th>
                                                <th>nama_barang</th>
                                                <th>harga</th>
                                                <th>qty</th>
                                                <th>sub_total</th>
                                                <th>pembeli</th>
                                                
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                           @foreach($tb_detail_transaksi as $detail)
                                            <tr>
                                                <td>{{$detail->id_detail}}</td>
                                                <td>{{$detail->id_transaksi}}</td>
                                                <td>{{$detail->id_barang}}</td>
                                                <td>{{$detail->nama_barang}}</td>
                                                <td>{{$detail->harga}}</td>
                                                <td>{{$detail->qty}}</td>
                                                <td>{{$detail->subtotal}}</td>
                                                <td>{{$detail->pembeli}}</td>                                              
                                            </tr>
                                            @endforeach
                                         
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
@endsection
  