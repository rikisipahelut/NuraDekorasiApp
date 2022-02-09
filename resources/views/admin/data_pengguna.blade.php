
@extends('template.admin.sidebar')
@section('title','Data Pengguna')
@section('container')
                    <div class="container-fluid">
                        <h1 class="mt-4">Daftar Barang</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Daftar Barang</li>
                        </ol>                   
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Data Pengguna
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID Pengguna</th>
                                                <th>Nama</th>
                                                <th>Alamat</th>
                                                <th>No Telp</th>
                                                <th>Username</th>
                                                <th>Password</th>
                                                <th>Hak Akses</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID Pengguna</th>
                                                <th>Nama</th>
                                                <th>Alamat</th>
                                                <th>No Telp</th>
                                                <th>Username</th>
                                                <th>Password</th>
                                                <th>Hak Akses</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <tr>
                                                <td>001</td>
                                                <td>agus udin</td>
                                                <td>jln wr supratman</td>
                                                <td>081236740981</td>
                                                <td>agus</td>
                                                <td>1234</td>
                                                <td>1</td>
                                                <td><a href="" class="btn btn-danger">delete </a></td>
                                            </tr>
                                            <tr>
                                                <td>001</td>
                                                <td>agus ben</td>
                                                <td>jln hasanudin</td>
                                                <td>081236740982</td>
                                                <td>ben</td>
                                                <td>1234</td>
                                                <td>1</td>
                                                <td><a href="" class="btn btn-danger">delete </a></td>
                                            </tr>
                                            <tr>
                                                <td>001</td>
                                                <td>agus murti</td>
                                                <td>jln kenarok</td>
                                                <td>081236740983</td>
                                                <td>murti</td>
                                                <td>1234</td>
                                                <td>1</td>
                                                <td><a href="" class="btn btn-danger">delete </a></td>
                                            </tr>
                                            <tr>
                                                <td>001</td>
                                                <td>agus tri</td>
                                                <td>jln merak</td>
                                                <td>081236740984</td>
                                                <td>tri</td>
                                                <td>1234</td>
                                                <td>1</td>
                                                <td><a href="" class="btn btn-danger">delete </a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
@endsection
                