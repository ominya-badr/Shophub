@extends('layouts.admin-layout')

@section('title', 'Products')

@section('content')

    <div class="d-flex justify-content-between align-items-center mt-3 mb-3">
        <h2 class="text-light m-0">Products</h2>

        <a href="{{ route('products.create') }}" class="btn btn-primary">
            + Add Product
        </a>
    </div>

    <!-- Success Message -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card bg-dark text-light border-0 shadow-sm rounded-4">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-dark table-hover align-middle">
                    <thead class="border-bottom border-secondary">
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>Qty</th>
                            <th>Featured</th>
                            <th>Image</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($products as $product)
                            <tr>

                                <!-- PRODUCT NAME -->
                                <td class="fw-semibold">
                                    {{ $product->name }}
                                </td>

                                <!-- PRICE -->
                                <td class="text-success fw-bold">
                                    ${{ $product->price }}
                                </td>

                                <!-- CATEGORY -->
                                <td>
                                    <span class="badge bg-secondary">
                                        {{ $product->category->name }}
                                    </span>
                                </td>

                                <!-- QUANTITY -->
                                <td>
                                    {{ $product->quantity }}
                                </td>

                                <!-- FEATURED -->
                                <td>
                                    @if ($product->is_featured)
                                        <span class="badge bg-success">Yes</span>
                                    @else
                                        <span class="badge bg-dark border">No</span>
                                    @endif
                                </td>

                                <!-- IMAGE -->
                                <td>
                                    @if ($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" class="rounded-3 border"
                                            width="60" height="60" style="object-fit: cover;">
                                    @else
                                        <span class="text-muted">No image</span>
                                    @endif
                                </td>

                                <!-- ACTIONS -->
                                <td class="text-end">

                                    <a href="{{ route('products.edit', $product) }}" class="btn btn-outline-warning btn-sm">
                                        Edit
                                    </a>

                                    <form action="{{ route('products.destroy', $product) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-outline-danger btn-sm"
                                            onclick="return confirm('Delete this product?')">
                                            Delete
                                        </button>
                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    No products found
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>
            </div>

        </div>
    </div>

@endsection

