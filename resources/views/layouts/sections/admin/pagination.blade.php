@if ($paginator->hasPages())
    <div class="col-lg-auto order-2 order-lg-1">
        <p class="text-center text-lg-left mb-0">Showing {{ $paginator->firstItem() }}-{{ $paginator->lastItem() }} of
            {{ $paginator->total() }} results</p>
    </div>
    <div class="col-lg-auto order-1 order-lg-2 mb-3 mb-lg-0">
        <nav aria-label="Page navigation example">
            <ul
                class="pagination pagination-modern pagination-modern-spacing justify-content-center justify-content-lg-start mb-0">
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled">
                        <a class="page-link prev" href="javascript:void(0)" aria-label="@lang('pagination.previous')">
                            <span><i class="fas fa-chevron-left" aria-label="@lang('pagination.previous')"></i></span>
                        </a>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link prev" href="{{ $paginator->previousPageUrl() }}"
                            aria-label="@lang('pagination.previous')">
                            <span><i class="fas fa-chevron-left" aria-label="@lang('pagination.previous')"></i></span>
                        </a>
                    </li>
                @endif

                @foreach ($elements as $element)
                    @if (is_string($element))
                        <li class="page-item disabled">
                            <a class="page-link" href="#" aria-disabled="true">{{ $element }}</a>
                        </li>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active" aria-current="page">
                                    <span class="page-link">{{ $page }}</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link next" href="{{ $paginator->nextPageUrl() }}" aria-label="@lang('pagination.next')">
                            <span><i class="fas fa-chevron-right" aria-label="@lang('pagination.next')"></i></span>
                        </a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <a class="page-link next" href="javascript:void(0)" aria-label="@lang('pagination.next')">
                            <span><i class="fas fa-chevron-right" aria-label="@lang('pagination.next')"></i></span>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
@endif
