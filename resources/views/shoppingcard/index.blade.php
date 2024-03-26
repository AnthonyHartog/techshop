<x-app-layout>
    <p>ja</p>
    @foreach($products as $product)
        <p>{{ $product['product']->name }}</p>
        <p>{{ $product['amount'] }}</p>
    @endforeach

    <a href="{{ route('shoppingcards.delete') }}" onclick="return confirm('Wil je echt alles uit je winkelmand halen?')">Verwijder alles uit winkelmand</a>
</x-app-layout>