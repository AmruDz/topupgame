@extends('sidebar')

@section('title', 'Master Cztore')

@section('content')
<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{route('dashboard')}}">Admin</a></li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Dashboard</h6>
      </nav>
    </div>
    <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
          <div class="input-group input-group-outline">
            <label class="form-label">Telusuri invoice</label>
            <input type="text" class="form-control">
          </div>
        </div>
      </div>
  </nav>
  <!-- End Navbar -->
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-header p-3 pt-2">
            <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
              <i class="material-icons opacity-10">receipt</i>
            </div>
            <div class="text-end pt-1">
              <p class="text-sm mb-0 text-capitalize">Transaksi Hari Ini</p>
              <h4 class="mb-0">{{$transaksiHariIni}}</h4>
            </div>
          </div>
          <hr class="dark horizontal my-0">
          <div class="card-footer p-3">
            @php
                $transactionsToday = 0;
                $transactionsYesterday = 0;
            @endphp

            @foreach ($dashboard as $item)
                @php
                    $transactionDate = \Carbon\Carbon::parse($item->created_at)->format('Y-m-d');
                    $currentDate = \Carbon\Carbon::now()->format('Y-m-d');

                    if ($transactionDate == $currentDate) {
                        $transactionsToday++;
                    } elseif ($transactionDate == \Carbon\Carbon::yesterday()->format('Y-m-d')) {
                        $transactionsYesterday++;
                    }
                @endphp
            @endforeach

            @php
                $percentageChange = 0;
                if ($transactionsYesterday > 0) {
                    $percentageChange = (($transactionsToday - $transactionsYesterday) / $transactionsYesterday) * 100;
                }
            @endphp

            <p class="mb-0">
                <span class="text-{{ ($percentageChange > 0) ? 'success' : 'primary' }} text-sm font-weight-bolder">
                    {{ number_format($percentageChange, 2) }} %
                </span>
                dari kemaren
            </p>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-header p-3 pt-2">
            <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
              <i class="material-icons opacity-10">receipt_long</i>
            </div>
            <div class="text-end pt-1">
              <p class="text-sm mb-0 text-capitalize">Transaksi Sukses</p>
              <h4 class="mb-0">{{$banyaktransaksi}}</h4>
            </div>
          </div>
          <hr class="dark horizontal my-0">
          <div class="card-footer p-3">
            @php
    $transactionsToday = 0;
@endphp

@foreach ($dashboard as $item)
    @php
        $transactionDate = \Carbon\Carbon::parse($item->created_at)->format('Y-m-d');
        $currentDate = \Carbon\Carbon::now()->format('Y-m-d');

        if ($transactionDate == $currentDate) {
            $transactionsToday++;
        }
    @endphp
@endforeach

<p class="mb-0">
    Transaksi hari ini
    @if ($transactionsToday > 0)
        <span class="text-success text-sm font-weight-bolder">+ {{ abs($transactionsToday) }}</span>
    @else
        <span class="text-sm font-weight-bolder">- {{ abs($transactionsToday) }}</span>
    @endif
