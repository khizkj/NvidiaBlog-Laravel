@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-center space-x-1">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-3 py-2 text-sm bg-gray-700 text-gray-500 rounded-lg cursor-not-allowed">
                <i class="fas fa-chevron-left"></i>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
               class="px-3 py-2 text-sm bg-gray-800 text-white rounded-lg hover:bg-green-600 transition-colors">
                <i class="fas fa-chevron-left"></i>
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="px-3 py-2 text-sm bg-gray-700 text-gray-400 rounded-lg">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-3 py-2 text-sm bg-green-500 text-black font-bold rounded-lg">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}"
                           class="px-3 py-2 text-sm bg-gray-800 text-white rounded-lg hover:bg-green-600 transition-colors">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
               class="px-3 py-2 text-sm bg-gray-800 text-white rounded-lg hover:bg-green-600 transition-colors">
                <i class="fas fa-chevron-right"></i>
            </a>
        @else
            <span class="px-3 py-2 text-sm bg-gray-700 text-gray-500 rounded-lg cursor-not-allowed">
                <i class="fas fa-chevron-right"></i>
            </span>
        @endif
    </nav>
@endif
