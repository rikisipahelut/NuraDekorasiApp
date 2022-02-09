
@extends('template.pengguna.sidebar')
@section('title','Pengguna')
@section('container')  
                    @if(session('status'))
                        <script>alert("{{session('status')}}")</script>
                    @endif
                    <div class="container-fluid">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        
                    <div class="row">
                        <div class="col">
                            <div class="card-deck">
                                @foreach($tb_barang as $barang)
                                <div class="card">
                                    <img src="/image/foto_barang/{{$barang->foto_barang}}" height="300" class="card-img-top" alt="...">
                                    <div class="card-body">
                                    <h5 class="card-title">{{$barang->nama_barang}}</h5>
                                    <!-- <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> -->
                                    </div>
                                    <!-- <div class="card-footer">
                                    <small class="text-muted">Last updated 3 mins ago</small>
                                    </div> -->
                                    <a href="#" class="btn btn-primary">Tambahkan ke Keranjang</a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                        
                        
                    </div>
@endsection