@props(['paginator'])

@if ($paginator->hasPages())
    <div class="py-4 flex justify-center">
        <nav class="inline-flex rounded-md shadow-sm font-mono text-sm" aria-label="Pagination">
            {{-- Botón anterior --}}
            @if ($paginator->onFirstPage())
                <span class="px-4 py-2 bg-gray-200 text-gray-400 rounded-l-full cursor-not-allowed">Anterior</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                   class="px-4 py-2 bg-white text-[#2563eb] border border-gray-200 hover:bg-blue-50 rounded-l-full transition">Anterior</a>
            @endif

            {{-- Números de página --}}
            @php
                $start = max($paginator->currentPage() - 2, 1);
                $end = min($paginator->currentPage() + 2, $paginator->lastPage());
            @endphp
            @for ($i = $start; $i <= $end; $i++)
                @if ($i == $paginator->currentPage())
                    <span class="px-4 py-2 bg-[#2563eb] text-white font-bold">{{ $i }}</span>
                @else
                    <a href="{{ $paginator->url($i) }}"
                       class="px-4 py-2 bg-white text-[#2563eb] border border-gray-200 hover:bg-blue-50 transition">{{ $i }}</a>
                @endif
            @endfor

            {{-- Botón siguiente --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                   class="px-4 py-2 bg-white text-[#2563eb] border border-gray-200 hover:bg-blue-50 rounded-r-full transition">Siguiente</a>
            @else
                <span class="px-4 py-2 bg-gray-200 text-gray-400 rounded-r-full cursor-not-allowed">Siguiente</span>
            @endif
        </nav>
    </div>
@endif