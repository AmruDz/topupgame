@extends('navbar')

@section('title', '')

@section('content')
<section class="bg-light">
    <div class="container py-2 px-5">
        <div class="row">
            <div class="col-lg-3 mt-5">
                <div class="card">
                    <img class="card-img img-fluid" src="{{ asset('storage/' . $pilihProduk->foto) }}" alt="Icon Produk">
                </div>
                <div class="card mt-4">
                    <div class="card-body">
                        <h4>{{$pilihProduk->nama_produk}}</h4>
                        <p class="mt-3">{{$pilihProduk->deskripsi}}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mt-2">1. Masukkan Data</h4>
                        <input type="text" class="col-lg-12 mt-4 form-control" placeholder="Masukkan Data Game Anda" style="width: 300px; height: 50px;">
                        <p class="mt-1 pt-1 mb-4"><small>Info: Untuk melihat data game anda, masuk pakai akun anda. Klik pada tombol profile di layar. Temukan data game anda. Masukan data game Anda di sini.</small></p>
                    </div>
                </div>
                <div class="card my-4">
                    <div class="card-body">
                        <h4 class="mt-2">2. Pilih Nominal Top Up</h4>
                        <div class="mb-5">
                            <div class="row mt-4 ps-2">
                                <style>
                                    .item {
                                        width: 280px;
                                        padding: 10px;
                                        margin: 10px;
                                        border: 1px solid #000;
                                        background-color: #333;
                                        color: #fff;
                                        cursor: pointer;
                                    }

                                    .item:hover {
                                        background-color: #555;
                                    }

                                    .item.selected {
                                        border-color: #f00;
                                        background-color: #777;
                                    }
                                </style>
                                @php
                                    $tampilanItemSorted = $tampilanItem->sortBy('nama_item', SORT_NATURAL);
                                @endphp
                                @foreach ($tampilanItemSorted->values()->all() as $a)
                                    @if ($a->status === 'enable')
                                        <div class="col-lg-4 mx-1 py-2 mb-2 border bg-dark rounded text-center item" style="width:280px;">
                                            <h6 class="my-2">{{$a->nama_item}}</h6>
                                        </div>
                                    @endif
                                @endforeach
                                @push('scripts')
                                    <script>
                                        // Tambahkan script JavaScript berikut ini
                                        let items = document.querySelectorAll('.item');

                                        items.forEach(item => {
                                            item.addEventListener('click', () => {
                                                items.forEach(el => el.classList.remove('selected'));
                                                item.classList.add('selected');
                                            });
                                        });
                                    </script>
                                @endpush
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="mt-2">3. Pilih Pembayaran</h4>
                        <div class="mb-5">
                            {{-- @foreach ($tampilanItem as $a) --}}
                                    {{-- @if ($a->status === 'enable') --}}
                                        <div class="col-lg-12 mt-4 pt-4 pb-3 border bg-dark rounded text-start">
                                            <h5 class="ms-4 my-2">Rp</h5>
                                            <hr class="mx-3">
                                            <span class="ms-4">Bayar Dengan <b>Cztore Coin</b></span>
                                        </div>
                                    {{-- @endif --}}
                                {{-- @endforeach --}}
                        </div>
                    </div>
                </div>
                <div class="card my-4">
                    <div class="card-body">
                        <h4 class="mt-2">4. Masukkan Nomor Whatsapp</h4>
                        <input type="number" class="col-lg-12 mt-4 form-control" placeholder="08XXXXXXX" style="height: 50px;">
                        <button class="btn btn-success col-lg-12 mt-3 mb-5" style="height: 50px;">Beli Sekarang</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
