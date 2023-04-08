<div>
    <table class="table table-bordered">
        <thead class="bg-dark">
            <tr>
                <th>ID.</th>
                <th>Buyer</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Payment Method</th>
                <th>Location</th>
                <th>Date Order</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $order->product->product_name }}</td>
                    <td>&#8369;{{ number_format($order->order_price , 2, '.', ',') }}</td>
                    <td>{{ $order->order_quantity }}</td>
                    <td>&#8369;{{ number_format($order->order_price * $order->order_quantity , 2, '.', ',') }}</td>
                    <td>{{ $order->order_payment_method }}</td>
                    <td>{{ $order->user_location }}</td>
                    <td>{{ date_format($order->created_at, 'F j, Y g:i A') }}</td>
                    <td>
                        <button wire:click="markAsPaid({{ $order->id }})" class="btn btn-success mr-2"><i
                                class="fa fa-solid fa-check"></i> Paid Order</button>
                    </td>
                </tr>
            @endforeach
            @if ($orders->count() === 0)
                <td colspan="10" class="text-center">No orders yet.</td>
            @endif
        </tbody>
        <tfoot class="bg-dark">
            <tr>
                <td colspan="5">
                    <h5>Grand Total:</h5>
                </td>
                <td>
                    &#8369;{{ number_format($grandTotal, 2, '.', ',') }}
                </td>
                <td colspan="5"></td>
            </tr>
        </tfoot>
    </table>
</div>
