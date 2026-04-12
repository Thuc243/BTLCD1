@if ($paginator->hasPages())
<nav class="custom-pagination" aria-label="Phân trang">
    <div class="pagination-info">
        Hiển thị {{ $paginator->firstItem() }}–{{ $paginator->lastItem() }} trong {{ $paginator->total() }} sản phẩm
    </div>
    <ul class="pagination-list">
        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <li class="page-btn disabled" aria-disabled="true">
                <span><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg></span>
            </li>
        @else
            <li class="page-btn">
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg></a>
            </li>
        @endif

        {{-- Page Numbers --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="page-btn disabled dots"><span>{{ $element }}</span></li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-btn active"><span>{{ $page }}</span></li>
                    @else
                        <li class="page-btn"><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <li class="page-btn">
                <a href="{{ $paginator->nextPageUrl() }}" rel="next"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 6 15 12 9 18"/></svg></a>
            </li>
        @else
            <li class="page-btn disabled" aria-disabled="true">
                <span><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 6 15 12 9 18"/></svg></span>
            </li>
        @endif
    </ul>
</nav>
@endif
