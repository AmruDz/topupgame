@extends('sidebar')

@section('title', 'Manage Kategori')

@section('content')
<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{route('dashboard')}}">Admin</a></li>
          <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Kategori</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Kategori</h6>
      </nav>
    </div>
  </nav>
  <!-- End Navbar -->
  <div class="container-fluid py-4">
    <div class="row">
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
            <a href="{{ route('kategori.create') }}">
            <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">add</i>
                </div>
                <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Tambahkan</p>
                <h4 class="mb-0">Kategori Baru</h4>
                </div>
            </div>
            </div>
            </a>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-6">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Daftar Kategori</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No.</th>
                      <th class="text-start ps-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($kategori->reverse() as $a)
                        <tr>
                          <td class="align-middle text-center">
                              <p class="text-sm font-weight-bold mb-0">{{$loop->iteration}}</p>
                            </td>
                            <td class="align-middle text-start">
                            <p class="text-sm font-weight-bold mb-0">{{$a->nama_kategori}}</p>
                          </td>
                          <td class="align-middle text-center">
                            <p class="text-xs font-weight-bold mb-0">
                                <a class="btn btn-link text-white px-2 mb-0" href="{{ route('kategori.edit', $a->id) }}"><i class="material-icons text-sm me-2">edit</i>Edit</a>
                                <a class="btn btn-link text-primary px-2 mb-0" href="{{ route('kategori.destroy', $a->id) }}"><i class="material-icons text-sm me-2">delete</i>Delete</a>
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
