@extends('template.pengguna.navbar')
@section('title','Beranda')
@section('container')
                        @if(session('status'))
                                <script>alert("{{session('status')}}")</script>
                        @endif
  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron" id="bg">
    <div class="container text-white text-center">
      <h1 class="display-3">NURA DEKORASI</h1>
      <p>Serahkan semua kebutuhan dekorasi anda pada kami</p>
      <h2>Gallery</h2>
      <!-- <p><a class="btn btn-outline-warning btn-lg" href="#" role="button"  data-toggle="modal" data-target="#daftar">Daftar Sekarang &raquo;</a></p> -->
    </div>
  </div>

  <div class="container">
    
    <!-- ========================== -->
    <div class="row">
      <div class="col">
      <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
          <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="/image/foto_barang/Screenshot 2021-03-22 140154-1616395324.png" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>First slide label</h5>
              <p>Some representative placeholder content for the first slide.</p>
            </div>
          </div>
          @foreach($tb_gallery as $gallery)
          <div class="carousel-item">
            <img src="/image/foto_barang/{{$gallery->foto_barang}}" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>{{$gallery->nama_barang}}</h5>
              <!-- <p>Some representative placeholder content for the third slide.</p> -->
            </div>
          </div>
          @endforeach
        </div>

        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
      </div>
    </div>
    <hr>

  </div> <!-- /container -->

    
         
   
  @endsection

