@extends('navbar')

@section('title', 'Platform Topup Game Termurah')

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
                        <span class="mt-3" style="font-size: 14px; font-family:sans-serif;"><b>{{$pilihProduk->deskripsi}}</b></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 mt-5">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('transaksi.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                        <h4 class="mt-2">1. Masukkan Data</h4>
                        @if ($pilihProduk->nama_produk === 'Mobile Legends')
                            <div class="row">
                                <div class="col-lg-4">
                                    <input type="number" class="mt-4 form-control" name="data" placeholder="Masukkan ID" required>
                                </div>
                                <div class="col-lg-3">
                                    <input type="number" class="mt-4 form-control" name="data" placeholder="Server" required>
                                </div>
                            </div>
                        @else
                            <input type="text" class="col-lg-12 mt-4 form-control" name="data" placeholder="Masukkan ID" style="width: 300px;" required>
                        @endif
                            <h6 class="mt-1 pt-1 mb-4" style="font-size: 12px; width: 600px;">Info: Untuk melihat data game anda, masuk pakai akun anda. Klik pada tombol profile di layar. Temukan data game anda. Masukkan data game Anda di sini.</h6>
                    </div>
                </div>
                <div class="card my-4">
                    <div class="card-body">
                        <h4 class="mt-2">2. Pilih Nominal Top Up</h4>
                        <div class="mb-4">
                            <div class="row mt-4">
                                @php
                                    $tampilanItemSorted = $tampilanItem->sortBy('nama_item', SORT_NATURAL);
                                @endphp
                                @foreach ($tampilanItemSorted->values()->all() as $item)
                                    @if ($item->status === 'enable')
                                        <div class="btn-group col-md-3 mb-3 rounded text-center">
                                            <input type="radio" class="btn-check" name="nama_item" id="{{ $item->nama_item }}" data-harga-jual="{{ $item->harga_jual }}" autocomplete="off">
                                            <label class="btn btn-outline-success" for="{{ $item->nama_item }}">
                                                <h6 class="pt-2" style="font-size: 12px;">{{ $item->nama_item }}</h6>
                                            </label>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="mt-2">3. Pilih Pembayaran</h4>
                        <div class="mb-4 mt-4">
                            @foreach ($tampilanPayment as $payment)
                                @if ($payment->status === 'enable')
                                    <div class="btn-group col-md-12 mb-3 rounded text-center">
                                        <input type="radio" class="btn-check" name="nama_payment" id="{{ $payment->nama_payment }}" data-fee="{{ $payment->fee }}" autocomplete="off">
                                        <label class="btn btn-outline-secondary text-start py-3 d-flex justify-content-between align-items-center" for="{{ $payment->nama_payment }}">
                                            <img class="card-img img-fluid" src="{{ asset('storage/' . $payment->foto) }}" alt="Icon Payment" style="width: 10%; height: auto;">
                                            <h6 class="pt-2" style="font-size: 12px;">
                                                <span class="nominal-payment" data-harga-jual="{{ $item->harga_jual }}" data-fee="{{ $payment->fee }}"></span>
                                            </h6>
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="card my-4">
                    <div class="card-body">
                        <h4 class="mt-2">4. Masukkan Nomor Whatsapp</h4>
                        <input type="number" class="col-lg-12 mt-4 form-control" placeholder="08XXXXXXX">
                        <input type="text" name="invoice" id="invoiceNumberInput">
                        <input type="text" name="data" id="dataInput">
                        <input type="text" name="waktu" id="current-time">
                        <input type="text" name="item_id" id="itemIdInput">
                        <input type="text" name="status" value="success">
                        <input type="text" name="total_pembayaran" id="totalPembayaranInput">
                        <button type="submit" class="btn btn-success col-lg-12 mt-3 mb-5" style="height: 45px;">Beli Sekarang</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function generateInvoiceNumber() {
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        const length = 16;
        let invoiceNumber = '';

        for (let i = 0; i < length; i++) {
            const randomIndex = Math.floor(Math.random() * characters.length);
            invoiceNumber += characters.charAt(randomIndex);
        }

        return invoiceNumber;
    }

    document.addEventListener('DOMContentLoaded', function() {
        const invoiceNumberInput = document.getElementById('invoiceNumberInput');
        invoiceNumberInput.value = generateInvoiceNumber();
    });

    var currentTimeInput = document.getElementById('current-time');

        function updateCurrentTime() {
            var currentTime = new Date().toLocaleString();
            currentTimeInput.value = currentTime;
        }

        setInterval(updateCurrentTime, 1000);

        updateCurrentTime();

        var inputsNamaItem = document.querySelectorAll('input[name="nama_item"]');
                    var inputsNamaPayment = document.querySelectorAll('input[name="nama_payment"]');
                    var nominalPaymentElements = document.querySelectorAll('.nominal-payment');

                    inputsNamaItem.forEach(function(inputNamaItem) {
                        inputNamaItem.addEventListener('change', updateTotalNominal);
                    });

                    inputsNamaPayment.forEach(function(inputNamaPayment) {
                        inputNamaPayment.addEventListener('change', updateTotalNominal);
                    });

                    function updateTotalNominal() {
                        var hargaJual = parseFloat(document.querySelector('input[name="nama_item"]:checked').dataset.hargaJual);
                        nominalPaymentElements.forEach(function(nominalPaymentElement) {
                            var fee = parseFloat(nominalPaymentElement.dataset.fee);
                            var totalNominal = hargaJual + (hargaJual * (fee / 100));
                            nominalPaymentElement.textContent = formatCurrency(totalNominal);
                        });
                    }

                    function formatCurrency(number) {
                        var formatter = new Intl.NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR',
                            minimumFractionDigits: 0,
                            maximumFractionDigits: 0
                        });

                        return formatter.format(number);
                    }

        document.getElementById('invoiceNumberInput').value = invoiceNumber;
        document.getElementById('dataInput').value = document.querySelector('input[name="data"]').value;
        document.getElementById('waktuInput').value = document.getElementById('current-time').value;
        document.getElementById('itemIdInput').value = document.querySelector('input[name="nama_item"]:checked').id;
        document.getElementById('totalPembayaranInput').value = document.querySelector('input[name="nama_payment"]:checked').dataset.fee;
    </script>
@endsection
