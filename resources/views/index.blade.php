<x-app-layout>
    <div id="banner" class="h-96 shadow-lg" style="transition: background-image 1s ease-in-out; background-image: url('{{ asset('img/banner1.png') }}'); background-size: cover; background-position: center;">
        <div class="flex justify-center items-center h-full">
            <a class="p-3 pr-9 pl-9 font-bold text-xl rounded-md" style="background-color: rgb(253 224 71 / 70%)" href="{{route('product.index')}}">Winkel nu</a>
        </div>
    </div>
    <div class="pt-8 flex bg-slate-200 shadow-lg">
        <div class="w-1/2 m-4 p-4">
            <h1 class="text-center text-2xl font-bold">Over ons</h1>
            <div class="mt-8 flex justify-center">
                <p class="w-3/4">
                    Met decennia aan ervaring staat Techshop bekend om kwaliteit, betrouwbaarheid en uitstekende service. Ons team van experts helpt klanten bij het vinden van de perfecte technologische oplossing, inclusief laptops van topmerken zoals Dell, HP, Lenovo en ASUS. We streven naar een naadloze winkelervaring met een gebruiksvriendelijke website en veilige online omgeving. Deskundig advies en ondersteuning zijn integraal, inclusief technische begeleiding en snelle after-sales service. Bij Techshop geloven we in klanttevredenheid, en daarom bieden we hoogwaardige producten en service, ondersteund door jarenlange ervaring in de branche.</p>
            </div>
            <div class="text-center mt-10">
                <a class="p-2 pr-6 pl-6 font-bold text-md rounded-md bg-cyan-300" href="{{route('product.index')}}">Bekijk onze producten</a>
            </div>
        </div>
        <div class="w-1/2 p-2 m-4 p-1 flex justify-center">
            <img class="p-4" style="width: 95%; height: 95;" src="{{asset('img/building.png')}}" alt="building.png">
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var banner = document.getElementById("banner");
            var images = [
                "{{ asset('img/banner1.png') }}",
                "{{ asset('img/banner2.png') }}"
            ];
            var currentIndex = 0;

            setInterval(function() {
                // Verander de achtergrondafbeelding van de banner
                currentIndex = (currentIndex + 1) % images.length;
                banner.style.backgroundImage = "url('" + images[currentIndex] + "')";
            }, 10000); // Elke 10 seconden
        });
    </script>
</x-app-layout>