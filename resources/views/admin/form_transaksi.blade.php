@extends('template.admin.sidebar2')
@section('title','Form Transaksi')
@section('container')
                    <div class="container-fluid">
                        <h1 class="mt-4">Transaksi</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">No Transaksi : {{$id_transaksi}}</li>
                        </ol>
						@if(session('status'))
                                <script>alert("{{session('status')}}")</script>
                                <!-- <div class="alert alert-success mt-2">
                                    {{session('status')}}
                                </div> -->
                                <!-- <?php session()->flush(); ?> -->
                        @endif

                       <div class="row">
                    	<div class="col mb-2">
                    		<form method="post" action="/admin/detail_transaksi">
							@csrf
							  
                              <div class="form-group">
                                  <label for="barang">Barang</label>
                                  <select class="form-control @error('barang') is-invalid @enderror" id="barang" name="id_harga">
                                    
                                    <option value="">-</option>
                                    @foreach($tb_join as $join)
                                    <option value="{{$join->id}}">{{$join->nama_barang.' '.$join->kategori.' '.$join->ukuran.' = '.$join->harga}}</option>
                                    @endforeach        
                                </select>
                                  @error('barang')
                                      <div class="invalid-feedback">
                                        {{$message}}
                                      </div>
                                  @enderror
                               </div>
                               <div class="form-group">
							    <label for="qty">Qty</label>
							    <input type="number" class="form-control @error('qty') is-invalid @enderror" id="qty" aria-describedby="emailHelp" name="qty" value="">
							    <small id="emailHelp" class="form-text text-muted">Masukan dengan dengan benar</small>
								@error('qty')
									<div class="invalid-feedback">
										{{$message}}
									</div>
								@enderror
							  </div>
                              <input type="hidden" name="id_transaksi" value="{{$id_transaksi}}">
 							  <button type="submit" name="submit" class="btn btn-primary">Tambah</button>
							</form>
                            
                    	    </div>
                            <div class="col">
                                   
                                    <?php $grandtotal=0; ?>
                                     
                                    
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-table mr-1"></i>
                                        Details Penjualan
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>ID Transaksi</th>
                                                        <th>ID Barang</th>
                                                        <th>Nama Barang</th>
                                                        <th>Harga</th>
                                                        <th>Qty</th>
                                                        <th>Subtotal</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <!-- <tfoot>
                                                    <tr>
                                                        <th>ID Transaksi</th>
                                                        <th>ID Barang</th>
                                                        <th>Nama Barang</th>
                                                        <th>Harga</th>
                                                        <th>Qty</th>
                                                        <th>Subtotal</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </tfoot> -->
                                                <tbody>
                                                    @foreach($tb_detail_transaksi as $dt)
                                                    <tr>
                                                        <td>{{$dt->id_transaksi}}</td>
                                                        <td>{{$dt->id_barang}}</td>
                                                        <td>{{$dt->nama_barang}}</td>
                                                        <td>{{$dt->harga}}</td>
                                                        <td>{{$dt->qty}}</td>
                                                        <td>{{$dt->subtotal}}</td>
                                                        <td>
                                                            <form method="post" action="/admin/hapus_detail_transaksi/{{$dt->id_detail}}">
                                                                @method('delete')
                                                                @csrf
                                                                <button type="submit" name= submit class="btn btn-danger" onclick="return confirm('Yakin Ingin Hapus')"><i class="fas fa-trash-alt"></i></button>
                                                            </form>
                                                    </td>
                                                    </tr>
                                                    <?php $grandtotal=$grandtotal+$dt->subtotal;?>
                                                    @endforeach  
                                                    <?php $dp=$grandtotal*50/100;?>                      
                                                </tbody>
                                            </table>
                                            <table class="table border-0" id="dataTable" width="100%" cellspacing="0">
                                                <!-- <thead> -->
                                                    <tr>
                                                        <td colspan="5" class="text-right bg-info"><h4>Grand Total :</h4></td>
                                                        <td colspan="1" class="text-center bg-warning"><h4>Rp {{$grandtotal}}</h4></td>
                                                        <td colspan="1" class="text-center bg-danger text-white"><h4> Minimal DP 50% = Rp {{$dp}}</h4></td>
                                                        <form action="/admin/form_pembayaran" method="get">
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
                        </div>
                    </div>

                    <!-- Modal Gambar -->
                    <div class="modal fade" id="id" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="aboutLabel">Pembayaran Transaksi No : {{$id_transaksi}}</h5>
                                    
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                        <div class="modal-body">
                                       
                                           <!-- ==================== -->
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
                                    <h5 class="bg-warning p-3">Grand Total : {{$grandtotal}}</h5>
                                    <h5 class="bg-danger p-3">Dp 50% : {{$dp}}</h5>
                                    <div class="form-group">
                                        <label for="bayar">Bayar</label>
                                        <input type="text" class="form-control @error('bayar') is-invalid @enderror" id="bayar" aria-describedby="emailHelp" name="bayar" value="">
                                   
                                        @error('bayar')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
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
@endsection
  