@extends('template.admin.sidebar')
@section('title','Data Transaksi')
@section('container')
                    <div class="container-fluid">
                        <h1 class="mt-4">Data Transaksi</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Data Transaksi</li>
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
                                Tabel Data Transaksi | <i class="fas fa-file-pdf mr-1"></i> <a href="bagde" data-toggle="modal" data-target="#id">Download PDF</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                            <th>Id_transaksi</th>
                                                <th>Tgl_transaksi</th>
                                                <th>Nama_pelanggan</th>
                                                <th>Alamat</th>
                                                <th>No_telp</th>
                                                <th>Tgl_pemasangan</th>
                                                <th>Tgl_selesai</th>
                                                <th>Grand Total</th>
                                                <th>Bayar</th>
                                                <th>Sisa_Pembayaran</th>
                                                <th>Status</th>
                                                <th>Bukti_Bayar</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Id_transaksi</th>
                                                <th>Tgl_transaksi</th>
                                                <th>Nama_pelanggan</th>
                                                <th>Alamat</th>
                                                <th>No_telp</th>
                                                <th>Tgl_pemasangan</th>
                                                <th>Tgl_selesai</th>
                                                <th>Grand Total</th>
                                                <th>Bayar</th>
                                                <th>Sisa_Pembayaran</th>
                                                <th>Status</th>
                                                <th>Bukti_Bayar</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php $i="a"; ?>
                                            @foreach($tb_data_transaksi as $transaksi)
                                            <tr>
                                                <td>{{$transaksi->id_transaksi}}</td>
                                                <td>{{$transaksi->tgl_transaksi}}</td>
                                                <td>{{$transaksi->nama_pelanggan}}</td>
                                                <td>{{$transaksi->alamat}}</td>
                                                <td>{{$transaksi->no_telp}}</td>
                                                <td>{{$transaksi->tgl_pemasangan}}</td>
                                                <td>{{$transaksi->tgl_selesai}}</td>
                                                <td>{{$transaksi->grand_total}}</td>
                                                <td>{{$transaksi->bayar}}</td>
                                                <td>{{$transaksi->sisa_pembayaran}}</td>
                                                <td>{{$transaksi->status}}</td>
                                                <td><a href="#" data-toggle="modal" data-target="#{{$i}}">{{$transaksi->bukti_bayar}}</a></td>
            
                                                <td class="text-center"><a href="/admin/data_detail_transaksi/{{$transaksi->id_transaksi}}" class="btn btn-primary mb-1"><i class="fas fa-info-circle"></i></a>
                                                    @if($transaksi->status == 'pending' or $transaksi->status == 'belum lunas')
                                                        <form method="post" action="/admin/konfirm_transaksi/{{$transaksi->id_transaksi}}">
                                                        @method('patch')
                                                        @csrf
                                                            <button type="submit" name= submit class="btn btn-success mb-1" onclick="return confirm('Yakin Ingin Konfirmasi')"><i class="fas fa-check"></i></button>
                                                        </form>
                                                    @endif
                                                    <form method="post" action="/admin/hapus_transaksi/{{$transaksi->id_transaksi}}">
                                                    @method('delete')
                                                    @csrf
                                                        <button type="submit" name= submit class="btn btn-danger" onclick="return confirm('Yakin Ingin Hapus')"><i class="fas fa-trash-alt"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <!-- Modal Gambar -->
                                            <div class="modal fade" id="{{$i}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                                <h5 class="modal-title" id="aboutLabel">{{$transaksi->bukti_bayar}}</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                        </div>
                                                            <div class="modal-body text-center">
                                                                <img src="/image/bukti_transfer/{{$transaksi->bukti_bayar}}" alt="{{$transaksi->bukti_bayar}}" height="400" width="400">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php $i++;?>
                                            @endforeach
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                     <!-- Modal Gambar  2-->
                     <div class="modal fade" id="id" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="aboutLabel">Cetak</h5>
                                    
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                        <div class="modal-body">
                                       
                                           <!-- ==================== -->
                                <form method="post" action="/admin/cetak_pdf">
                                    @csrf
                                    <div class="form-group">
                                        <label for="bulan_tahun">Bulan dan Tahun</label>
                                        <input type="month" class="form-control @error('bulan_tahun') is-invalid @enderror" id="bulan_tahun" aria-describedby="emailHelp" name="bulan_tahun" value="">
                                        @error('bulan_tahun')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
 
                                    <button type="submit" name="submit" class="btn btn-primary mb-2">Download PDF</button>
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
  