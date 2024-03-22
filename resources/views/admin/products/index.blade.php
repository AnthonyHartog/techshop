<x-app-layout>
    <div class="m-auto w-5/6 mt-8">
        <div class="border-b border-black mb-10">
            <a class="text-xl" href="{{route('admin.products.create')}}">Nieuw product toevoegen</a>
        </div>
        <div class="grid gap-4" style="grid-template-columns: repeat(4, minmax(0, 1fr));">
            @foreach ($products as $product)
            <div class="flex flex-col">
                <a href="">
                    <div class="shadow-lg p-4">
                        <div class="up">
                            <img class="" src="{{asset('storage/' . $product->img)}}" alt="{{ $product->name }}">
                            <div class="flex justify-between">
                                <p >{{ $product->name }}</p>
                                <p style="color: rgb(42, 184, 42)">€{{ $product->price }}</p>
                            </div>
                        </div>
                    </div>
                </a>
                <div class="verwijderen">
                    <form action="{{route('admin.products.destroy', $product->id)}}" method="Post">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-500 font-bold" type="submit" onclick="return confirm('Weet u zeker dat u het product wilt verwijderen?');">Verwijderen</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
