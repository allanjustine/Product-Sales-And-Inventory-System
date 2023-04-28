<div>
    <div class="table-responsive card card-primary card-outline card-outline-tabs" id="product-table"
        style="height: 500px;">
        <div class="card-body">
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
                        <th>Location</th>
                        <th>Date Order
                        </th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td><strong>{{ $order->transaction_code }}</strong></td>
                            <td>{{ $order->user->name }} - {{ $order->user->phone_number }}</td>
                            <td>{{ $order->product->product_name }}</td>
                            <td>&#8369;{{ number_format($order->order_price, 2, '.', ',') }}</td>
                            <td>{{ number_format($order->order_quantity) }}PC(s)</td>
                            <td>&#8369;{{ number_format($order->order_price * $order->order_quantity, 2, '.', ',') }}
                            </td>
                            <td>{{ $order->order_payment_method }}</td>
                            <td>{{ $order->user_location }}</td>
                            <td>{{ date_format($order->created_at, 'F j, Y g:i A') }}</td>
                            <td>
                                @if ($order->order_status === 'Pending')
                                    <button wire:click="markAsDeliver({{ $order->id }})" class="btn btn-primary"><i
                                            class="fa-regular fa-truck-container"></i> Deliver</button>
                                @elseif ($order->order_status === 'To Deliver')
                                    <button wire:click="markAsDelivered({{ $order->id }})" class="btn btn-info"><i
                                            class="fa-solid fa-truck"></i> Delivered</button>
                                @elseif ($order->order_status === 'Complete')
                                    <button wire:click="markAsPaid({{ $order->id }})" class="btn btn-success"><i
                                            class="fa fa-solid fa-check"></i> Paid Complete</button>
                                @else
                                    <button wire:click="markAsPaid({{ $order->id }})" class="btn btn-success"><i
                                            class="fa fa-solid fa-check"></i> Paid Order</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    @if ($orders->count() === 0)
                        <td colspan="10" class="text-center">No orders yet.</td>
                        </td>
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
    </div>
</div>