</p>

          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-header p-3 pt-2">
            <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
              <i class="material-icons opacity-10">paid</i>
            </div>
            <div class="text-end pt-1">
              <p class="text-sm mb-0 text-capitalize">Profit Hari Ini</p>
                @php
                    $profitHariIni = 0;
                @endphp

                @foreach ($dashboard as $item)
                    @php
                        $transactionDate = \Carbon\Carbon::parse($item->created_at)->format('Y-m-d');
                        $currentDate = \Carbon\Carbon::now()->format('Y-m-d');

                        if ($transactionDate == $currentDate) {
                            $profitHariIni += $item->total_pembayaran - $item->item->harga_modal;
                        }
                    @endphp
                @endforeach
              <h4 class="mb-0">Rp {{ number_format($profitHariIni, 0, ',', '.') }}</h4>
            </div>
          </div>
          <hr class="dark horizontal my-0">
          <div class="card-footer p-3">
              @php
                  $profitHariIni = 0;
                  foreach ($dashboard as $itemHariIni) {
                      $profitHariIni += $itemHariIni->total_pembayaran - $itemHariIni->item->harga_modal;
                  }

                  $profitKemarin = 0;
                  // Menggunakan tanggal kemarin
                  $tanggalKemarin = \Carbon\Carbon::yesterday()->format('Y-m-d');
                  $dashboardKemarin = \App\Models\transaksi::whereDate('created_at', $tanggalKemarin)->get();
                  foreach ($dashboardKemarin as $itemKemarin) {
                      $profitKemarin += $itemKemarin->total_pembayaran - $itemKemarin->item->harga_modal;
                  }

                  if ($profitKemarin != 0) {
                      $percentage = (($profitHariIni - $profitKemarin) / $profitKemarin) * 100;
                  } else {
                      $percentage = 0;
                  }
              @endphp

              <p class="mb-0">
                @if ($percentage > 0)
                    <span class="text-success text-sm font-weight-bolder">+{{ number_format($percentage, 2) }}%</span>
                @elseif ($percentage < 0)
                    <span class="text-primary text-sm font-weight-bolder">{{ number_format($percentage, 2) }}%</span>
                @else
                    <span class="text-dark text-sm font-weight-bolder">{{ number_format($percentage, 2) }}%</span>
                @endif
                dari kemaren
              </p>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6">
        <div class="card">
          <div class="card-header p-3 pt-2">
            <div class="icon icon-lg icon-shape bg-gradient-warning shadow-warning text-center border-radius-xl mt-n4 position-absolute">
              <i class="material-icons opacity-10">account_balance</i>
            </div>
            <div class="text-end pt-1">
              <p class="text-sm mb-0 text-capitalize">Profit Keseluruhan</p>
                        @php
                            $totalprofit = 0;
                        @endphp
                        @foreach ($dashboard as $item)
                            @php
                                $totalprofit += $item->total_pembayaran - $item->item->harga_modal;
                            @endphp
                        @endforeach
              <h4 class="mb-0">Rp {{ number_format($totalprofit, 0, ',', '.') }}</h4>
            </div>
          </div>
          <hr class="dark horizontal my-0">
          <div class="card-footer p-3">
            @php
            $profitHariIni = 0;
            @endphp

            @foreach ($dashboard as $item)
                @php
                    $transactionDate = \Carbon\Carbon::parse($item->created_at)->format('Y-m-d');
                    $currentDate = \Carbon\Carbon::now()->format('Y-m-d');

                    if ($transactionDate == $currentDate) {
                        $profitHariIni += $item->total_pembayaran - $item->item->harga_modal;
                    }
                @endphp
            @endforeach
            <p class="mb-0">
                @php
                    $profitChangeSymbol = ($profitHariIni > 0) ? '+' : (($profitHariIni < 0) ? '-' : '');
                @endphp
                <span class="text-{{ ($profitChangeSymbol == '+') ? 'success' : 'primary' }} text-sm font-weight-bolder">
                    {{ $profitChangeSymbol }} Rp {{ number_format(abs($profitHariIni), 0, ',', '.') }}
                </span>
                {{ ($profitChangeSymbol != '') ? 'Hari Ini' : 'belum ada profit' }}
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-4">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Riwayat Transaksi</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No.</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Invoice</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Waktu</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Data</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Item</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Produk</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nomor Whatsapp</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Pembayaran</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Profit</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($dashboard->reverse() as $a)
                        <tr>
                          <td class="align-middle text-center">
                            <p class="text-sm font-weight-bold mb-0">{{$loop->iteration}}</p>
                          </td>
                          <td class="align-middle text-center">
                            <p class="text-sm font-weight-bold mb-0">{{$a->invoice}}</p>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-xs font-weight-bold mb-0">{{$a->waktu}}</span>
                          </td>
                          <td class="align-middle text-center">
                            <p class="text-sm font-weight-bold mb-0">{{$a->data}}</p>
                          </td>
                          <td class="align-middle text-center">
                            <p class="text-sm font-weight-bold mb-0">{{$a->item->nama_item}}</p>
                          </td>
                          <td class="align-middle text-center">
                            <p class="text-sm font-weight-bold mb-0">{{$a->item->produk->nama_produk}}</p>
                          </td>
                          <td class="align-middle text-center text-xs">
                            <span class="badge badge-xs bg-gradient-success">{{$a->status}}</span>
                          </td>
                          <td class="align-middle text-center">
                            <p class="text-sm font-weight-bold mb-0">{{$a->nomor_whatsapp}}</p>
                          </td>
                          <td class="align-middle text-center">
                            <p class="text-sm font-weight-bold mb-0">Rp {{ number_format($a->total_pembayaran, 0, ',', '.') }}</p>
                          </td>
                          <td class="align-middle text-center">
                            <p class="text-sm text-success font-weight-bold mb-0">Rp {{ number_format($a->total_pembayaran - $a->item->harga_modal, 0, ',', '.') }}</p>
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
</div>
@endsection
