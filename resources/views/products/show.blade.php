<x-app-layout>
    <div class="flex flex-row m-auto w-5/6 mt-8">
        <div class="grid gap-4" style="grid-template-columns: repeat(2, minmax(0, 1fr));">
            <div>
                <div class="text-center">
                    <h1 class="text-2xl font-bold">{{$product->name}}</h1>
                </div>
                <div class="shadow-xl p-4">
                    <img class="" src="{{asset('storage/' . $product->img)}}" alt="{{ $product->name }}">
                </div>
            </div>
            <div class="information">
                <div class="">
                    <p class="font-bold text-xl mb-4 mt-10" style="color: rgb(42, 184, 42)">€{{$product->price}}</p>
                    <p>{{$product->description}}</p>
                </div>
                <button class="bg-yellow-300 p-2 pr-4 pl-4 rounded-md mt-8 mb-4">In winkelmand toevoegen</button>
                <div class="mt-4">
                    <p><span class="font-bold text-green-500">Inclusief verzendkosten</span>, verstuurd door techshop</p>
                    <p>30 dagen bedenktijd en <span class="font-bold text-green-500">gratis</span> retourneren</p>
                    <p><span class="font-bold text-green-500">24/7 bereikbaar</span> via onze klanten service</p>
                </div>
                <div class="specifications">
                    <h2 class="text-xl font-bold mt-10">Specificaties</h2>
                    <div class="mt-2">
                        <p><span class="font-bold">GPU: </span>{{$product->specification->gpu}}</p>
                        <p><span class="font-bold">CPU: </span>{{$product->specification->cpu}}</p>
                        <p><span class="font-bold">RAM: </span>{{$product->specification->ram}}</p>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>
