<div>
    <!-- Modal Cancel Order -->
    <div wire:ignore.self class="modal fade" id="cancelOrder" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Are you sure you want to remove this product?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="float-right" aria-hidden="true">&times;</span>
                    </button>
                </div>
                @if ($orderToCancel)
                <div class="modal-body">
                    Are you sure you want to cancel this product <strong class="text-capitalize">"{{
                        $orderToCancel->product->product_name }}"</strong> from <strong class="text-capitalize">{{
                        $orderToCancel->user->name }}&apos;s</strong> order?.
                </div>
                @endif
                <hr>
                <div class="mt-5 p-2">
                    <div class="form-group">
                        <label for="reason_for_cancellation">Reason for cancellation?</label>

                        <textarea wire:model.defer='reason_of_cancellation' class="form-control @error('reason_of_cancellation')
                            border-danger
                        @enderror" col="5" rows=5 placeholder="Reason for cancellation?">

                        </textarea>
                        @error('reason_of_cancellation')
                        <span class="text-danger text-md">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" wire:click="cancel()">
                        <div wire:loading><svg class="loading"></svg></div>&nbsp;<i class="fa-solid fa-trash"></i> Yes,
                        Cancel
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
