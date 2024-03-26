<x-app-layout>
    <div class="m-auto w-5/6 mt-8 flex justify-center">
        <div class="text-black placeholder-gray-500 rounded-md shadow-sm p-1 w-1/2 p-4" style="background-color: rgb(226 232 240);">
            <div class="grid gap-4" style="grid-template-columns: repeat(1, minmax(0, 1fr));">
                @foreach($products as $product)
                <div class="rounded-md p-2" style="background-color: rgb(209 213 219);">
                    <a class="flex justify-between" href="{{route('product.show', [$product['product']->id, $product['product']->name])}}">
                        <div class="w-2/3 mr-1">
                            <p class="text-xl font-bold">{{ $product['product']->name }}</p>
                            <p><span class="font-bold">Aantal producten:</span> {{ $product['amount'] }}</p>
                            <p class="mt-4">{{ Str::limit($product['product']->description, 100) }}</p>
                        </div>
                        <div class="w-1/3">
                            <img class="mt-1 mb-1" style="height:100%; witdh: 100%; object-fit: contain" src="{{asset('storage/' . $product['product']->img)}}" alt="{{ $product['product']->name }}">
                        </div>
                    </a>
                    <form action="{{route('shoppingcard.destroy', $product['product']->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600">Verwijder uit winkelmand</button>
                    </form>
                </div>
                @endforeach
            </div>
            @if($products)
            <div class="mt-10">
                <a class="font-bold text-red-600" href="{{ route('shoppingcards.delete') }}" onclick="return confirm('Wil je echt alles uit je winkelmand halen?')">Verwijder alles uit winkelmand</a>
            </div>
            @else
            <div class="flex flex-col items-center">
                <p class="text-2xl font-bold">Er zit niks in je winkelmand....</p>
                <div class="mt-10">
                    <a class="bg-yellow-300 p-2 pr-4 pl-4 rounded-md mt-8 mb-4" href="{{route('product.index')}}">Winkel verder</a>
                </div>
            </div>
            @endif
        </div>
    </div>

</x-app-layout>