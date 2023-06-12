@extends('sidebar')

@section('title', 'Tambah Payment')

@section('content')
<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{route('dashboard')}}">Admin</a></li>
          <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Payment</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Tambah Payment</h6>
      </nav>
    </div>
  </nav>
    <div class="container my-4">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-12 mx-auto">
        <div class="card z-index-0 fadeIn3 fadeInBottom">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Tambahkan Payment</h6>
            </div>
          </div>
          <div class="card-body">
            <form role="form" class="text-start" method="POST" action="{{route('payment.store')}}" enctype="multipart/form-data">
                @csrf
              <div class="input-group input-group-outline my-3">
                <label class="form-label">Masukkan Nama Payment</label>
                <input type="text" name="nama_payment" class="form-control" required>
              </div>
              <div class="input-group input-group-outline my-3">
                <label class="form-label">Fee (%)</label>
                <input type="text" name="fee" class="form-control" required>
              </div>
              <div class="input-group input-group-outline my-3">
                <input type="file" name="foto" class="form-control" required>
              </div>
              <div class="text-center">
                <button type="submit" class="btn bg-gradient-success w-100 my-4 mb-2">Tambahkan</button>
                <a href="{{route('payment')}}" class="btn bg-gradient-outline-success w-100 my-4 mb-2">Batal</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
