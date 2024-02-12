<div class="flex flex-col h-full">

    <div class="px-24 py-10 h-3/4 w-full flex flex-col">
        <!-- HEADER -->
        <div class="flex flex-row justify-between">
            <div class="flex flex-col">
                <img src="{{ asset('images/logovertical.png') }}" alt="" class="w-36">
                <hr class=" w-24 h-0.5 bg-pink-600">
            </div>


            <div class="flex flex-row gap-2">
                <a href="{{ route('cart') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#CB3C68"
                        class="bi bi-cart-fill" viewBox="0 0 16 16">
                        <path
                            d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                    </svg>
                </a>
                <a href="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#CB3C68"
                        class="bi bi-person" viewBox="0 0 16 16">
                        <path
                            d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                    </svg>
                </a>
            </div>

        </div>

        <!-- SEARCH -->
        <div class="flex flex-row justify-between pt-10 pb-8">
            <div class=" flex flex-col">
                <h1 class="text-2xl text-pink-500 font-bold"> Todos os produtos</h1>
                <p class="text-gray-400">120 produtos</p>
            </div>

            <div>
                <input type="text"
                    class="w-96 h-10 border-2 border-pink-400 rounded-md placeholder:font-bold placeholder:px-3 px-3"
                    placeholder="O que você está procurando?">
            </div>
        </div>
        <!-- PRODUCTS -->
        <div class="grid grid-cols-5 gap-9 items-center">
            @foreach ($products as $product)
                <a href="{{ route('product', $product->id) }}">
                    <div class="flex flex-col items-center border border-pink-200 rounded-md">
                        <div class="max-h-56">
                            <img src="{{ asset('storage/' . $product->images[0]) }}" alt="" class="bg-contain">
                        </div>
                        <div
                            class="h-28 w-full bg-gray-100 border border-pink-200 rounded-md text-center flex flex-col justify-around">
                            <h1 class="text-pink-500 font-bold">{{ $product->name }}</h1>
                            <p class="text-pink-700 font-bold">R$ {{ $product->price }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

    </div>


    <!-- PRE-FOOTER -->
    <div class="h-48 w-full bg-prefooter bg-cover flex flex-col justify-center">

        <div class="flex flex-row justify-center gap-10 ">
            <div class="flex flex-col items-center">
                <img src="{{ asset('images/logovertical.png') }}" alt="" class="w-36">
                <div class="flex flex-row gap-2 text-pink-500 font-bold  ">
                    <a href="" class="">Inicio</a>
                    <a href="" class="">Carrinho</a>
                    <a href="" class="">Contato</a>
                    <a href="" class="">Perfil</a>
                </div>
            </div>
        </div>

    </div>

    <!-- FOOTER -->
    <div class="h-auto w-full justify-center flex flex-col text-center bg-pink-600 text-white font-bold">
        <h1>@ 2024 May Cake - Todos os direitos reservados.</h1>
        <p>
            <\> Desenvolvido por REDRODRIGO
        </p>
    </div>

</div>
