<header class="bg-cyan-600 "> 
    <div class="flex justify-between items-center m-auto w-5/6 pt-4 pb-4">
        <div class="logo">
            <a href="{{route('product.index')}}">LOGO</a>
        </div>
        <div class="pt-2 relative mx-auto text-gray-600">
            @if(Auth::check() && Auth::user()->admin == true)   
            <div class="font-bold text-black">
                <a class="mr-1" href="{{route('admin.products.index')}}">Producten</a>
                <a class="mr-1" href="{{route('filters.index')}}">Filters</a>
                <a href="">Medewerkers</a>
            </div>
            @else
            <a class="mr-1 text-black" href="{{route('product.index')}}">Producten</a>
            @endif
          </div>
            @if(!Auth::check()) 
                <a class="font-bold" href="{{route('login')}}">Inloggen</a>
            @else
                <a class="font-bold" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Uitloggen</a>
        
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @csrf
        @endif
        <div class="ml-3 cart relative bg-black p-1 w-14 rounded-lg">
            <div class="counter rounded-full absolute -right-2 -top-2 text-black bg-white w-6 text-center">@if(Cache::has('shoppingcard')) {{ count(Cache::get('shoppingcard')) }} @else 0 @endif</div>
            <img class="w-6 h-6 mx-auto" src="{{asset('img/cart.svg')}}" alt="cart.svg">
        </div>
    </div>
</header>