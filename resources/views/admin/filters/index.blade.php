<x-app-layout>
    <div class="m-auto w-5/6 mt-8">
        <div class="border-b border-black mb-10">
            <form class="filterCreateForm" action="{{ route('filters.store') }}" method="POST" enctype="multipart/form-data">
                @csrf  
                <input style="display: none" type="text" name="name" id="filterName">   
            </form>
            <div class="flex items-end">
                <button class="text-xl" onclick="return createFilter()">Nieuwe filter toevoegen</button> 
                @if (\Session::has('error_create'))
                    <p class="ml-10 text-red-600 font-bold">{!! \Session::get('error_create') !!}</p>
                @endif
            </div>
        </div>
        <div class="grid gap-4" style="grid-template-columns: repeat(4, minmax(0, 1fr));">
            @foreach($filters as $filter)
            <div class="bg-slate-200 p-4 shadow-lg rounded-md">
                <form action="{{route('filters.update',$filter->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                        <input class="bg-gray-300 text-black placeholder-gray-500 border-none rounded-md shadow-sm" style="width: 100%" type="text" name="name" value="{{$filter->name}}">
                        <div class="flex justify-between">
                            <button class="mt-2 font-bold text-gray-600" onclick="return confirm('Wil je deze filter echt aanpassen?')">Aanpassen</button>
                </form>
                <form method="POST" action="{{ route('filters.destroy', $filter->id) }}">
                    @csrf
                    @method('DELETE')
                            <button class="mt-2 font-bold text-gray-600" onclick="return confirm('Wil je deze filter echt verwijderen?')">Verwijderen</button>
                        </div>
                </form>
            </div>
            @endforeach
        </div>
        
        <script>
        const filterCreateForm = document.querySelector('.filterCreateForm');

        function createFilter(){
            let filterName = prompt('Naam van het bedrijf');
            let nameInput = document.getElementById('filterName');
            nameInput.value = filterName;

            if(filterName != null){
                filterCreateForm.submit();
            }
        }
        </script>

    </div>
</x-app-layout>
