@if ($paginator->hasPages())
<div class="pagination-wrap">

    {{-- Previous --}}
    @if ($paginator->onFirstPage())
        <span class="page-link disabled" aria-disabled="true">←</span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" class="page-link">←</a>
    @endif

    {{-- Page numbers --}}
    @foreach ($elements as $element)
        @if (is_string($element))
            <span class="page-link disabled">{{ $element }}</span>
        @endif

        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <span class="page-link active" aria-current="page">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next --}}
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="page-link">→</a>
    @else
        <span class="page-link disabled" aria-disabled="true">→</span>
    @endif

</div>
@endif