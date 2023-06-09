@extends('sidebar')

@section('title', 'Manage Transaksi')

@section('content')
<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{route('dashboard')}}">Admin</a></li>
          <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Item</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Item</h6>
      </nav>
    </div>
  </nav>
  <!-- End Navbar -->
  <div class="container-fluid py-4">
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">assignment</i>
                </div>
                <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Total Item</p>
                <h4 class="mb-0">{{$banyakitem}}</h4>
                </div>
            </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">inventory</i>
                </div>
                <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Item Enable</p>
                <h4 class="mb-0">{{$itemenable}}</h4>
                </div>
            </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">content_paste_off</i>
                </div>
                <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Item Disable</p>
                <h4 class="mb-0">{{$itemdisable}}</h4>
                </div>
            </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <a href="{{route('item.create')}}">
            <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-warning shadow-warning text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">add</i>
                </div>
                <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Tambahkan</p>
                <h4 class="mb-0">Item Baru</h4>
                </div>
            </div>
            </div>
            </a>
        </div>
    </div>
  </div>
  <div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Daftar Item</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No.</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Produk</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Item</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Stock</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Harga Modal</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Harga Jual</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($item->reverse() as $a)
                        <tr>
                            <td class="align-middle text-center">
                                <p class="text-sm font-weight-bold mb-0">{{$loop->iteration}}</p>
                            </td>
                            <td class="align-middle text-center">
                                <p class="text-sm font-weight-bold mb-0">{{$a->produk->nama_produk}}</p>
                            </td>
                            <td class="align-middle text-center">
                                <p class="text-sm font-weight-bold mb-0">{{$a->nama_item}}</p>
                            </td>
                            <td class="align-middle text-center">
                                <p class="text-sm font-weight-bold mb-0">{{$a->stock}}</p>
                            </td>
                            <td class="align-middle text-center">
                                <p class="text-sm font-weight-bold mb-0">Rp {{number_format($a->harga_modal, 0, ',', '.')}}</p>
                            </td>
                            <td class="align-middle text-center">
                                <p class="text-sm font-weight-bold mb-0">Rp {{number_format($a->harga_jual, 0, ',', '.')}}</p>
                            </td>
                            <td class="align-middle text-center text-sm">
                                <span class="badge">
                                    @if ($a->status == 'enable')
                                        <a href="{{ route('item.disable', $a->id) }}" class="badge badge-sm bg-success">Enable</a>
                                    @else
                                        <a href="{{ route('item.enable', $a->id) }}" class="badge badge-sm bg-primary">Disable</a>
                                    @endif
                                </span>
                            </td>
                            <td class="align-middle text-center">
                                <p class="text-xs font-weight-bold mb-0">
                                    <a class="btn btn-link text-white px-3 mb-0" href="{{ route('item.edit', $a->id) }}"><i class="material-icons text-sm me-2">edit</i>Edit</a>
                                    <a class="btn btn-link text-primary px-3 mb-0" href="{{ route('item.destroy', $a->id) }}"><i class="material-icons text-sm me-2">delete</i>Delete</a>
                                </p>
                            </td>
                        </tr>
                        @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
    </div>
    </div>
@endsection
