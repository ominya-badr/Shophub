@extends('layouts.layout')
@section('header')
    <!-- Hero Section -->
<<<<<<< HEAD
    <header class="d-flex align-items-center text-center text-white"
        style="
    min-height: 100vh;
    background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.8)),
    url('{{ asset('imgs/iphone15.jpg') }}') center/cover no-repeat;
">

        <div class="container">
            <h1 class="hero-title">
                Shop Smarter with <span class="text-primary">ShopHub</span>
            </h1>

            <p class="hero-subtitle mt-3 mb-4">
                Discover high-quality electronics at unbeatable prices.
            </p>

            <a href="{{ route('home-products') }}" class="btn btn-primary px-5 py-2">
                Shop Now
            </a>
=======
   <header class="d-flex justify-content-center align-items-center text-center"
        style="
        min-height: 100vh;
        background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.8)),
        url('{{ asset('imgs/iphone15.jpg') }}') center/cover no-repeat;
    ">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8">

                    <h1 class="text-light fw-bolder display-4 display-md-3 display-lg-2">
                        <span class="text-primary">ShopHub</span> Website
                    </h1>

                    <p class="text-white-50 mt-3 mb-4 fs-6 fs-md-5 fs-lg-4">
                        Modern Electronics Website
                    </p>

                    <a href="{{ route('home-about') }}" class="btn btn-primary px-4 py-2">
                        Learn More
                    </a>

                </div>
            </div>
>>>>>>> a4c64d6635120cc810560ef5da323c0d5603408c
        </div>
    </header>
@endsection

@section('content')
    <!-- Success Meassage -->
    @if (session('success'))
        <div class="alert alert-success mt-5 mx-3">
            {{ session('success') }}
        </div>
    @endif

    <!-- Featured Products -->

    <h2 class="text-center fw-bold mb-4 pt-5">🔥 Featured Products</h2>

    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @forelse ($featuredProducts as $product)
                <div class="col-lg-3 ">
                    <div class="card h-100">
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top"
                                alt="{{ $product->name }}">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-between">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="fw-bold text-primary">${{ number_format($product->price, 2) }}</p>
                            </div>
                            <p class="card-text text-muted flex-grow-1">{{ Str::limit($product->description, 100) }}</p>
                            <p class="text-light badge text-bg-primary align-self-start">{{ $product->category->name }}</p>
<<<<<<< HEAD
                            <a href="{{ route('home-product', $product) }}" class="btn btn-outline-primary mt-3">View
                                Details</a>
                            <a href="{{ route('add.to.cart', $product) }}" class="btn btn-outline-dark mt-2">Add to
=======
                            <a href="{{ route('home-product', $product) }}" class="btn btn-outline-primary mt-3">show</a>
                            <a href="{{ route('add.to.cart', $product) }}" class="btn btn-outline-secondary mt-3">Add To
>>>>>>> a4c64d6635120cc810560ef5da323c0d5603408c
                                Cart</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center">No products available for this category.</p>
            @endforelse
        </div>
    </div>

    <div class="container pt-5">
        <h2 class="text-center fw-bold mb-5">Why Choose Us</h2>

        <div class="row text-center g-4">
            <div class="col-md-4">
                <div class="feature-box">
                    <i class="fa-solid fa-truck fa-2x text-primary mb-3"></i>
                    <h5>Fast Delivery</h5>
                    <p>Quick and reliable shipping on all orders.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="feature-box">
                    <i class="fa-solid fa-shield-halved fa-2x text-primary mb-3"></i>
                    <h5>Secure Payment</h5>
                    <p>Your transactions are safe and encrypted.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="feature-box">
                    <i class="fa-solid fa-star fa-2x text-primary mb-3"></i>
                    <h5>Top Quality</h5>
                    <p>We offer only the best products.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
