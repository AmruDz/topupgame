@extends('navbar')

@section('title', 'Platform Topup Game Termurah')

@section('content')
<section class="bg-light">
    <form action="{{ route('transaksi.store') }}" method="post" class="container p-5">
        @csrf
        <div class="row">
            <div class="col-lg-3 mt-5">
                <div class="card">
                    <div class="card-body">
                        <img class="card-img img-fluid" src="{{ asset('storage/' . $pilihProduk->foto) }}" alt="Icon Produk">
                        <h4 class="mt-3">{{$pilihProduk->nama_produk}}</h4>
                        <span class="mt-3" style="font-size: 14px; font-family:sans-serif;"><b>{{$pilihProduk->deskripsi}}</b></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mt-2">1. Masukkan Data</h4>
                        @if ($pilihProduk->nama_produk === 'Mobile Legends')
                            <div class="row">
                                <div class="col-lg-4">
                                    <input type="number" class="mt-4 form-control" name="data" placeholder="Masukkan ID" required>
                                </div>
                                <div class="col-lg-3">
                                    <input type="number" class="mt-4 form-control" name="data" placeholder="Server" required>
                                </div>
                                @else
                                <input type="text" class="col-lg-12 mt-4 form-control" name="data" placeholder="Masukkan ID" style="width: 300px;" required>
                                @endif
                                <h6 class="mt-3 mb-4" style="font-size: 12px;">Info: Untuk melihat data game anda, masuk pakai akun anda. Klik pada tombol profile di layar. Temukan data game anda. Masukkan data game Anda di sini.</h6>
                            </div>
                    </div>
                </div>
                <div class="card my-4">
                    <div class="card-body">
                        <h4 class="mt-2">2. Pilih Nominal Top Up</h4>
                            <div class="mb-4">
                            @php
                                $tampilanItemSorted = $tampilanItem->sortBy('nama_item', SORT_NATURAL);
                            @endphp
                                <div class="row mt-4">
                                    @foreach ($tampilanItemSorted->values()->all() as $item)
                                        @if ($item->status === 'enable')
                                            <div class="btn-group col-lg-3 mb-4">
                                                <input type="radio" class="btn-check" name="item_id" id="{{ $item->id }}" data-harga-jual="{{ $item->harga_jual }}" value="{{ $item->id }}" autocomplete="off">
                                                <label class="btn btn-outline-success" for="{{ $item->id }}">
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
                                    <input type="radio" class="btn-check" name="total_pembayaran" value="{{ $item->harga_jual * ($payment->fee / 100) }}" id="{{ $payment->nama_payment }}" data-fee="{{ $payment->fee }}" autocomplete="off">
                                    <label class="btn btn-outline-secondary text-start py-3 d-flex justify-content-between align-items-center" for="{{ $payment->nama_payment }}">
                                        <img class="card-img img-fluid" src="{{ asset('storage/' . $payment->foto) }}" alt="Icon Payment" style="width: 10%; height: auto;">
                                        <h6 class="pt-2" style="font-size: 12px;">
                                            <span class="nominal-payment" data-fee="{{ $payment->fee }}"></span>
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
                        <input type="number" class="col-lg-12 mt-4 form-control" name="nomor_whatsapp" placeholder="08XXXXXXX">
                        <input type="hidden" name="invoice" id="invoiceNumberInput">
                        <input type="hidden" name="waktu" id="current-time">
                        <input type="hidden" name="status" value="success">
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

            var inputsNamaItem = document.querySelectorAll('input[name="item_id"]');
                    var inputsNamaPayment = document.querySelectorAll('input[name="nama_payment"]');
                    // var nominalPaymentElements = document.querySelectorAll('.nominal-payment');
                    var inputsNamaPayment = document.querySelectorAll('input[name="total_pembayaran"]');
            var nominalPaymentElements = document.querySelectorAll('.nominal-payment');

            // inputsNamaPayment.forEach(function(inputNamaPayment, index) {
            //     inputNamaPayment.addEventListener('change', function() {
            //         var selectedNamaPayment = this;
            //         var totalPembayaranInput = document.getElementById('totalPembayaranInput');

            //         if (selectedNamaItem && selectedNamaPayment) {
            //             var hargaJual = selectedNamaItem.getAttribute('data-harga-jual');
            //             var fee = selectedNamaPayment.getAttribute('data-fee');
            //             var totalPembayaran = parseInt(hargaJual) + parseInt(fee);

            //             totalPembayaranInput.value = totalPembayaran;

            //             nominalPaymentElements.forEach(function(nominalPaymentElement, index) {
            //                 if (index === selectedNamaPayment) {
            //                     nominalPaymentElement.innerText = totalPembayaran;
            //                 }
            //             });
            //         }
            //     });
            // });

                    inputsNamaItem.forEach(function(inputNamaItem) {
                        inputNamaItem.addEventListener('change', updateTotalNominal);
                    });

                    inputsNamaPayment.forEach(function(inputNamaPayment) {
                        inputNamaPayment.addEventListener('change', updateTotalNominal);
                    });

                    function updateTotalNominal() {
                        var hargaJual = parseFloat(document.querySelector('input[name="item_id"]:checked').dataset.hargaJual);
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

        document.getElementById('itemIdInput').value = document.querySelector('input[name="item_id"]:checked').id;
        document.getElementById('totalPembayaranInput').value = document.querySelector('input[name="nama_payment"]:checked').dataset.fee;
    </script>
@endsection
