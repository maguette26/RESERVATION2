
<li>
    {{ $item->name }} - {{ $item->quantity }} x {{ $item->price}} DH
    <form action="{{ route('cart.update', $item->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('PATCH')
        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" style="width: 60px;">
        <button type="submit">Mettre à jour</button>
    </form>
    <form action="{{ route('cart.destroy', $item->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Supprimer</button>
    </form>
</li>
