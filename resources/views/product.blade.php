@extends('layouts.layout')
@section('title', 'Products')
@section('content')
    <!-- List a Product -->
    <div class="pt-5">
        <div class="card h-100 mx-auto" style="width: 50%">
            @if ($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
            @endif
            <div class="card-body d-flex flex-column">
                <div class="d-flex justify-content-between">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="fw-bold text-primary">${{ number_format($product->price, 2) }}</p>
                </div>
                <p class="card-text text-muted flex-grow-1">{{ Str::limit($product->description, 100) }}</p>
                <p class="text-light badge text-bg-primary align-self-start">{{ $product->category->name }}</p>
                <a href="{{ route('home') }}" class="btn btn-outline-primary mt-3">Back</a>
                <a href="{{ route('add.to.cart', $product) }}" class="btn btn-outline-secondary mt-3">Add To Cart</a>
            </div>
        </div>
    </div>
@endsection

