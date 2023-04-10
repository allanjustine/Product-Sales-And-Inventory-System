<div>
    <table class="table table-bordered">
        <thead class="bg-dark">
            <tr>
                <th>Transaction Code</th>
                <th>Buyer</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Payment Method</th>
                <th>Status</th>
                <th>Date Order</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td><strong>{{ $order->transaction_code }}</strong></td>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $order->product->product_name }}</td>
                    <td>&#8369;{{ $order->order_price }}</td>
                    <td>{{ $order->order_quantity }}</td>
                    <td>&#8369;{{ number_format($order->order_total_amount, 2, '.', ',') }}</td>
                    <td>{{ $order->order_payment_method }}</td>
                    @if ($order->order_status === 'Pending')
                        <td><span class="badge badge-warning">PENDING</span></td>
                    @else
                        <td><span class="badge badge-success"><i class="fa fa-solid fa-check"></i> PAID</span></td>
                    @endif
                    <td>{{ date_format($order->created_at, 'F j, Y g:i A') }}</td>
                </tr>
            @endforeach
            @if ($orders->count() === 0)
                <td colspan="8" class="text-center">No product sales yet.</td>
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
                <td colspan="4"></td>
            </tr>
        </tfoot>
    </table>
</div>
