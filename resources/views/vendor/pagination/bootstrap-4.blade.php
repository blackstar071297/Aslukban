@if ($paginator->hasPages())

        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
            @else
                <li ><a href="{{ $paginator->previousPageUrl() }}"><i class="material-icons">chevron_left</i></a></li>
            @endif
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <!-- <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li> -->
                            <li class="active"><a href="#!">{{ $page }}</a></li>
                        @else
                            <!-- <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li> -->
                            <li class="waves-effect"><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="waves-effect"><a href="{{ $paginator->nextPageUrl() }}"rel="next"><i class="material-icons">chevron_right</i></a></li>
            @else
                <li class="disabled"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
            @endif
        </ul>

@endif
