<div class="text-center mt-5">
@if ($paginator->hasPages())
    <div class="pagination text-center">
        {{-- Previous Page Link --}}
        @if (!$paginator->onFirstPage())
            <a href="{{ $paginator->previousPageUrl() }}" class="rounded">&laquo;</a>
        @endif
        {{ "Page " . $paginator->currentPage() . "  of  " . $paginator->lastPage() }}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="rounded">&raquo;</a>
        @endif
    </div>
@endif
</div>
