@extends('template.admin.sidebar')
@section('title','Daftar Harga')
@section('container')
                    <div class="container-fluid">
                        <h1 class="mt-4">Daftar Harga Barang</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Daftar Harga Barang</li>
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
                                Tabel Harga Barang
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>id</th>
                                                <th>id_barang</th>
                                                <th>kategori</th>
                                                <th>ukuran</th>
                                                <th>harga_barang</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>id</th>
                                                <th>id_barang</th>
                                                <th>kategori</th>
                                                <th>ukuran</th>
                                                <th>harga_barang</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach($tb_harga as $harga)
                                            <tr>
                                                <td>{{$harga->id}}</td>
                                                <td>{{$harga->id_barang}}</td>
                                                <td>{{$harga->kategori}}</td>
                                                <td>{{$harga->ukuran}}</td>
                                                <td>{{$harga->harga}}</td>
                                                <td class="text-center"><a href="/admin/form_ubah_harga/{{$harga->id}}" class="btn btn-primary mb-1"><i class="fas fa-edit"></i></a>
                                                    <form method="post" action="/admin/hapus_harga/{{$harga->id}}">
                                                    @method('delete')
                                                    @csrf
                                                        <button type="submit" name= submit class="btn btn-danger" onclick="return confirm('Yakin Ingin Hapus')"><i class="fas fa-trash-alt"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
@endsection
  