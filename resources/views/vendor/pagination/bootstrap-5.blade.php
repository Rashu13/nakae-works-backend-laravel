@if ($paginator->hasPages())

    <nav class="custom-pagination-wrapper">

        <div class="d-flex justify-content-between flex-fill d-sm-none">
            <ul class="pagination custom-pagination">

                {{-- Previous --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">‹</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link"
                           href="{{ $paginator->previousPageUrl() }}"
                           rel="prev">
                            ‹
                        </a>
                    </li>
                @endif

                {{-- Next --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link"
                           href="{{ $paginator->nextPageUrl() }}"
                           rel="next">
                            ›
                        </a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link">›</span>
                    </li>
                @endif

            </ul>
        </div>


        <div class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-between">

            {{-- Result Count --}}
            <div>
                <p class="small text-muted mb-0 custom-pagination-info">
                    Showing
                    <span>{{ $paginator->firstItem() }}</span>
                    to
                    <span>{{ $paginator->lastItem() }}</span>
                    of
                    <span>{{ $paginator->total() }}</span>
                    results
                </p>
            </div>


            {{-- Pagination --}}
            <div>

                <ul class="pagination custom-pagination mb-0">

                    {{-- Previous --}}
                    @if ($paginator->onFirstPage())

                        <li class="page-item disabled">
                            <span class="page-link">‹</span>
                        </li>

                    @else

                        <li class="page-item">
                            <a class="page-link"
                               href="{{ $paginator->previousPageUrl() }}"
                               rel="prev">
                                ‹
                            </a>
                        </li>

                    @endif


                    {{-- Pages --}}
                    @foreach ($elements as $element)

                        {{-- Dots --}}
                        @if (is_string($element))

                            <li class="page-item disabled">
                                <span class="page-link dots">
                                    {{ $element }}
                                </span>
                            </li>

                        @endif


                        {{-- Page Numbers --}}
                        @if (is_array($element))

                            @foreach ($element as $page => $url)

                                @if ($page == $paginator->currentPage())

                                    <li class="page-item active">
                                        <span class="page-link">
                                            {{ $page }}
                                        </span>
                                    </li>

                                @else

                                    <li class="page-item">
                                        <a class="page-link"
                                           href="{{ $url }}">
                                            {{ $page }}
                                        </a>
                                    </li>

                                @endif

                            @endforeach

                        @endif

                    @endforeach


                    {{-- Next --}}
                    @if ($paginator->hasMorePages())

                        <li class="page-item">
                            <a class="page-link"
                               href="{{ $paginator->nextPageUrl() }}"
                               rel="next">
                                ›
                            </a>
                        </li>

                    @else

                        <li class="page-item disabled">
                            <span class="page-link">›</span>
                        </li>

                    @endif

                </ul>

            </div>

        </div>

    </nav>

@endif
<style>
    .custom-pagination-wrapper {
    margin-top: 15px;
}

.custom-pagination {
    gap: 4px;
    margin: 0;
}

.custom-pagination .page-item {
    margin: 0;
}

.custom-pagination .page-link {
    width: 32px;
    height: 32px;

    padding: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    border: 1px solid #e5e5e5;
    border-radius: 6px !important;

    background: #fff;
    color: #555;

    font-size: 12px;
    font-weight: 500;

    box-shadow: none;

    transition: all 0.2s ease;
}

/* Hover */
.custom-pagination .page-item:not(.active):not(.disabled) .page-link:hover {
    background: #f4ecff;
    border-color: #7a00ff;
    color: #7a00ff;
}

/* Active */
.custom-pagination .page-item.active .page-link {
    background: #7a00ff !important;
    border-color: #7a00ff !important;
    color: #fff !important;

    box-shadow: 0 3px 8px rgba(122, 0, 255, 0.25);
}

/* Disabled */
.custom-pagination .page-item.disabled .page-link {
    background: #f8f8f8;
    border-color: #eeeeee;
    color: #b5b5b5;

    cursor: not-allowed;
}

/* Dots */
.custom-pagination .page-item.disabled .page-link.dots {
    background: transparent;
    border-color: transparent;
}

/* Result text */
.custom-pagination-info {
    font-size: 12px !important;
    color: #777 !important;
}

.custom-pagination-info span {
    color: #333;
    font-weight: 600;
}
</style>
