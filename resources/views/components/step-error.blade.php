@if ($errors->any())
    <div class="w-full mb-2">
        <div
            class="bg-red-50 border border-red-200 text-red-500 px-2 py-1 rounded-md shadow-sm animate-fade-in
                            max-h-10 overflow-y-auto transition-all duration-300 text-xs leading-tight">
            <ul class="list-disc list-inside font-mono space-y-0.5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
