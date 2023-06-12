@extends('navbar')

@section('title', 'Invoice')

@section('content')
<div class="card col-lg-12 m-5 p-5">
    <div class="card-body mx-5">
      <div class="container px-5">
        <h6 class="my-4" style="font-size: 14px;">status:</h6>
        <div class="row">
          <ul class="list-unstyled">
            <li><h6 style="font-size: 14px;">12345678 1234</h6></li>
            <li class="text-muted mt-1"><h6>Invoice: <span id="invoice">12345 <button class="salin-teks btn btn-dark" data-teks="invoice"></button></span></h6></li>
            <li class="mt-1" ><h6 style="font-size: 10px;">2023-06-10 22:10:18</h6></li>
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
            <p>86 Diamonds</p>
          </div>
          <div class="col-xl-2">
            <p class="float-end">Rp 199.00
            </p>
          </div>
          <hr>
        </div>
        <div class="row">
          <div class="col-xl-10">
            <p>fee</p>
          </div>
          <div class="col-xl-2">
            <p class="float-end">Rp 10.00
            </p>
          </div>
          <hr style="border: 2px solid black;">
        </div>
        <div class="row text-black">

          <div class="col-xl-12">
            <p class="float-end fw-bold">Total: Rp 10.00
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        var buttons = document.querySelectorAll('.salin-teks');

        buttons.forEach(function(button) {
            button.addEventListener('click', function() {
                var teks = this.getAttribute('data-teks');

                navigator.clipboard.writeText(teks).then(function() {
                    console.log('Teks berhasil disalin: ' + teks);
                }).catch(function(error) {
                    console.error('Teks gagal disalin: ', error);
                });
            });
        });
    });
</script>
@endsection
