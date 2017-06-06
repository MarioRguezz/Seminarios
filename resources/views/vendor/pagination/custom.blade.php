@if ($paginator->hasPages())
    <ul style="float:left; margin-left:10%; margin-top:-15px;" class="pager">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled"><span style="border:none; color: #201953;"><<</span></li>
        @else
            <li><a style="border:none; color: #201953;" href="{{ $paginator->previousPageUrl() }}" rel="prev"><<</a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled"><span style="border:none; color:black;">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active my-active"><span style="border:none; color: black;">{{ $page }}</span></li>
                    @else
                        <li><a style="border:none; color: black;" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a  style="border:none; color: #201953;" href="{{ $paginator->nextPageUrl() }}" rel="next">>></a></li>
        @else
            <li class="disabled"><span style="border:none; color: #201953;">>></span></li>
        @endif
    </ul>
@endif
