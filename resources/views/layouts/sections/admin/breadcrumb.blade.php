<header class="page-header page-header-left-inline-breadcrumb">
    <h2 class="font-weight-bold text-6 text-uppercase">{{ Request::segment(2) }}</h2>
    <div class="right-wrapper">
        <ol class="breadcrumbs">
            <li><span>Home</span></li>
            <li><span>{{ Request::segment(2) }}</span></li>
            @if (Request::segment(3))
                <li><span>{{ Request::segment(3) }}</span></li>
            @endif

            @if (Request::segment(4))
                <li><span>{{ Request::segment(4) }}</span></li>
            @endif
        </ol>
    </div>
</header>
