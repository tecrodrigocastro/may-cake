<div class="flex flex-row justify-between">
    <div class="flex flex-col">
        <img src="{{ asset('images/logovertical.png') }}" alt="" class="w-36">
        <hr class=" w-24 h-0.5 bg-pink-600">
    </div>

    {{--  @dump(auth()->user()) --}}

    <div class="flex flex-row gap-2 justify-center items-center">
        <a href="{{ route('cart') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-h-8 text-pink-600" fill="#CB3C68"
                class="bi bi-cart-fill" viewBox="0 0 16 16">
                <path
                    d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
            </svg>
        </a>


        {{--   <a href="">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-h-8 text-pink-600" fill="#CB3C68"
                class="bi bi-person" viewBox="0 0 16 16">
                <path
                    d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
            </svg>
        </a> --}}

        @if (auth()->user())
            <a href="{{ route('logout') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-h-8 text-pink-600" fill="currentColor"
                    class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z" />
                    <path fill-rule="evenodd"
                        d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                </svg>
            </a>
        @endif

        <div class="flex flex-col">
            {{--     <a
                href="@if (auth()->user()) {{ route('logout') }} @else {{ route('login') }} @endif " class="font-bold text-pink-700">
                Olá, @if (auth()->user())
                    {{ auth()->user()->name }}
                    @else Visitante
                @endif
            </a> --}}
            @auth
                <a href="{{ route('profile') }}" class="font-bold text-pink-700">
                    Olá, {{ auth()->user()->name }}
                </a>
            @else
                <a href="{{ route('login') }}" class="font-bold text-pink-700">
                    Olá, Visitante
                </a>
            @endauth
        </div>
    </div>

</div>
