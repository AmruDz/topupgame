@extends('sidebar')

@section('title', 'Edit Produk')

@section('content')
<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('dashboard') }}">Admin</a></li>
          <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Produk</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Edit Produk</h6>
      </nav>
    </div>
</nav>
<div class="container my-4">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-12 mx-auto">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Edit Produk</h6>
                    </div>
                </div>
                <div class="card-body">
                    <form role="form" class="text-start" method="POST" action="{{route('produk.update', $produk->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="input-group input-group-outline my-3">
                            <input type="text" name="nama_produk" value="{{ $produk->nama_produk }}" class="form-control" required>
                        </div>
                        <div class="input-group input-group-outline my-3">
                            <select class="form-control" name="kategori_id" aria-label="Default select example" required>
                                @foreach ($kategori as $a)
                                <option value="{{ $a->id }}" @if($a->id == $produk->kategori_id) selected @endif>{{ $a->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group input-group-outline my-3">
                            <textarea name="deskripsi" class="form-control" required>{{ $produk->deskripsi }}</textarea>
                        </div>
                        <div class="my-3">
                            <p class="mb-2">Gambar saat ini:</p>
                            <img src="{{ asset('storage/' . $produk->foto) }}" alt="Foto Produk" class="img-fluid text-center" style="width: 10%; height: auto;">
                        </div>
                        <div class="input-group input-group-outline my-3">
                            <input type="file" name="foto" class="form-control" id="foto">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Update</button>
                            <a href="{{ route('produk') }}" class="btn bg-gradient-outline-primary w-100 my-4 mb-2">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
