<x-app-layout>
    <div class="flex flex-row m-auto w-5/6 mt-8">
        <div class="aside" style="width: 300px; border-right: 1px solid black; margin-right: 15px;">
            <div class="border-black border border-solid mr-8 p-4">
                @foreach($filters as $filter)
                <div class="filter">
                    <label for="filter">{{$filter->name}}</label>
                    <input type="checkbox" name="filter" id="" switch>
                </div>
                @endforeach
                <button class="bg-cyan-300 p2- pr-4 pl-4 mt-4 rounded-md">Filter</button>
            </div>
        </div>
        <div class="">
            <div class="grid gap-4" style="grid-template-columns: repeat(3, minmax(0, 1fr));">
                @foreach ($products as $product)
                <a href="">
                    <div class="shadow-lg p-4">
                        <img class="" src="{{asset('storage/' . $product->img)}}" alt="{{ $product->name }}">
                        <div class="flex justify-between">
                            <p >{{ $product->name }}</p>
                            <p style="color: rgb(42, 184, 42)">€{{ $product->price }}</p>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
