@props([
    'href' => '#',
    'text' => 'Volver',
    'title' => null
])

<div class="flex items-center justify-between px-6 py-6 bg-[#F0F4F4] sticky top-0 z-10">
    @if($title)
        <h2 class="text-3xl font-extrabold text-[#284494]">{{ $title }}</h2>
    @endif
    <a href="{{ $href }}"
        class="inline-flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold shadow hover:bg-blue-700 transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        {{ $text }}
    </a>
</div>