<div>
    <div class="container">
        <h3 class="mt-4"><i class="fa-light fa-shopping-cart"></i> My Carts</h3>
        <hr>
        <div class="card col-md-12 mt-3 shadow rounded">
            <div class="card-body table-responsive">
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th>Product Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cartItems as $item)
                            <tr>
                                <td>
                                    @if (Storage::exists($item->product->product_image))
                                        <img style="width: 70px; height: 70px; border-radius:50%;"
                                            src="{{ Storage::url($item->product->product_image) }}" alt="">
                                    @else
                                        <img style="width: 70px; height: 70px; border-radius:50%;"
                                            src="{{ $item->product->product_image }}" alt="">
                                    @endif
                                </td>
                                <td class="text-capitalize">{{ $item->product->product_name }}</td>
                                <td>&#8369;{{ number_format($item->product->product_price, 2, '.', ',') }}</td>
                                <td>x{{ $item->quantity }}PC(s)</td>
                                <td>&#8369;{{ number_format($item->quantity * $item->product->product_price, 2, '.', ',') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">
                                    <h5><i class="fa-regular fa-cart-xmark" style="font-size: 50px;"></i><br>
                                        Your cart is empty. <a href="/products">Click
                                            here to add an product to cart.</a></h5>
                                </td>
                            </tr>
                        @endforelse

                        <tr>
                            <td colspan="5" class="text-end">
                                <strong>Grand total:
                                    &#8369;{{ number_format(
                                        $cartItems->sum(function ($cart) {
                                            return $cart->product->product_price * $cart->quantity;
                                        }),
                                        2,
                                    ) }}
                                </strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
