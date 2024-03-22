<x-app-layout>
    <div class="flex flex-row m-auto w-5/6">
        <div class="aside" style="width: 300px">
            @foreach($filters as $filter)
            <div class="filter">
                <label for="filter">{{$filter->name}}</label>
                <input type="checkbox" name="filter" id="" switch>
            </div>
            @endforeach
        </div>
        <div class="right">
            <div class="grid gap-4" style="grid-template-columns: repeat(4, minmax(0, 1fr));">
                @foreach ($products as $product)
                <div class="">
                    <img src="" alt="{{ $product->name }}">
                    <div class="information">
                        <p>{{ $product->name }}</p>
                        <p>{{ $product->price }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
