@extends('navbar')

@section('title', 'Platform Topup Game Termurah')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                    <div class="card-body">
                        <h6 class="card-title" style="font-size: 14px;">status:
                            @if ($invoiceyangdipilih->status == 'success')
                                <span class="badge badge-sm bg-success">success</span>
                            @elseif (($invoiceyangdipilih->status == 'paid'))
                                <span class="badge badge-sm bg-primary">paid</a>
                            @elseif (($invoiceyangdipilih->status == 'pending'))
                                <span class="badge badge-sm bg-light">pending</a>
                            @endif
                        </h6>
                        <div class="row">
                          <ul class="list-unstyled">
                            <li class="text-muted mt-1">
                                <h6>Invoice: {{$invoiceyangdipilih->invoice}} <button type="button" class="btn btn-dark ms-3" id="salinButton" data-clipboard-text="{{$invoiceyangdipilih->invoice}}">copy</button></h6>
                            </li>
                            <li><h6 style="font-size: 14px;">{{$invoiceyangdipilih->data}}</h6></li>
                            <li class="mt-1" ><h6 style="font-size: 12px;">{{$invoiceyangdipilih->waktu}}</h6></li>
                          </ul>
                          <div class="col-xl-10 mt-3">
                            <p>Item</p>
                          </div>
                          <div class="col-xl-2 mt-3">
                            <p class="float-end">Amount
                            </p>
                          </div>
                          <hr>
                          <div class="col-xl-10">
                            <p>
                            @foreach ($item as $item)
                                @if ($item->id == $invoiceyangdipilih->item_id)
                                {{$item->nama_item}}
                            </p>
                          </div>
                          <div class="col-xl-2">
                            <p class="float-end">
                                        Rp {{ number_format($item->harga_jual, 0, ',', '.') }}
                            </p>
                          </div>
                          <hr>
                          <div class="col-xl-10">
                            <p>fee</p>
                          </div>
                          <div class="col-xl-2">
                            <p class="float-end">
                                        Rp {{ number_format($invoiceyangdipilih->total_pembayaran - $item->harga_jual, 0, ',', '.') }}
                                    @endif
                                @endforeach
                            </p>
                          </div>
                          <hr>
                        </div>
                        <div class="row text-black">

                          <div class="col-xl-12">
                            <p class="float-end fw-bold">Total: Rp {{ number_format($invoiceyangdipilih->total_pembayaran, 0, ',', '.') }}
                            </p>
                          </div>
                        </div>
                    </div>
                  </div>
                  <!-- Tambahkan library Clipboard.js -->


            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>

<script>
    // Inisialisasi Clipboard.js
    new ClipboardJS('#salinButton');

    // Tampilkan notifikasi setelah berhasil menyalin
    var salinButton = document.getElementById('salinButton');
    salinButton.addEventListener('click', function() {
        alert('Nomor invoice berhasil disalin!');
    });

    // Fungsi untuk merefresh halaman setiap detik
    function refreshPage() {
        location.reload(); // Merefresh halaman
    }

    // Panggil fungsi untuk merefresh halaman setiap detik
    setInterval(refreshPage, 10000); // Refresh setiap 1000 milidetik (1 detik)
</script>

<style>
    @media (max-width: 768px) {
        .card {
            padding: 2rem;
        }

        .my-4 {
            font-size: 12px;
        }

        .col-xl-10, .col-xl-2 {
            width: 100%;
        }

        .float-end {
            text-align: right;
        }
    }
</style>

@endsection
