<x-app-layout>
    <h2 class="text-2xl font-bold mb-4">Tarjetas asociadas</h2>
    <table class="min-w-full">
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Número</th>
                <th>Titular</th>
                <th>Últimos 4</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cards as $card)
            <tr>
                <td>{{ $card->id }}</td>
                <td>{{ $card->user->name ?? '-' }}</td>
                <td>**** **** **** {{ $card->last_four }}</td>
                <td>{{ $card->card_holder }}</td>
                <td>{{ $card->last_four }}</td>
                <td>
                    <a href="{{ route('admin.cards.show', $card->id) }}">Ver</a> |
                    <a href="{{ route('admin.cards.edit', $card->id) }}">Editar</a> |
                    <form action="{{ route('admin.cards.destroy', $card->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" onclick="return confirm('¿Eliminar tarjeta?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $cards->links() }}
</x-app-layout>