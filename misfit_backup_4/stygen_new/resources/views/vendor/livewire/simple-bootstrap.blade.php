<div>
    @if ($paginator->hasPages())
        <nav>
            <ul class="pagination">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">@lang('pagination.previous')</span>
                    </li>
                @else
                    <li class="page-item">
                        <a href="#" class="page-link" dusk="previousPage" onclick="reloadPage('{{ $paginator->previousPageUrl() }}')">@lang('pagination.previous')</a>
                    </li>
                @endif

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a href="#" class="page-link" dusk="nextPage" onclick="reloadPage('{{ $paginator->nextPageUrl() }}')">@lang('pagination.next')</a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">@lang('pagination.next')</span>
                    </li>
                @endif
            </ul>
        </nav>
    @endif

    <script>
        function reloadPage(url) {
            console.log(url);
            window.location.href = url;
        }
    </script>
</div>
