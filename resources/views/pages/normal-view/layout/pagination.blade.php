<div>
    <ul class="pagination justify-content-center">
        @if ($paginator->onFirstPage())
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="page-link" aria-hidden="true">Previous</span>
            </li>
        @else
            <li class="page-item">
                <button class="page-link" wire:click="previousPage" rel="prev"
                    aria-label="@lang('pagination.previous')">Previous</button>
            </li>
        @endif

        @php
            $maxPages = 5;
            $halfMaxPages = floor($maxPages / 2);
            $startPage = $paginator->currentPage() - $halfMaxPages;
            $endPage = $paginator->currentPage() + $halfMaxPages;

            if ($startPage < 1) {
                $endPage += abs($startPage) + 1;
                $startPage = 1;
            }

            if ($endPage > $paginator->lastPage()) {
                $startPage -= $endPage - $paginator->lastPage();
                $endPage = $paginator->lastPage();
            }
        @endphp

        @if ($startPage > 1)
            <li class="page-item">
                <button class="page-link" wire:click="gotoPage(1)">1</button>
            </li>
            <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
        @endif

        @for ($i = $startPage; $i <= $endPage; $i++)
            @if ($i == $paginator->currentPage())
                <li class="page-item active" aria-current="page"><span class="page-link">{{ $i }}</span></li>
            @else
                <li class="page-item"><button class="page-link"
                        wire:click="gotoPage({{ $i }})">{{ $i }}</button></li>
            @endif
        @endfor

        @if ($endPage < $paginator->lastPage())
            <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
            <li class="page-item">
                <button class="page-link"
                    wire:click="gotoPage({{ $paginator->lastPage() }})">{{ $paginator->lastPage() }}</button>
            </li>
        @endif

        @if ($paginator->hasMorePages())
            <li class="page-item">
                <button class="page-link" wire:click="nextPage" rel="next"
                    aria-label="@lang('pagination.next')">Next</button>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="page-link" aria-hidden="true">Next</span>
            </li>
        @endif
    </ul>
</div>
