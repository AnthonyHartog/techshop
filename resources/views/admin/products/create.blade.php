<x-app-layout>
    <div class="m-auto w-5/6 mt-8">
        <div class="border-b border-black mb-10 text-center">
            <h1 class="text-2xl font-bold mb-2">Product toevoegen</h1>
        </div>
        <div class="">
            <form action="{{route('admin.products.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex justify-between">
                    <div class="">
                        <p class="mb-1 font-bold">Naam</p>
                        <input style="width: 500px" type="text" name="name" placeholder="Naam">
                    </div>
                    <div class="">
                        <p class="mb-1 font-bold">Prijs</p>
                        <input style="width: 500px" type="number" name="name" min="0" placeholder="Naam">
                    </div>
                </div>
                <div class="mt-8">
                    <p class="mb-1 font-bold">Beschrijving</p>
                    <textarea style="width: 100%" name="description" id="" cols="30" rows="10">Beschrijving....</textarea>
                </div>
                <div class="mt-8 w-72">
                    <p class="mb-1 font-bold">Filters</p>
                    <div class="grid grid-cols-3 gap-2">
                        @foreach($filters as $filter)
                            <div class="filter-input">
                                <input type="checkbox" name="filters[]" id="" switch>
                                <label for="filter">{{$filter->name}}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="mt-8">
                    <input id="image" type="file" name="image"/>
                </div>
                <input class="mt-8 mb-8 bg-cyan-600 p-2 pl-4 pr-4 rounded-md" type="submit" value="Product aanmaken" name="" id="">
            </form>
        </div>
    </div>
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
   <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
   <script>
        FilePond.registerPlugin(FilePondPluginImagePreview);

        // Get a reference to the file input element
        const inputElement = document.getElementById('image');

        // Create a FilePond instance
        const pond = FilePond.create(inputElement);

        const quill = new Quill('#editor', {
            theme: 'snow'
        });
   </script>
</x-app-layout>
