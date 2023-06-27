<header id="front-header">
    <div class="container mx-auto">
        <div class="flex items-center">
            <div class="flex-1">
                <div>
                    <object data="{{ asset('images/logos/AUGUR_icon_fill_Jaune.svg') }}" id="logo-header"></object>
                </div>

            </div>
            <div class="flex-none">
                <a href="{{ route('fo.home') }}" class="mr-2 btn-icon_transparent">Accueil</a>
                <a href="" class="mr-2 btn-icon_transparent">Qui sommes-nous ?</a>
                <a href="" class="mr-2 btn-icon_transparent">Nos labels</a>
                <a href="" class="mr-2 btn-icon_transparent">Nos recettes</a>
                <a href="" class="mr-2 btn-icon_transparent">Nos magasins</a>
                <a href="" class="mr-2 btn-icon_transparent"><i class="fa-solid fa-magnifying-glass"></i></a>
                <a href="@if(auth()->guest()) {{ route('fo.sign') }} @else {{ route('fo.profile') }} @endif" class="mr-4 btn-icon_transparent"><i class="fa-solid fa-user"></i></a>
                <button onclick="window.location='{{ route('fo.contact') }}'" class="btn-filled_secondary"><i class="fa-solid fa-comment mr-3"></i>Contactez-nous</button>
                @if(!auth()->guest())
                    <a href="{{ route('logout') }}" class="ml-2 btn-icon_transparent" title="Se déconnecter"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
                @endif
            </div>
        </div>
    </div>
</header>
