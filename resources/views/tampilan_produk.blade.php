@extends('navbar')

@section('title', '')

@section('content')
<section class="bg-light">
    <div class="container pb-5">
        <div class="row">
            <div class="col-lg-3 mt-5">
                <div class="card">
                    <img class="card-img img-fluid" src="{{ asset('storage/' . $pilihProduk->foto) }}" alt="Icon Produk">
                </div>
            </div>
            <div class="col-lg-9 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mt-2">1. Masukkan Data</h4>
                        <input type="text" class="ms-4 mt-3 mb-1 form-control" placeholder="Masukkan Data Game Anda" style="width: 250px">
                        <p class="mt-1 pt-1 pb-3"><small>Info: Untuk melihat data game anda, masuk pakai akun anda. Klik pada tombol profile di layar. Temukan data game anda. Masukan data game Anda di sini.</small></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 mt-2">
                <div class="card">
                    <div class="card-body">
                        <h4>{{$pilihProduk->nama_produk}}</h4>
                        <p class="mt-3">{{$pilihProduk->deskripsi}}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mt-2">2. Pilih Nominal Top Up</h4>
                        <ul>
                            @foreach ($tampilanItem as $a)
                                @if ($a->status === 'enable')
                                <div class="col-12 col-md-2 p-0 mt-3 mx-1 border bg-dark rounded text-center">
                                    <h5 class="mt-3 mb-3">{{$a->nama_item}}</h5>
                                    <h5 class="mt-3 mb-3">Rp  {{$a->harga_jual}}</h5>
                                </div>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mt-3">
                <div class="list-group shadow h-100">
                <input type="radio" class="visual-hidden" name="inlineRadioOptions" id="nominal-769" value="769" data-type="diamond" data-product_id="24">
                <label for="nominal-769" class="list-group-item h-100">
                <div class="row">
                <div class="col">
                <div class="row">
                <div class="col name-prod">9288 (7740+1548) Diamonds</div>
                 </div>
                <div class="row">
                <div class="col nominal-price">Rp 1.945.755</div>
                </div>
                </div>
                </div>
                </label>
                </div>
                </div>
            <div class="col-lg-4 mt-3">
                <div class="list-group shadow h-100">
                <input type="radio" class="visual-hidden" name="inlineRadioOptions" id="nominal-769" value="769" data-type="diamond" data-product_id="24">
                <label for="nominal-769" class="list-group-item h-100">
                <div class="row">
                <div class="col">
                <div class="row">
                <div class="col name-prod">9288 (7740+1548) Diamonds</div>
                 </div>
                <div class="row">
                <div class="col nominal-price">Rp 1.945.755</div>
                </div>
                </div>
                </div>
                </label>
                </div>
                </div>
        </div>
    </div>
</section>
    <script>
        $('#carousel-related-product').slick({
            infinite: true,
            arrows: false,
            slidesToShow: 4,
            slidesToScroll: 3,
            dots: true,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 3
                    }
                }
            ]
        });
    </script>
    <!-- End Slider Script -->
@endsection
