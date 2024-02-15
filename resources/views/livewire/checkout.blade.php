<div class="flex flex-col">
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
        <div class="flex flex-col p-14 gap-8">
            <h1 class="text-4xl font-bold text-pink-600 underline ">Finalizar compra</h1>

            <form wire:submit="save">
            <div class="flex flex-row gap-6 justify-between">
                <!-- DATA CUSTOMER -->
                <div class="flex flex-col gap-2">
                    <h1 class="text-3xl font-bold text-pink-600 ">Dados do destinatario</h1>
                    <input type="text" disabled name="name" id="name" value="{{$user->name}}"
                        class="border border-gray-400 rounded-lg h-8 w-96 px-3 text-gray-400 bg-white">
                    <input type="tel" disabled name="tel" id="tel" value="{{$user->phone}}"
                        class="border border-gray-400 rounded-lg h-8 w-96 px-3 text-gray-400 bg-white">
                    <input type="text" disabled name="cpf" id="cpf" value="{{$user->cpf}}"
                        class="border border-gray-400 rounded-lg h-8 w-96 px-3 text-gray-400 bg-white">
                    <div class="flex flex-row justify-end">
                        <a href="{{route('profile')}}" class="text-pink-600 font-bold pb-8">Editar dados</a>
                    </div>

                    <h1 class="text-3xl font-bold text-pink-600 ">Endereço do destinatário</h1>
                    <div class="inline-block relative ">
                        <select  wire:model="selectedAddress" wire:change="loadAddress"  class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                            <option value="">Selecione um endereço</option>
                            @foreach($addresses as $address)
                              <option value="{{ $address->id }}">{{ $address->street }}</option>
                          @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                          <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 12l-6-6h12l-6 6z"/></svg>
                        </div>
                      </div>
{{--                     <select wire:model="selectedAddress" wire:change="loadAddress" class="">
                        <option value="">Selecione um endereço</option>
                        @foreach($addresses as $address)
                            <option value="{{ $address->id }}">{{ $address->street }}</option>
                        @endforeach
                    </select> --}}
                    <input type="text" disabled name="street" id="street" value="{{$addressForm->street}}"
                        class="border border-gray-400 rounded-lg h-8 w-96 px-3 text-gray-400 bg-white">
                    <div class="flex flex-row gap-3 items-center text-pink-600">
                        <input type="number" disabled name="number" id="number" value="0"
                            class="border border-gray-400 rounded-lg h-8 w-20 px-3 text-gray-400 bg-white">
                         <input type="text" disabled name="neighborhood" id="neighborhood" value="{{$addressForm->neighborhood}}"
                        class="border border-gray-400 rounded-lg h-8 w-72 px-3 text-gray-400 bg-white">
                    </div>
                    <input type="text" disabled name="city" id="city" value="{{$addressForm->city}}"
                    class="border border-gray-400 rounded-lg h-8 w-96 px-3 text-gray-400 bg-white">
                    <input type="text" disabled name="cep" id="cep" value="{{$addressForm->cep}}"
                        class="border border-gray-400 rounded-lg h-8 w-96 px-3 text-gray-400 bg-white">
                    <div class="flex flex-row justify-end gap-4">
                        <button class="text-pink-600 font-bold pb-8">Editar dados</button>
                        <p class="text-pink-600">|</p>
                        <button class="text-pink-600 font-bold pb-8">Adicionar Endereço</button>
                    </div>
                </div>
                <!-- END DATA CUSTOMER -->

                <!-- DIVIDER -->
                <div class="h-[510px] w-0.5 bg-pink-500">
                </div>
                <!-- END DIVIDER -->

                <!-- PAYMENT METHOD -->

                <div class="flex flex-col gap-2">
                    <h1 class="text-3xl font-bold text-pink-600 ">Forma de pagamento</h1>
                    <div class="flex flex-row gap-2 items-center">
                        <input type="radio"  wire:model="payment" name="payment" id="credit_card" value="credit_card" class="h-6 w-6 fill-red-500">
                        <label for="credit_card" class="text-pink-600">Cartão de crédito</label>
                    </div>
                    <div class="flex flex-row gap-2 items-center">
                        <input type="radio" name="payment" wire:model="payment" id="debit_card" value="debit_card" class="h-6 w-6">
                        <label for="debit_card" class="text-pink-600">Cartão de débito</label>
                    </div>
                    <div class="flex flex-row gap-2 items-center">
                        <input type="radio" name="payment" wire:model="payment" id="pix" value="pix" class="h-6 w-6">
                        <label for="pix" class="text-pink-600">Pix</label>
                    </div>
                    <div class="flex flex-row gap-2 items-center">
                        <input type="radio" name="payment" wire:model="payment" id="cash" value="cash" class="h-6 w-6">
                        <label for="cash" class="text-pink-600">Dinheiro</label>
                    </div>

                </div>

                <!-- END PAYMENT METHOD -->
                <!-- DIVIDER -->
                <div class="h-[510px] w-0.5 bg-pink-500">
                </div>
                <!-- END DIVIDER -->

                <!-- ORDER SUMMARY -->

                <div class="w-96 h-auto border border-pink-600 rounded-lg flex flex-col p-6 gap-3">

                    @foreach ($items as $item)
                        <div class="flex flex-row items-center gap-3 text-pink-600 text-lg ">
                            <img src="{{ asset($item['image']) }}" alt="" class="w-20">
                            <p>{{{ $item['name'].' X ' . $item['quantity']}}}</p>
                            <p class="font-bold">R$ {{$item['subtotal']}}</p>
                        </div>
                    @endforeach

                    <hr class="h-0.5  bg-pink-600">

                    <div class="flex flex-row justify-between text-pink-600">
                        <h1>Subtotal</h1>
                        <h1>R$ {{$total}}</h1>
                    </div>
                    <div class="flex flex-row justify-between text-pink-600">
                        <h1>Custo de entrega</h1>
                        <h1>R$ {{$delivery_price}}</h1>
                    </div>
                    <hr class="h-0.5  bg-pink-600">
                    <div class="flex flex-row justify-between text-pink-600 font-bold text-2xl">
                        <h1>Total</h1>
                        <h1>R$ {{$total + $delivery_price}}</h1>
                    </div>

                </div>

                <!-- END ORDER SUMMARY -->


            </div>
            <div class="flex flex-row justify-end gap-3 pt-5">
                <button class="h-9  px-3  text-pink-600 border border-pink-600 rounded-full ">Cancelar</button>
                <button type="submit" class="h-9  px-3  text-white bg-pink-600 rounded-full ">Finalizar compra</button>
            </div>
        </form>

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
