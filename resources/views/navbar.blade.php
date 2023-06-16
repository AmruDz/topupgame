<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="/asset/css/templatemo.css">
    <link rel="stylesheet" href="/asset/css/custom.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="/asset/css/fontawesome.min.css">
</head>

<body>
    @section('sidebar')
    <nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container d-flex align-items-center">

            <a class="navbar-brand text-success logo h1 align-self-center" href="{{route('tampilanProduk')}}">
                Cztore
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="align-self-center" id="templatemo_main_nav">
                    <ul class="nav navbar-nav d-flex justify-content-end">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('tampilanProduk')}}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Check Invoice</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('about')}}">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('contact')}}">Contact</a>
                        </li>
                    </ul>
            </div>

        </div>
    </nav>
@show

    <section class="container py-5">
        <script>
            @if($errors->any())
                alert('{{ $errors->first() }}')
            @endif
        </script>
        @yield('content')
    </section>

    <footer class="bg-dark" id="tempaltemo_footer">
        <div class="container mb-5">
            <div class="row">

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-success border-bottom pb-3 border-light logo">Cztore</h2>
                    <p>
                        Platform Top Up Game Termurah di Indonesia. Penuhi Kebutuhan Game Mu Bersama Cztore Specialist Topup Game Online No.1 Murah , Aman , Terpercaya Dan Legal 100% (Open 24 Jam).
                    </p>
                </div>

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-light border-bottom pb-3 border-light">Layanan Lainnya</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        @foreach ($tampilanProduk as $a)
                        @if ($a->status === 'enable')
                            <li><a class="text-decoration-none" href="{{ route('transaksi.userPilihProduk', str_replace(' ', '-', $a->nama_produk)) }}">{{$a->nama_produk}}</a></li>
                        @endif
                        @endforeach
                    </ul>
                </div>

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-light border-bottom pb-3 border-light">Follow Us</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li>
                            <i class="fab fa-instagram fa-fw"></i>
                            <a class="text-decoration-none" href="#">Instagram Cztore</a>
                        </li>
                        <li>
                            <i class="fab fa-tiktok fa-fw"></i>
                            <a class="text-decoration-none" href="#">Tiktok Cztore</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="w-100 bg-black py-3">
            <div class="container">
                <div class="row pt-2">
                    <div class="col-12">
                        <p class="text-left text-light">
                            Copyright &copy; 2021 Czevelopers
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </footer>

    <!-- End Footer -->

    <!-- Start Script -->
    <script src="/asset/js/jquery-1.11.0.min.js"></script>
    <script src="/asset/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="/asset/js/bootstrap.bundle.min.js"></script>
    <script src="/asset/js/templatemo.js"></script>
    <script src="/asset/js/custom.js"></script>
    <!-- End Script -->
</body>

</html>
