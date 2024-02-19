<div class="bg-gray-100  flex flex-col h-auto">
    <div class="px-24 py-10 h-3/4 w-full flex flex-col">
        <x-header-profile />
        <div x-data="{ openTab: 1 }" class="p-8">
            <div class="w-full mx-auto">
                <div class="mb-4 flex space-x-4 p-2 bg-white rounded-lg shadow-md">
                    <button x-on:click="openTab = 1" :class="{ 'bg-pink-600 text-white': openTab === 1 }"
                        class="flex-1 py-2 px-4 rounded-md focus:outline-none focus:shadow-outline-pink transition-all duration-300">
                        Perfil
                    </button>
                    <button x-on:click="openTab = 2" :class="{ 'bg-pink-600 text-white': openTab === 2 }"
                        class="flex-1 py-2 px-4 rounded-md focus:outline-none focus:shadow-outline-pink transition-all duration-300">
                        Pedidos
                    </button>
                </div>

                <div x-show="openTab === 1"
                    class="transition-all duration-300 bg-white p-4 rounded-lg shadow-md border-l-4 border-pink-600 min-h-[600px]">
                   @if (session('message'))
                        <div class="bg-green-500 text-white p-3 rounded font-bold">
                            {{ session('message') }}
                        </div>
                   @endif

                   @if (session('error'))
                   <div class="bg-red-500 text-white p-3 rounded font-bold">
                       {{ session('error') }}
                   </div>
              @endif


                    <h2 class="text-2xl font-semibold mb-2 text-pink-600">Informações Básicas</h2>
                    <div class="flex flex-col">
                        <form wire:submit="updateUser">
                            <div class="flex flex-row justify-around ">
                                <div class="flex flex-col">
                                    <p class="text-gray-700">Nome</p>
                                    <input wire:model="name" type="text" class="text-pink-600 font-bold text-2xl"
                                        value="{{ $user->name }}">
                                </div>
                                <div class="flex flex-col">
                                    <p class="text-gray-700">Email</p>
                                    <input wire:model="email" type="email" class="text-pink-600 font-bold text-2xl"
                                        value="{{ $user->email }}">
                                </div>
                                <div class="flex flex-col">
                                    <p class="text-gray-700">Telefone</p>
                                    <input wire:model="phone" type="text" class="text-pink-600 font-bold text-2xl"
                                        value="{{ $user->phone }}">
                                </div>
                                <div class="flex flex-col">
                                    <p class="text-gray-700">CPF</p>
                                    <input wire:model="cpf" type="text" class="text-pink-600 font-bold text-2xl"
                                        value="{{ $user->cpf }}">
                                </div>

                                <button type="submit"
                                    class="bg-pink-700 px-6 py-2 rounded-md text-white font-bold ">Editar</button>
                            </div>
                        </form>

                        <h2 class="text-2xl font-semibold mb-2 text-pink-600">Endereços</h2>
                        <div class="grid grid-cols-2 p-4  gap-2">
                            @foreach ($user->adreesses as $adreess)
                                <div class=" flex flex-col gap-2 bg-pink-200 px-5 py-5 rounded-md   ">
                                    <div class="flex flex-row justify-between">
                                        <p class=""> Endereço: <span class="font-bold">{{ $adreess->street }},
                                                {{ $adreess->number }}</span></p>
                                        <p class=""> Bairro: <span
                                                class="font-bold">{{ $adreess->neighborhood }}</span></p>
                                    </div>
                                    <div class="flex flex-row justify-between">
                                        <p class=""> Cidade: <span class="font-bold">{{ $adreess->city }}</span>
                                        </p>
                                        <p class=""> CEP: <span class="font-bold">{{ $adreess->cep }}</span></p>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>

                <div x-show="openTab === 2"
                    class="transition-all duration-300 bg-white p-4 rounded-lg shadow-md border-l-4 border-pink-600">
                    <h2 class="text-2xl font-semibold mb-2 text-pink-600">Pedidos Realizados</h2>
                    <div class="grid grid-cols-2 p-4 m-4 gap-2">
                        @foreach ($orders as $order)
                            <div class=" flex flex-col gap-2 bg-pink-200 px-5 py-5 rounded-md   ">

                                <div class="flex flex-row justify-between">
                                    <p class=""> Pedido numero: <span
                                            class="font-bold">#{{ $order['id'] }}</span></p>
                                    <p class=""> Data: <span
                                            class="font-bold">{{ $order['formatted_created_at'] }}</span></p>
                                </div>


                                <div class="w-auto  border border-white rounded-lg flex flex-col p-6 gap-3">

                                    <div class="max-h-32 min-h-32 overflow-auto items-center text-center  ">

                                        @foreach ($order->items as $item)
                                            <div class="flex flex-row items-center gap-3 text-pink-600 text-lg  p-1">
                                                {{--   <img src="{{ asset($item->product->images[0]) }}" alt=""
                                                    class="w-20 rounded-full"> --}}
                                                <div class=" w-20 h-20 bg-cover bg-center bg-no-repeat rounded-full "
                                                    style="background-image: url({{ asset($item->product->images[0]) }})">

                                                </div>

                                                <p>{{ $item->product->name . ' X ' . $item->quantity }}</p>
                                                <p class="font-bold">R$ {{ $item->subtotal }}</p>
                                            </div>
                                        @endforeach
                                    </div>

                                    <hr class="h-0.5  bg-white">

                                    {{--  <div class="flex flex-row justify-between text-pink-600">
                                        <h1>Subtotal</h1>
                                        <h1>R$ 123</h1>
                                    </div> --}}
                                    {{-- <hr class="h-0.5  bg-white"> --}}
                                    <div class="flex flex-row justify-between text-pink-600 font-bold text-2xl">
                                        <h1>Total</h1>
                                        <h1>R$ {{ $order->total_price }}</h1>
                                    </div>

                                </div>

                                <div>
                                    <p class="text-gray-700">Endereço de entrega:</p>
                                    <p class="text-gray-700 font-bold"> {{ $order->adreesses->street }},
                                        {{ $order->adreesses->neighborhood }} - {{ $order->adreesses->city }} </p>
                                </div>

                                <div>
                                    <p class="text-gray-700">Forma de pagamento:</p>
                                    <p class="text-gray-700 font-bold text-xl"> {{ $payment[$order->payment] }} </p>
                                </div>

                                <div class="flex flex-col justify-col font-bold items-end">
                                    Status do pedido
                                    <div
                                        class="w-auto px-2  rounded-full bg-pink-600 bg-opacity-50 text-center border-2  border-white">
                                        <p class="text-white text-2xl"> {{ $status[$order->status] }}</p>
                                    </div>
                                </div>


                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
    <x-prefooter />
    <x-footer />
</div>
