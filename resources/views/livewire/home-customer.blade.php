<div class="flex flex-col h-screen">
    <div class="px-24 py-10  w-full flex flex-col h-full">
        <!-- HEADER -->
        <x-header-profile />

        <!-- SEARCH -->
        <div class="flex flex-row justify-between pt-10 pb-8">
            <div class=" flex flex-col">
                <h1 class="text-2xl text-pink-600 font-bold"> Todos os produtos</h1>
                <p class="text-gray-400">{{ count($products) }} produtos</p>
            </div>

            <div>
                <input type="text"
                    class="w-96 h-10 border-2 border-pink-400 rounded-md placeholder:font-bold placeholder:px-3"
                    placeholder="O que você está procurando?">
            </div>
        </div>
        <!-- PRODUCTS -->
        <div class="grid grid-cols-4 gap-9 items-center">
            @foreach ($products as $product)
                <a href="{{ route('product', $product->id) }}" class="">
                    <div class="flex flex-col items-center border border-pink-200 rounded-md ">
                        <div class="h-56 bg-cover w-full max-h-56 "
                            style="background-image: url({{ asset('storage/' . $product->images[0]) }})">
                            {{-- <img src="{{ asset('storage/' . $product->images[0]) }}" alt="" class="bg-contain max-h-56 h-56 w-full"> --}}
                        </div>
                        <div
                            class="h-28 w-full bg-gray-100 border border-pink-200 rounded-md text-center flex flex-col justify-around">
                            <h1 class="text-pink-600 font-bold">{{ $product->name }}</h1>
                            <p class="text-pink-700 font-bold">R$ {{ $product->price }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

    </div>


    <!-- PRE-FOOTER -->
    <x-prefooter></x-prefooter>

    <!-- FOOTER -->
    <div class="h-auto w-full justify-center flex flex-col text-center bg-pink-600 text-white font-bold">
        <h1>@ 2024 May Cake - Todos os direitos reservados.</h1>
        <p>
            <\> Desenvolvido por REDRODRIGO
        </p>
    </div>

</div>
