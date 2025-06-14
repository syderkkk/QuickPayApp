@if (session('success'))
    <div class="mb-3 text-green-700 bg-green-100 rounded p-2 font-mono text-center text-sm">
        {{ session('success') }}
    </div>
@endif
