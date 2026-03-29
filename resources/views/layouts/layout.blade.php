<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'ShopHub')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .navbar {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .hero-title {
            font-size: 3rem;
            font-weight: 700;
        }

        .hero-subtitle {
            font-size: 1.2rem;
            opacity: 0.8;
        }

        .card {
            border: none;
            border-radius: 15px;
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .btn {
            border-radius: 10px;
        }

        footer {
            background: #111;
        }

        .feature-box {
            padding: 30px;
            border-radius: 15px;
            background: white;
            transition: 0.3s;
        }

        .feature-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body border-primary" data-bs-theme="dark">
        <div class="container">
            <a class="navbar-brand text-light" href="{{ route('home') }}"><span
                    class="fw-bolder fs-4 text-primary">ShopHub</span> Website</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home-products') }}">Products</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fa-solid fa-cart-arrow-down"></i> {{ count(session('cart', [])) }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end p-2 shadow-lg" aria-labelledby="navbarDropdown"
                            style="width: 320px; max-height: 400px; overflow-y: auto;">

                            @php($cart = session('cart', []))

                            @if (!empty($cart))
                                @foreach ($cart as $key => $value)
                                    <div class="d-flex align-items-center gap-2 p-2 border-bottom">

                                        <!-- Image -->
                                        <img src="{{ asset('storage/' . $value['image']) }}" class="rounded"
                                            style="width: 55px; height: 55px; object-fit: cover;" alt="product">

                                        <!-- Details -->
                                        <div class="flex-grow-1">
                                            <div class="fw-bold text-truncate" style="max-width: 180px;">
                                                {{ $value['name'] }}
                                            </div>

                                            <div class="small text-muted">
                                                Qty: <span class="fw-semibold">{{ $value['quantity'] }}</span>
                                            </div>

                                            <div class="small text-success fw-semibold">
                                                ${{ $value['price'] }}
                                            </div>
                                        </div>

                                    </div>
                                @endforeach

                                <!-- Footer -->
                                <div class="text-center mt-2">
                                    <a href="{{ route('cart') }}" class="btn btn-sm btn-primary w-100">
                                        View Cart
                                    </a>
                                </div>
                            @else
                                <!-- Empty state -->
                                <div class="text-center py-3">
                                    <i class="bi bi-cart-x fs-3 text-muted"></i>
                                    <p class="mb-0 text-muted">Your cart is empty</p>
                                </div>
                            @endif

                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home-about') }}">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home-contact') }}">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">Admin</a>
                    </li>
                    <li class="nav-item text-light">
                        @auth
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('register') }}" class="btn btn-outline-primary">Register</a>
                        @endauth
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    @yield('header')
    <div class="bg-light pb-5">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="text-light text-center py-5 pt-5">
        <h4 class="fw-bold">ShopHub</h4>
        <p class="text-white-50">Your trusted electronics store</p>

        <div class="my-3">
            <i class="fa-brands fa-facebook-f mx-2"></i>
            <i class="fa-brands fa-instagram mx-2"></i>
            <i class="fa-brands fa-twitter mx-2"></i>
        </div>

        <p class="text-white-50 mb-0">
            &copy; {{ date('Y') }} ShopHub. All rights reserved.
        </p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</body>
@yield('scripts')

</html>

