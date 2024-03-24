@if ($paginator->hasPages())
<nav>
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        <li class="disabled px-2 mx-3" aria-disabled="true" aria-label="@lang('pagination.previous')">
            <x-left-icon />
        </li>
        @else
        <li>
            <a href="{{ $paginator->previousPageUrl() }}" class="px-2 mx-3" rel="prev" aria-label="@lang('pagination.previous')"> <x-left-icon />
            </a>
        </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
        <li class="disabled" aria-disabled="true"><span>{{ $element }} </span></li>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <li class="active text-danger " aria-current="page"><span>{{ $page }}</span></li>
        @else
        <li><a class="text-decoration-none text-dark " href="{{ $url }}">{{ $page }}</a></li>
        @endif
        @if (!$loop->last)
        <li class="page-item disabled"><span class=" mx-2">.</span></li>
        @endif
        @endforeach
        @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
        <li>
            <a href="{{ $paginator->nextPageUrl() }}" class="px-2 mx-3" rel="next" aria-label="@lang('pagination.next')"> <x-right-icon />
            </a>
        </li>
        @else
        <li class="disabled px-2 mx-3" aria-disabled="true" aria-label="@lang('pagination.next')">
            <x-right-icon />

        </li>
        @endif
    </ul>
</nav>
@endif