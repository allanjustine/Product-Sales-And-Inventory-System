<div>
    @include('livewire.normal-view.orders.cancel-order')
    <div class="container">
        <h3 class="mt-4"><i class="fa-light fa-bag-shopping"></i> My Orders</h3>
        <hr>
        <div class="col-md-12">

            <div class="card card-primary card-outline card-outline-tabs" style="height: 100%">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="schedulesTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="today-list" data-toggle="pill" href="#pending" role="tab"
                                aria-controls="custom-tabs-four-home" aria-selected="true">PENDING
                                ORDERS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="requests-list" data-toggle="pill" href="#recent" role="tab"
                                aria-controls="custom-tabs-four-profile" aria-selected="false">RECENT ORDERS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="cancelled-list" data-toggle="pill" href="#cancelled" role="tab"
                                aria-controls="custom-tabs-four-profile" aria-selected="false">CANCELLED ORDERS</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="pending" role="tabpanel"
                            aria-labelledby="custom-tabs-four-home-tab">
                            @foreach ($pendings as $order)
                                <div class="col-md-12">
                                    <div class="info-box elevation-3">
                                        <span class="info-box-icon"><img
                                                src="{{ Storage::url($order->product->product_image) }}"
                                                alt="{{ $order->product->product_name }}"></span>
                                        <div class="info-box-content">
                                            <strong class="info-box-text">{{ $order->product->product_name }}</strong>
                                            <span
                                                class="info-box-text">&#8369;{{ number_format($order->product->product_price, 2, '.', ',') }}</span>
                                            <span
                                                class="info-box-text">x{{ number_format($order->order_quantity) }}PC(s)</span>
                                            <span
                                                class="info-box-text">{{ date_format($order->created_at, 'F j, Y g:i A') }}</span>
                                            @if ($order->order_status === 'Paid')
                                                <span class="info-box-text badge badge-success align-self-start"><i
                                                        class="fa fa-solid fa-check"></i> PAID</span>
                                            @else
                                                <span
                                                    class="info-box-text badge badge-warning align-self-start">PENDING</span>
                                            @endif
                                            <span
                                                class="info-box-text"><strong>{{ $order->transaction_code }}</strong></span>
                                            <span class="info-box-number">Total:
                                                &#8369;{{ number_format($order->order_total_amount, 2, '.', ',') }}</span>
                                        </div>
                                        <span>
                                            @if ($order->order_status === 'Pending')
                                                <a href="" class="btn btn-danger" data-toggle="modal"
                                                    data-target="#cancel" wire:click="toCancel({{ $order->id }})">
                                                    <i class="fa-solid fa-xmark"></i>
                                                    Cancel Order
                                                </a>
                                            @else
                                                <a href="" class="btn btn-warning">
                                                    <i class="fa-solid fa-eye"></i>
                                                    View
                                                </a>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                            @if ($pendings->count() === 0)
                                <span class="text-center">
                                    <h5><i class="fa-regular fa-xmark-to-slot" style="font-size: 50px;"></i><br>
                                        No orders yet. <a href="/products">Click
                                            here to order</a></h5>
                                </span>
                            @endif
                            <strong>Grand Total: &#8369;{{ number_format($grandTotalPending, 2, '.', ',') }}</strong>
                        </div>
                        <div class="tab-pane fade" id="recent" role="tabpanel"
                            aria-labelledby="custom-tabs-four-home-tab">
                            @foreach ($recents as $order)
                                <div class="col-md-12">
                                    <div class="info-box elevation-3">
                                        <span class="info-box-icon">
                                            <img src="{{ Storage::url($order->product->product_image) }}"
                                                alt="{{ $order->product->product_name }}">
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">{{ $order->product->product_name }}</span>
                                            <span
                                                class="info-box-text">&#8369;{{ number_format($order->product->product_price, 2, '.', ',') }}</span>
                                            <span
                                                class="info-box-text">x{{ number_format($order->order_quantity) }}PC(s)</span>
                                            <span
                                                class="info-box-text">{{ date_format($order->created_at, 'F j, Y g:i A') }}</span>
                                            @if ($order->order_status === 'Paid')
                                                <span class="info-box-text badge badge-success align-self-start"><i
                                                        class="fa fa-solid fa-check"></i> PAID</span>
                                            @else
                                                <span
                                                    class="info-box-text badge badge-warning align-self-start">PENDING</span>
                                            @endif
                                            <span
                                                class="info-box-text"><strong>{{ $order->transaction_code }}</strong></span>
                                            <span class="info-box-number">Total:
                                                &#8369;{{ number_format($order->order_total_amount, 2, '.', ',') }}</span>
                                        </div>
                                        <span>
                                            @if ($order->order_status === 'Pending')
                                                <a href="" class="btn btn-danger" data-toggle="modal"
                                                    data-target="#cancel" wire:click="toCancel({{ $order->id }})">
                                                    <i class="fa-solid fa-xmark"></i>
                                                    Cancel Order
                                                </a>
                                            @else
                                                <a href="" class="btn btn-warning">
                                                    <i class="fa-solid fa-eye"></i>
                                                    View
                                                </a>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                            @if ($recents->count() === 0)
                                <span class="text-center">
                                    <h5><i class="fa-regular fa-xmark-to-slot" style="font-size: 50px;"></i><br>
                                        No orders yet. <a href="/products">Click
                                            here to order</a></h5>
                                </span>
                            @endif
                            <strong>Grand Total: &#8369;{{ number_format($grandTotalRecent, 2, '.', ',') }}</strong>
                        </div>

                        <div class="tab-pane fade" id="cancelled" role="tabpanel"
                            aria-labelledby="custom-tabs-four-home-tab">
                            @foreach ($pendings as $order)
                                <div class="col-md-12">
                                    <div class="info-box elevation-3">
                                        <span class="info-box-icon"><img
                                                src="{{ Storage::url($order->product->product_image) }}"
                                                alt="{{ $order->product->product_name }}"></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">{{ $order->product->product_name }}</span>
                                            <span
                                                class="info-box-text">&#8369;{{ number_format($order->product->product_price, 2, '.', ',') }}</span>
                                            <span
                                                class="info-box-text">x{{ number_format($order->order_quantity) }}PC(s)</span>
                                            <span
                                                class="info-box-text">{{ date_format($order->created_at, 'F j, Y g:i A') }}</span>
                                            <span class="info-box-number">Total:
                                                &#8369;{{ number_format($order->order_total_amount, 2, '.', ',') }}</span>
                                        </div>
                                        <span>
                                            @if ($order->order_status === 'Pending')
                                                <a href="" class="btn btn-danger" data-toggle="modal"
                                                    data-target="#cancel" wire:click="toCancel({{ $order->id }})">
                                                    <i class="fa-solid fa-xmark"></i>
                                                    Cancel Order
                                                </a>
                                            @else
                                                <a href="" class="btn btn-warning">
                                                    <i class="fa-solid fa-eye"></i>
                                                    View
                                                </a>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                            @if ($pendings->count() === 0)
                                <span class="text-center">
                                    <h5><i class="fa-regular fa-xmark-to-slot" style="font-size: 50px;"></i><br>
                                        No orders yet. <a href="/products">Click
                                            here to order</a></h5>
                                </span>
                            @endif
                            <strong>Grand Total: &#8369;{{ number_format($grandTotalRecent, 2, '.', ',') }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
