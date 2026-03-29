<!-- Display Basic Cart Info -->
@if (session('cart'))
    @if (!session('cart') || count(session('cart')) == 0)
        <div class="text-center py-5">
            <i class="fa-solid fa-cart-shopping fa-3x text-muted mb-3"></i>
            <h3>Your cart is empty</h3>
            <p class="text-muted">Start adding some products!</p>
            <a href="{{ route('home') }}" class="btn btn-primary mt-3">Shop Now</a>
        </div>
    @endif
    <div class="table-responsive pt-5 mx-auto" style="width: 80%">
        <table class="table align-middle bg-white shadow-sm rounded">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th style="width: 100px">Quantity</th>
                    <th>Sub Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach (session('cart') as $key => $details)
                    @php $total = $total + ($details['price'] * $details['quantity']); @endphp
                    <tr data-id="{{ $key }}">
                        <td>
                            <div class="row p-1">
                                <div class="col-md-2">
                                    <img src="{{ asset('storage/' . $details['image']) }}"
                                        style="width: 80px; height: 80px; object-fit: cover; border-radius: 10px;">
                                </div>
                                <div class="col-md-10">
                                    <h4>{{ $details['name'] }}</h4>
                                </div>
                            </div>
                        </td>
                        <td>${{ $details['price'] }}</td>
                        <td>
                            <input type="number" class="form-control text-center quantity"
                                style="width: 70px; margin: auto;" value="{{ $details['quantity'] }}" min="1">
                        </td>
                        <td>${{ $details['price'] * $details['quantity'] }}</td>
                        <td>
                            <a href="#" class="btn btn-outline-danger remove-from-cart"><i
                                    class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="5" class="text-end">
                        <h3 class="fw-bold text-success">Total: ${{ number_format($total, 2) }}</h3>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

@endif

