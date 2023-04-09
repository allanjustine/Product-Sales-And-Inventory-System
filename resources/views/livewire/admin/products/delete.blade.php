<div>
    <!-- Modal Delete Product -->
    <div wire:ignore.self class="modal fade" id="deleteProduct" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Are you sure you want to remove this product?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="float-right" aria-hidden="true">&times;</span>
                    </button>
                </div>
                @if ($productToDelete)
                    <div class="modal-body">
                        This product  <strong>"{{ $productToDelete->product_name }}"</strong> will be
                        removed to the table and will deleted permanently.
                    </div>
                @endif
                <div class="modal-footer">
                    <button class="btn btn-danger" wire:click="deleteProduct()">
                        <div wire:loading><svg class="loading"></svg></div>&nbsp;Yes, Remove
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>