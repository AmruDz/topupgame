@extends('navbar')

@section('title', 'Cztore: Topup Game Termurah')

@section('content')

<div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
    <ol class="carousel-indicators">
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="0" class="active"></li>
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="1"></li>
    </ol>
    <div class="carousel-inner pt-5">
        <div class="carousel-item active">
            <div class="container">
                <div class="row">
                    <div class="mx-auto col-md-10 col-lg-10 order-lg-last">
                        <img class="img-fluid d-block w-100" src="/asset/img/Game1-banner.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="container">
                <div class="row">
                    <div class="mx-auto col-md-10 col-lg-10 order-lg-last">
                        <img class="img-fluid d-block w-100" src="/asset/img/Game2-banner.jpg" alt="">
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
<section class="container py-5">
    <div class="row mt-4">
        @foreach ($tampilanProduk as $a)
            @if ($a->status === 'enable')
            <div class="col-lg-2 col-md-2 col-sm-3 col-3 p-0 mb-2 pb-1 me-3 mt-2 border bg-dark rounded text-center">
                    <a href="{{ route('transaksi.userPilihProduk', str_replace(' ', '-', $a->nama_produk)) }}" class="text-decoration-none text-dark">
                        <img src="{{ asset('storage/' . $a->foto) }}" class="rounded img-fluid border" style="max-width: 100%; height: auto;">
                        <span style="font-size: 12px;" class="h6">{{$a->nama_produk}}</span>
                    </a>
                </div>
            @endif
        @endforeach
    </div>
</section>
@endsection
