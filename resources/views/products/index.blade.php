<x-app-layout>
    <div class="flex flex-row m-auto w-5/6 mt-8">
        <div class="aside" style="width: 300px; margin-right: 15px;">
            <div class="bg-slate-200 p-4 shadow-lg rounded-md mr-8 p-4">
                <form action="{{route('product.filter')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="bg-gray-300 text-black placeholder-gray-500 border-none rounded-md shadow-sm p-1">
                        @foreach($filters as $filter)
                        <div class="filter">
                            <input type="checkbox" class="bg-gray-500 border-none rounded-md" name="filters[]" value="{{$filter->name}}" {{ is_array($selectedFilters) && in_array($filter->name, $selectedFilters) ? 'checked' : '' }}>
                            <label for="filter">{{$filter->name}}</label>
                        </div>
                        @endforeach
                    </div>
                    <button class="bg-cyan-300 p2- pr-4 pl-4 mt-4 rounded-md">Filter</button>
                </form>
            </div>
        </div>
        <div class="">
            <div class="grid gap-4" style="grid-template-columns: repeat(3, minmax(0, 1fr));">
                @foreach ($products as $product)
                <a href="{{route('product.show', [$product->id, $product->name])}}">
                    <div class="shadow-lg p-4">
                        <img class="mt-1 mb-1" style="height:200px;" src="{{asset('storage/' . $product->img)}}" alt="{{ $product->name }}">
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
