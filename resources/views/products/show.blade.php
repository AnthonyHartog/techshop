<x-app-layout>
    <div class="flex flex-row m-auto w-5/6 mt-8 pb-10">
        <div class="grid gap-4" style="grid-template-columns: repeat(2, minmax(0, 1fr));">
            <div>
                <div class="text-center">
                    <h1 class="text-2xl font-bold">{{$product->name}}</h1>
                </div>
                <div style="height: 400px;" class="shadow-xl p-4">
                    <img class="" style="height: 100%; witdh: 100%; object-fit: contain" src="{{asset('storage/' . $product->img)}}" alt="{{ $product->name }}">
                </div>
            </div>
            <div class="information">
                <div class="">
                    <p class="font-bold text-xl mb-4 mt-10" style="color: rgb(42, 184, 42)">€{{$product->price}}</p>
                    <p>{{$product->description}}</p>
                </div>
                <form action="{{route('shoppingcard.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="product_id" value="{{$product->id}}">
                    <button class="bg-yellow-300 p-2 pr-4 pl-4 rounded-md mt-8 mb-4">In winkelmand toevoegen</button>
                    <input type="number" name="amount" min="1" max="10" value="1" class="appearance-none rounded-md w-16 h-10 px-3 py-1 text-sm text-center border-gray-300 focus:outline-none focus:ring focus:border-blue-300">
                </form>

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
