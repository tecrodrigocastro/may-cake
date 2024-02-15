<div class="flex flex-col  h-screen">
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
                <a href="">
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
        <div class="flex flex-col p-20 gap-2">

            <h1 class="text-4xl font-bold text-pink-600">Carrinho</h1>

            <!-- HR -->
            <div class="flex flex-col bg-pink-100 justify-center text-center h-16">

                <div class="flex flex-row justify-between text-center px-11 text-pink-600 font-bold text-xl">
                    <p>Produto</p>
                    <div class="flex flex-row gap-16 justify-center items-center">
                        <p> Preço Unitario</p>
                        <p>Quantidade</p>
                        <p>Subtotal</p>
                        <p>Excluir</p>
                    </div>
                </div>
            </div>
            <!-- END HR -->

            @if (count($items) == 0)
                <div class="flex flex-col justify-center items-center">

                    <p class="text-2xl font-bold text-pink-600">Seu carrinho está vazio</p>
                </div>
            @endif

            <!-- CONTENT -->
            @foreach ($items as $item)
                <div class="flex flex-row  justify-between items-center px-12">
                    <div class="flex flex-row gap-10 justify-center items-center">
                        <img src="{{ asset('storage/' . $item['image']) }}" alt="" class="w-24">
                        <p>{{ $item['name'] }}</p>
                    </div>

                    <div class="flex flex-row gap-24 justify-center items-center">
                        <p class="text-start">R$ {{ $item['unitPrice'] }}</p>
                        <div class="flex flex-row gap-2 justify-center items-center">
                            <button wire:click="decrementFromCart({{ $item['id'] }})"
                                class="w-8 h-8 bg-pink-700 text-white rounded-full">-</button>
                            <p>{{ $item['quantity'] }}</p>
                            <button wire:click="addToCart({{ $item['id'] }})"
                                class="w-8 h-8 bg-pink-700 text-white rounded-full">+</button>
                        </div>
                        <p>R$ {{ $item['subtotal'] }}</p>
                        <button wire:click="removeFromCart({{ $item['id'] }})"
                            wire:confirm="Tem certeza de que deseja excluir este produto?" type="button"
                            class="w-8 h-8  text-white rounded-full flex flex-col justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#CB3C68"
                                class="bi bi-trash" viewBox="0 0 16 16">
                                <path
                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                <path
                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                            </svg>
                        </button>
                    </div>
                </div>
            @endforeach

            <!-- END CONTENT -->
            <!-- FR -->
            <div class="flex flex-col bg-pink-100 justify-center text-center h-16">

                <div class="flex flex-row justify-end text-center px-10 text-pink-600 font-bold text-2xl">
                    <p>Subtotal: R$ {{ $total }} </p>

                </div>
            </div>
            <!-- END HR -->
            <!-- BUTTONS -->
            <div class="flex flex-row justify-end gap-3">
                <button class="h-9  px-3  text-pink-600 border border-pink-600 rounded-full ">
                    <div class="flex flex-row justify-around items-center">
                        <p class="font-bold">Continuar comprando</p>

                    </div>

                </button>
                <a href="{{ route('checkout') }}">
                    <button class="h-9 px-3 bg-pink-700 text-white rounded-full ">
                        <div class="flex flex-row justify-around items-center font-bold">
                            <p>Finalizar</p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#ffffff"
                                class="bi bi-check" viewBox="0 0 16 16">
                                <path
                                    d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z" />
                            </svg>
                        </div>

                    </button>

                </a>

            </div>
        </div>
        <!-- END MAIN -->


    </div>
    <!-- PRE-FOOTER -->
    <x-prefooter> </x-prefooter>
    <!-- END PRE-FOOTER -->

    <!-- FOOTER -->
    <x-footer></x-footer>
    <!-- END FOOTER -->
</div>
