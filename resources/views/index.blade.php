@extends('navbar')

@section('title', 'Cztore: Topup Game Termurah')

@section('content')
<!-- Start Banner Hero -->
<div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
    <ol class="carousel-indicators">
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="0" class="active"></li>
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="1"></li>
        {{-- <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="2"></li> --}}
    </ol>
    <div class="carousel-inner pt-5">
        <div class="carousel-item active">
            <div class="container">
                <div class="row">
                    <div class="mx-auto col-md-10 col-lg-10 order-lg-last">
                        <img class="img-fluid" src="/asset/img/Game1-banner.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="container">
                <div class="row">
                    <div class="mx-auto col-md-10 col-lg-10 order-lg-last">
                        <img class="img-fluid" src="/asset/img/Game2-banner.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="prev">
        <i class="fas fa-chevron-left"></i>
    </a>
    <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="next">
        <i class="fas fa-chevron-right"></i>
    </a>
</div>
<!-- End Banner Hero -->


<!-- Start Categories of The Month -->
<section class="container py-5">
    <div class="row">
        @foreach ($tampilanProduk as $a)
            @if ($a->status === 'enable')
        <div class="col-12 col-md-2 p-0 mt-3 mx-1 border bg-dark rounded text-center">
            <a href="{{route('transaksi.userPilihProduk', $a->id)}}" class="text-decoration-none text-dark">
                <img src="{{ asset('storage/' . $a->foto) }}" class=" rounded img-fluid border">
            <h5 class="mt-3 mb-3">{{$a->nama_produk}}</h5>
            </a>
        </div>
            @endif
        @endforeach
    </div>
</section>
@endsection
