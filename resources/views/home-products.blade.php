@extends('layouts.layout')
@section('title', 'Products')

@section('content')

<!-- List All Products -->

<div class="px-5">
    <h2 class="text-center py-4">Our Products</h2>
    <div style="border-bottom:3px solid #0762ff;width:9%;margin: -29px auto 20px auto;"></div>

    <div class="text-center mb-4">
        @foreach ($categories as $category)
            <a href="{{ route('category.filter', $category->id) }}"
               class="btn btn-outline-dark m-1 rounded-5">
                {{ $category->name }}
            </a>
        @endforeach

        <a href="{{ route('home-products') }}"
           class="btn btn-outline-secondary m-1 rounded-5">
            Show All
        </a>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">

        @forelse ($products as $product)
            <div class="col-lg-3">
                <div class="card h-100">

                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}"
                             class="card-img-top"
                             alt="{{ $product->name }}">
                    @endif

                    <div class="card-body d-flex flex-column">

                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="fw-bold text-primary">
                                ${{ number_format($product->price, 2) }}
                            </p>
                        </div>

                        <p class="card-text text-muted flex-grow-1">
                            {{ Str::limit($product->description, 100) }}
                        </p>

                        <p class="text-light badge text-bg-primary align-self-start">
                            {{ $product->category->name }}
                        </p>

                        <a href="{{ route('home-product', $product) }}"
                           class="btn btn-outline-primary mt-3">
                            Show
                        </a>

                        <a href="{{ route('add.to.cart', $product) }}"
                           class="btn btn-outline-dark mt-3">
                            Add To Cart
                        </a>

                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">No products available for this category.</p>
        @endforelse

    </div>
</div>

@endsection

