<x-app-layout>
    <div class="m-auto w-5/6 mt-8">
        <div class="flex justify-center">
            <div class="rounded-md shadow-sm p-4 mr-8" style="background-color: rgb(226 232 240); width: -webkit-fill-available;">
                <div class="text-center">
                    <h1 class="font-bold text-2xl text-center mb-4">{{$user->name}}, bedankt voor je bestelling!</h1>
                    <p>Je bestelling is goed gegaan en is onderweg naar jou toe!</p>
                    <a class="italic text-black" href="{{route('order.show', $order->id)}}">Zie jouw bestelling!</a>
                </div>
                <div class="mt-6 text-center">
                    <a class="bg-yellow-300 p-2 pr-8 pl-8 rounded-md mt-6 mb-4" href="{{route('product.index')}}">Nog meer winkelen?</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>