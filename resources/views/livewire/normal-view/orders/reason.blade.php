<div>
    <!-- Modal Cancel Order -->
    <div wire:ignore.self class="modal fade" id="showReason{{ $order->id }}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Reason why the <strong class="text-capitalize">"{{ $order?->product->product_name }}"</strong>
                        order was cancelled.</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="float-right" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span>
                        {!! nl2br(e($order?->reason_of_cancellation)) !!}
                    </span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary form-control" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
