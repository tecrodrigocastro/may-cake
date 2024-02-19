<div class="flex flex-col h-full">
    <div class="px-24 py-10 h-3/4 w-full flex flex-col">
        <!-- HEADER -->
        <div class="flex flex-row justify-between">
            <div class="flex flex-col">
                <img src="{{ asset('images/logovertical.png') }}" alt="" class="w-36">
                <hr class=" w-24 h-0.5 bg-pink-600">
            </div>


            <div class="flex flex-row gap-2">
                <a href="{{ route('home-customer') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#CB3C68"
                        class="bi bi-house" viewBox="0 0 16 16">
                        <path
                            d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z" />
                    </svg>
                </a>
                <a href="{{route('cart')}}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#CB3C68"
                        class="bi bi-cart-fill" viewBox="0 0 16 16">
                        <path
                            d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                    </svg>
                </a>
                <a href="{{route('profile')}}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#CB3C68"
                        class="bi bi-person" viewBox="0 0 16 16">
                        <path
                            d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                    </svg>
                </a>
            </div>

        </div>
        <!-- END HEADER -->

        <!-- MAIN -->
        <div class="flex flex-row justify-around  pt-10">
            <!-- PRODUCT DETAILS -->
            <div class="flex flex-row gap-6 items-start">
                <img src="{{ asset('storage/' . $product->images[0]) }}" alt="" class="max-w-[500px]">
                <div class="flex flex-col gap-2">
                    <h1 class="text-4xl font-bold text-pink-500">{{ $product->name }}</h1>
                    <h1 class="text-2xl  text-pink-500">R$ {{ $product->price }}</h1>
                    <!-- BUTTONS -->
                    <div class="flex flex-row gap-2">
                        <div class="h-9 w-24 border border-pink-700 rounded-xl ">
                            <div class="flex flex-row items-center text-pink-600">
                                <button wire:click="decrement" class="w-9 h-9 ">-</button>
                                <p> {{ $count }} </p>
                                <button wire:click="increment" class="w-9 h-9 ">+</button>
                            </div>
                        </div>
                        <button wire:click="addToCart" type="button" class="h-9 w-40 bg-pink-700 text-white rounded-full flex flex-row justify-around items-center ">
                            <div class="flex flex-row justify-around items-center gap-2 font-bold">
                                <p>Comprar</p>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#ffffff" class="bi bi-bag" viewBox="0 0 16 16">
                                    <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
                                  </svg>
                            </div>

                        </button>

                    </div>
                    <p class="w-80 pt-5">
                        {{ $product->description }}
                    </p>
                </div>
                <!-- END BUTTONS -->
            </div>
            <!-- END PRODUCT DETAILS -->

            <!-- DIVIDER -->
            <div class="h-[530px] w-1 bg-pink-500">
            </div>
            <!-- END DIVIDER -->

            <!-- MORE PRODUCTS -->
            <div class="flex flex-col gap-2 ">
                <h1>Veja também</h1>

                <!-- NEXT PRODUCT -->
                @foreach ($lastProducts as $last)
                    <div class="flex flex-row gap-4">

                        <img src="{{ asset('storage/' . $last->images[0]) }}" alt=""
                            class="w-40 h-40 rounded-full">
                        <div class="flex flex-col">
                            <div class="flex flex-row gap-2 text-lg">
                                <h1 class="text-pink-500 font-bold">{{ $last->name }}</h1>
                                <p class="text-pink-600 ">|</p>
                                <p class="text-pink-700 font-bold">R$ {{ $last->price }}</p>
                            </div>
                            <p class="w-72">{{ mb_strimwidth($last->description, 0, 150, '...') }}</p>
                        </div>

                        <div class="flex flex-col justify-center gap-3">
                            <button class="h-9 w-36 bg-pink-700 text-white rounded-full ">
                                <div class="flex flex-row justify-around items-center">
                                    <p class="font-bold">Comprar</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#ffffff"
                                        class="bi bi-cart-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                                    </svg>
                                </div>

                            </button>
                            <a href="{{ route('product', $last->id) }}">
                                <div
                                    class="h-9 w-36  text-pink-600 border border-pink-600 rounded-full items-center flex flex-row justify-around">
                                    <div class="flex flex-row justify-around items-center gap-2">
                                        <p class="font-bold">Espiar</p>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                            <path
                                                d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                        </svg>
                                    </div>

                                </div>
                            </a>
                        </div>



                    </div>
                @endforeach

                <!-- END NEXT PRODUCT -->
            </div>
            <!--END MORE PRODUCTS -->

        </div>
        <!-- END MAIN -->

    </div>
    <!-- PRE-FOOTER -->
   <x-prefooter />
    <!-- END PRE-FOOTER -->

    <!-- FOOTER -->
   <x-footer />
    <!-- END FOOTER -->
</div>
