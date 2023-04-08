<div>
    <div class="card col-md-6 offset-md-3 mt-5 shadow rounded">
        <div class="card-header">
            <h3 class="text-center">My Cart</h3>
        </div>
        <div class="card-body">
            <table class="table">
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
                    @foreach ($cartItems as $item)
                        <tr>
                            <td><img style="width: 70px; height: 70px; border-radius:50%;" src="{{ Storage::url($item->product->product_image) }}" alt=""></td>
                            <td>{{ $item->product->product_name }}</td>
                            <td>&#8369;{{ number_format($item->product->product_price, 2, '.', ',') }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>&#8369;{{ number_format($item->quantity * $item->product->product_price, 2, '.', ',') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
