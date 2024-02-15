<div class="w-full h-screen bg-pink-200">
    <div class="flex flex-row ">
        <div class="w-1/2 h-screen bg-cover " style="background-image: url({{ asset('images/bglogin.png') }})">
        </div>
        <div class="flex flex-row justify-center w-1/2 h-screen">

            <div class="justify-center flex flex-col  h-full items-center ">
                <img src="{{ asset('images/logo.png') }}" alt="logo login" class=" w-64">
                <h1 class="text-3xl font-bold text-pink-700 py-10">Faça seu login</h1>



                <form wire:submit="login">
                    <div class="flex flex-col gap-4">
                        <div class="relative">
                            <input type="email" wire:model="email"
                                class=" pl-10 pr-4 py-2 w-96 h-10 outline-none border-2 border-gray-400  focus:border-pink-700 rounded-md placeholder:font-bold placeholder:px-3"
                                placeholder="E-mail">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center  pointer-events-none pr-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 " fill="#CB3C68"
                                    class="bi bi-envelope" viewBox="0 0 16 16">
                                    <path
                                        d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z" />
                                </svg>
                                {{--     <svg class="h-5 w-5 text-gray-400"
                                            fill="none"
                                            stroke="currentColor">
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8">
                                            </path>
                                            </svg> --}}
                            </div>
                        </div>
                        @error('email')
                            <div class="bg-red-200  rounded-md w-96 text-red-700 text-center">
                                <p>{{ $message }}</p>
                            </div>
                        @enderror
                        {{--   <div class="flex flex-row pb-6 gap-3  items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#CB3C68" class="bi bi-envelope" viewBox="0 0 16 16" >
                                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
                            </svg>
                            <input  type="email" wire:model="email" class=" w-96 h-10 border-2 border-gray-400 rounded-md placeholder:font-bold placeholder:px-3" placeholder="E-mail">
                        </div> --}}
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none pr-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 " fill="#CB3C68"
                                    class="bi bi-key" viewBox="0 0 16 16">
                                    <path
                                        d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8m4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5" />
                                    <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                                </svg>
                            </div>
                            <input type="password" wire:model="password"
                                class="  pl-10 pr-4 py-2 h-10 w-96 border-2 border-gray-400 focus:border-pink-700 outline-none rounded-md placeholder:font-bold placeholder:px-3"
                                placeholder="Senha">
                        </div>

                        @error('password')
                            <div class="bg-red-200  rounded-md w-96 text-red-700 text-center">
                                <p>{{ $message }}</p>
                            </div>
                        @enderror

                        <button type="submit"
                            class="bg-white text-pink-700 rounded-md w-96 h-10 border-2 border-pink-700 flex flex-row items-center justify-center gap-2 hover:bg-pink-500 hover:border-white hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z" />
                                <path fill-rule="evenodd"
                                    d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                            </svg>
                            <p class="font-bold">Entrar</p>
                        </button>
                        @if (session('error'))
                            <div class="bg-red-500 text-white p-3 rounded">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="bg-green-500 text-white p-3 rounded">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                </form>

                <div class="flex flex-col items-center">
                    <a href="#" class="text-gray-400 ">Esqueci minha senha</a>
                    <p class="text-gray-400 ">Não tem conta? Crie uma clicando
                        <a href="{{ route('register-customer') }}" class="underline text-pink-600">aqui</a>
                    </p>
                </div>
            </div>
        </div>


    </div>

    <x-footer> </x-footer>
</div>
