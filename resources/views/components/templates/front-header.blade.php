<div>
    <header id="front-header" class="hidden xl:block">
        <div class="container mx-auto">
            <div class="flex items-center">
                <div class="flex-1" role="button" data-href="{{ route('fo.home') }}">
                    <div>
                        <object data="{{ asset('images/logos/AUGUR_icon_fill_Jaune.svg') }}" id="logo-header"></object>
                    </div>

                </div>
                <div class="flex-none">
                    <a href="{{ route('fo.home') }}" class="mr-2 btn-icon_transparent cursor-pointer @if($active == 'home') active @endif">Accueil</a>
                    <a href="{{ route('fo.about') }}" class="mr-2 btn-icon_transparent cursor-pointer @if($active == 'about') active @endif">Qui sommes-nous ?</a>
                    <a href="{{ route('fo.labels.list') }}" class="mr-2 btn-icon_transparent cursor-pointer @if($active == 'label') active @endif">Nos labels</a>
                    <a href="{{ route('fo.products') }}" class="mr-2 btn-icon_transparent cursor-pointer @if($active == 'products') active @endif">Nos produits</a>
                    <a href="{{ route('fo.evenements') }}" class="mr-2 btn-icon_transparent cursor-pointer @if($active == 'evenement') active @endif">Nos animations</a>
                    <a onclick="Livewire.emit('openModal', 'popups.frontend.search')" class="mr-2 btn-icon_transparent cursor-pointer"><i class="fa-solid fa-magnifying-glass"></i></a>
                    <a href="@if(auth()->guest()) {{ route('fo.sign') }} @else {{ route('fo.profile') }} @endif" class="mr-4 btn-icon_transparent @if($active == 'profile') active @endif"><i class="fa-solid fa-user"></i></a>
                    <button onclick="window.location='{{ route('fo.contact') }}'" class="btn-filled_secondary"><i class="fa-solid fa-comment mr-3"></i>Contactez-nous</button>
                    @if(!auth()->guest())
                        <a href="{{ route('logout') }}" class="ml-2 btn-icon_transparent" title="Se déconnecter"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
                    @endif
                </div>
            </div>
        </div>
    </header>
    @livewire('components.front.header-mobile')
</div>
