<x-app-layout>
    <div class="m-auto w-5/6 mt-8">
        <div class="flex justify-center">
            <div class="rounded-md shadow-sm p-1 p-4 mr-8 mb-12" style="background-color: rgb(226 232 240);">
                <h1 class="font-bold text-2xl text-center mb-4">Jouw bestellingen</h1>
                <div class="grid gap-4 flex" style="grid-template-columns: repeat(1, minmax(0, 1fr));">
                    @foreach($order->amounts as $amount)
                    <div class="rounded-md p-2" style="background-color: rgb(209 213 219);">
                        <a class="flex justify-between" href="{{route('product.show', [$amount->product->id, $amount->product->name])}}">
                            <div class="w-2/3 mr-1">
                                <p class="text-xl font-bold">{{ $amount->product->name }}</p>
                                <p><span class="font-bold">Aantal producten:</span> {{ $amount->amount }}</p>
                                <p><span class="font-bold" style="color: rgb(42, 184, 42)"> €{{$amount->product->price}} </span>per stuk</p>
                                <p class="mt-4">{{ Str::limit($amount->product->description, 100) }}</p>
                            </div>
                            <div class="w-1/3">
                                <img class="mt-1 mb-1" style="height:100%; witdh: 100%; object-fit: contain" src="{{asset('storage/' . $amount->product->img)}}" alt="{{ $amount->product->name }}">
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                <div class="text-center mt-4">
                    <p class="font-bold text-2xl">Totale prijs: <span style="color: rgb(42, 184, 42)">€{{$totalPrice}}</span></p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>