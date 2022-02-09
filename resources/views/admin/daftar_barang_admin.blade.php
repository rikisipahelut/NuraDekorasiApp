@extends('template.admin.sidebar')
@section('title','Daftar Barang')
@section('container')
                    <div class="container-fluid">
                        <h1 class="mt-4">Daftar Barang</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Daftar Barang</li>
                        </ol>
                       <div class="row mb-2">
                        <div class="col">
                            <a href="/admin/form_tambah_barang"class="btn btn-success">Tambah Data Barang</a>
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
                                Tabel Data Barang
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID Barang</th>
                                                <th>Nama Barang</th>
                                                <!-- <th>Harga Barang</th> -->
                                                <th>Jumlah Barang</th>
                                                <th>Gambar</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID Barang</th>
                                                <th>Nama Barang</th>
                                                <!-- <th>Harga Barang</th> -->
                                                <th>Jumlah Barang</th>
                                                <th>Gambar</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php $i="a"; ?>
                                            @foreach($tb_barang as $barang)
                                            <tr>
                                                <td>{{$barang->id_barang}}</td>
                                                <td>{{$barang->nama_barang}}</td>
                                                <!-- <td>{{$barang->harga_barang}}</td> -->
                                                <td>{{$barang->ketersediaan_barang}}</td>
                                                <td><a href="#" data-toggle="modal" data-target="#{{$i}}">{{$barang->foto_barang}}</a></td>
                                                <td class="text-center"><a href="/admin/form_ubah_barang/{{$barang->id_barang}}" class="btn btn-primary mb-1"><i class="fas fa-edit"></i></a>
                                                    <form method="post" action="/admin/hapus_barang/{{$barang->id_barang}}">
                                                    @method('delete')
                                                    @csrf
                                                        <button type="submit" name= submit class="btn btn-danger" onclick="return confirm('Yakin Ingin Hapus')"><i class="fas fa-trash-alt"></i></button>
                                                    </form>
                                                    <a href="/admin/form_tambah_harga/{{$barang->id_barang}}" class="btn btn-success mt-1"><i class="fas fa-plus"></i></a>
                                                </td>
                                              
                                            </tr>

                                            <!-- Modal Gambar -->
                                            <div class="modal fade" id="{{$i}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                                <h5 class="modal-title" id="aboutLabel">{{$barang->foto_barang}}</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                        </div>
                                                            <div class="modal-body text-center">
                                                                <img src="/image/foto_barang/{{$barang->foto_barang}}" alt="{{$barang->foto_barang}}" height="400" width="400">
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
@endsection
  