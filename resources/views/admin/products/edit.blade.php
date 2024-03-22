<x-app-layout>
    <div class="m-auto w-5/6 mt-8">
        <div class="border-b border-black mb-10 text-center">
            <h1 class="text-2xl font-bold mb-2">Product aanpassen</h1>
        </div>
        <div class="">
            <form action="{{route('admin.products.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex justify-between">
                    <div class="">
                        <p class="mb-1 font-bold">Naam</p>
                        <input style="width: 500px" type="text" name="name" value="{{$product->name}}">
                        @error('name')
                            <div class="text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="">
                        <p class="mb-1 font-bold">Prijs</p>
                        <input style="width: 500px" type="number" name="price" min="0" value="{{$product->price}}">
                        @error('price')
                            <div class="text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mt-8">
                    <p class="mb-1 font-bold">Beschrijving</p>
                    @error('description')
                        <div class="text-red-600">{{ $message }}</div>
                    @enderror
                    <textarea style="width: 100%" name="description" id="" cols="30" rows="10">{{$product->description}}</textarea>
                </div>

                <div class="mt-8">
                    <p class="mb-1 font-bold">Specificatie</p>
                    <div class="flex gap-4 mb-4">
                        <div class="">
                            <input onclick="check_type()" type="radio" name="specification_type" id="create" value="create">
                            <label for="create">Specificatie maken</label>
                        </div>
                        <div class="">
                            <input onclick="check_type()" type="radio" name="specification_type" id="choose" value="choose" checked>
                            <label for="choose">Specificatie kiezen</label>
                        </div>
                    </div>

                    <div class="create-specification" style="display:none;">
                        <div class="card w-1/4 bg-base-100 shadow-xl">
                            <div class="card-body">
                                <div class="flex items-center">
                                    <p class="mb-1 font-bold">GPU</p>
                                    <input class="mb-2 border-none" placeholder="GPU naam" type="text" name="gpu">
                                </div>
                                <div class="flex items-center">
                                    <p class="mb-1 font-bold">CPU</p>
                                    <input class="mb-2 border-none" placeholder="CPU naam" type="text" name="cpu">
                                </div>
                                <div class="flex items-center">
                                    <p class="mb-1 font-bold">RAM</p>
                                    <input class="mb-2 border-none" placeholder="RAM naam" type="text" name="ram">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="choose-specification">
                        @if (\Session::has('specification_delete'))
                            <p class="text-red-600">{!! \Session::get('specification_delete') !!}</p>
                        @endif
                        <div class="grid gap-8" style="grid-template-columns: repeat(3, minmax(0, 1fr)); width: 100%">
                            @foreach($specifications as $specification)
                                <div class="card bg-base-100 shadow-xl">
                                    <div class="card-body">
                                        <p><span class="font-bold">CPU </span>{{$specification->cpu}}</p>
                                        <p><span class="font-bold">GPU </span>{{$specification->gpu}}</p>
                                        <p><span class="font-bold">RAM </span>{{$specification->ram}}</p>
                                        <div class="card-actions justify-between items-center">
                                            <div class="create">
                                                <input class="p-2 font-bold" {{$product->specification_id == $specification->id ? 'checked' : ''}} type="radio" name="specification_id" value="{{$specification->id}}">
                                            </div>
                                            <div class="flex items-center">
                                                <label class="text-red-600 mr-2" for="delete-specifications[]">Verwijder specificatie</label>
                                                <input class="delete_specification" type="checkbox" name="delete_specifications[]" value="{{$specification->id}}" onclick="updateDeleteCounter(); if (this.checked) { alert('Als je dit hebt aangevinkt wordt het verwijderd. Ook als je een nieuwe wilt aanmaken.'); }">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="flex">
                        <p class="font-bold mt-8">Specificaties die worden verwijderd: <span class="text-red-600" id="delete-counter">0</span></p>
                    </div>
                </div>
                <div class="mt-8 w-72">
                    <p class="mb-1 font-bold">Filters</p>
                    @error('filters')
                        <div class="text-red-600">{{ $message }}</div>
                    @enderror
                    <div class="grid grid-cols-3 gap-2">
                        @foreach($filters as $filter)
                            <div class="filter-input">
                                <input type="checkbox" name="filters[]" value="{{$filter->id}}" {{ $product->filters->contains($filter) ? 'checked' : '' }}>
                                <label for="filter">{{$filter->name}}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <label class="mt-8 pt-8 pb-8 bg-cyan-100 shadow-lg" style="cursor: pointer; display: flex; justify-content: center;">
                    <input style="width: 100%; display: none;" name="image" type="file" accept="image/*" onchange="displaySelectedImages(this)"/>
                    <img id="image" src="{{asset('img/add-image.png')}}" alt="">
                    <div id="image-preview-container"></div>
                </label>
                @error('image')
                    <div class="text-red-600 mb-10">{{ $message }}</div>
                @enderror
                <button class="mt-8 mb-8 bg-cyan-600 p-2 pl-4 pr-4 rounded-md">Product aanpassen</button>
            </form>
        </div>
    </div>
   <script>
    const create = document.getElementById('create');
    const choose = document.getElementById('choose');

    const createDiv = document.querySelector('.create-specification');
    const chooseDiv = document.querySelector('.choose-specification');

    const deleteCounter = document.getElementById('delete-counter');

    function check_type() {
        if(create.checked){
            createDiv.style.display = "block";
            chooseDiv.style.display = "none";
        }
        else if(choose.checked){
            createDiv.style.display = "none";
            chooseDiv.style.display = "block";
        }
    }

    //Update de delete counter hoeveel specificaties er worden verwijderd
    function updateDeleteCounter(){
        let checkboxes = document.querySelectorAll('.delete_specification:checked');
        deleteCounter.textContent = checkboxes.length;
    }

    function displaySelectedImages(input) {
        var previewContainer = document.getElementById('image-preview-container');
        let previewImageEl = document.getElementById('image');

        if (input.files && input.files.length > 0) {
            previewContainer.innerHTML = ''; // Clear previous previews
            for (var i = 0; i < input.files.length; i++) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    var imgElement = document.createElement('img');
                    imgElement.src = e.target.result;
                    imgElement.alt = 'Selected Image';
                    previewImageEl.style.display = 'none';
                    previewContainer.style.display = 'block';
                    previewContainer.appendChild(imgElement);
                };
    
                reader.readAsDataURL(input.files[i]);
            }
        }
    }
   </script>
</x-app-layout>
