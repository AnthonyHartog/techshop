<x-app-layout>
    <div class="m-auto w-5/6 mt-8">
        <div class="flex justify-center">
            <div class="rounded-md shadow-sm p-1 p-4 mr-8" style="background-color: rgb(226 232 240);">
                <h1 class="font-bold text-2xl text-center mb-4">Jouw bestellingen</h1>
                @if(!$orders->isEmpty())
                @if($orders->count() > 1)
                <div class="grid gap-4 flex" style="grid-template-columns: repeat(2, minmax(0, 1fr));">
                @else
                <div class="grid gap-4 flex" style="grid-template-columns: repeat(1, minmax(0, 1fr));">
                @endif
                    @foreach($orders as $order)
                    <a href="{{route('order.show', $order->id)}}">
                        <div class="flex p-2 rounded-md" style="background-color: rgb(209 213 219);">
                            <p class="font-bold mr-2">Aantal producten <span>{{$order->amounts()->count()}}</span></p>
                            <p>{{$order->created_at}}</p>
                        </div>
                    </a>
                    @endforeach
                </div>
                @else
                <div class="p-4 text-center">
                    <p class="text-xl">Je hebt geen bestellingen.....</p>
                    <div class="mt-6">
                        <a class="bg-yellow-300 p-2 pr-8 pl-8 rounded-md mt-6 mb-4" href="{{route('product.index')}}">Bekijk alle producten</a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>