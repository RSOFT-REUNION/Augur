<div>
    <header id="front-header_mobile" class="xl:hidden">
        <div class="container mx-auto">
            <div class="flex items-center">
                <div class="flex-1">
                    <a wire:click="$toggle('menu')"><i class="fa-solid fa-bars"></i></a>
                </div>
                <div class="flex-none">
                    <div>
                        <object data="{{ asset('images/logos/AUGUR_icon_fill_Jaune.svg') }}" width="70px"></object>
                    </div>
                </div>
            </div>
        </div>
        @if($menu)
            <div class="menu_sidebar" wire:click="$toggle('menu')">
                <div class="container-sidebar">
                    <div class="px-10 py-5">
                        <div class="force-center">
                            <img src="{{ asset('images/logos/AUGUR_GRIS.svg') }}" width="150px">
                        </div>
                        <ul>
                            <li><a href="{{ route('fo.home') }}" class="btn-sidebar_mobile mb-2">Accueil</a></li>
                            <li><a href="{{ route('fo.about') }}" class="btn-sidebar_mobile mb-2">Qui sommes-nous ?</a></li>
                            <li><a href="{{ route('fo.labels.list') }}" class="btn-sidebar_mobile mb-2">Nos labels</a></li>
                            <li><a href="{{ route('fo.products') }}" class="btn-sidebar_mobile mb-2">Nos produits</a></li>
                            <li><a href="{{ route('fo.evenements') }}" class="btn-sidebar_mobile mb-2">Nos animation</a></li>
                            <li><a onclick="Livewire.dispatch('openModal', { component: 'popups.frontend.search' })" class="btn-sidebar_mobile mb-2"><i class="fa-solid fa-magnifying-glass mr-2"></i>Rechercher</a></li>
                            <li><a href="@if(auth()->guest()) {{ route('fo.sign') }} @else {{ route('fo.profile') }} @endif" class="btn-sidebar_mobile mb-2"><i class="fa-solid fa-user mr-2"></i>@if(auth()->guest()) Connexion @else Mon profil @endif</a></li>
                            <li><a href="{{ route('fo.contact') }}" class="btn-sidebar_mobile mb-2">Contactez-nous</a></li>
                            @if(!auth()->guest())
                                <li><a href="{{ route('logout') }}" class="btn-sidebar_mobile"><i class="fa-solid fa-arrow-right-from-bracket mr-2"></i>Se déconnecter</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        @endif
    </header>
</div>
