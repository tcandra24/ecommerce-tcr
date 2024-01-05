@if ($paginator->hasPages())
    <ul class="pagination toolbox-item">
        @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <a class="page-link page-link-btn" href="javascript:void(0)" aria-label="@lang('pagination.previous')"><i
                        class="icon-angle-left"></i></a>
            </li>
        @else
            <li class="page-item ">
                <a class="page-link page-link-btn" href="{{ $paginator->previousPageUrl() }}"
                    aria-label="@lang('pagination.previous')"><i class="icon-angle-left"></i></a>
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
                            <a class="page-link">{{ $page }}</a>
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
                <a class="page-link page-link-btn" href="{{ $paginator->nextPageUrl() }}"
                    aria-label="@lang('pagination.next')"><i class="icon-angle-right"></i></a>
            </li>
        @else
            <li class="page-item disabled">
                <a class="page-link page-link-btn" href="javascript:void(0)" aria-label="@lang('pagination.next')"><i
                        class="icon-angle-right"></i></a>
            </li>
        @endif
    </ul>
    </nav>
@endif
