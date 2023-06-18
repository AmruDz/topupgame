@extends('navbar')

@section('title', 'Platform Topup Game Termurah')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <form action="{{ route('search') }}" method="POST" class="d-flex">
                @csrf
                <input type="text" class="form-control me-2" placeholder="Telusuri Invoice...." name="invoice_number" required>
                <button type="submit" class="btn btn-success">Search</button>
            </form>
        </div>
    </div>

    @if($transaksi)
    <div class="row mt-5">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Status:
                        @if ($transaksi['status'] == 'success')
                            <span class="badge badge-sm bg-success">Success</span>
                        @elseif ($transaksi['status'] == 'pending')
                            <span class="badge badge-sm bg-light">Pending</span>
                        @else
                            <span class="badge badge-sm bg-primary">Paid</span>
                        @endif
                    </h6>
                    <ul class="list-unstyled">
                        <li class="text-muted mt-1">
                            <h6>Invoice: {{ $transaksi['invoice'] }} <button type="button" class="btn btn-dark ms-3" id="salinButton" data-clipboard-text="{{ $transaksi['invoice'] }}">Copy</button></h6>
                        </li>
                        <li><h6>{{ $transaksi['data'] }}</h6></li>
                        <li class="mt-1"><h6>{{ $transaksi['waktu'] }}</h6></li>
                    </ul>
                    <div class="row mt-3">
                        <div class="col-md-10">
                            <h6>Item</h6>
                        </div>
                        <div class="col-md-2">
                            <h6 class="float-end">Amount</h6>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-10">
                            <p>
                                @isset($item)
                                    @foreach ($item as $item)
                                        @if ($item['id'] == $transaksi['item_id'])
                                            {{ $item['nama_item'] }}
                                        @endif
                                    @endforeach
                                @endisset
                            </p>
                        </div>
                        <div class="col-md-2">
                            <p class="float-end">
                                Rp {{ number_format($item['harga_jual'], 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-10">
                            <p>Fee</p>
                        </div>
                        <div class="col-md-2">
                            <p class="float-end">
                                Rp {{ number_format($transaksi['total_pembayaran'] - $item['harga_jual'], 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <p class="float-end fw-bold">Total: Rp {{ number_format($transaksi['total_pembayaran'], 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
@endif
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
</script>
@endsection
