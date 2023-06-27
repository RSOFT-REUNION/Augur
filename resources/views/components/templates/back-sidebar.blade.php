<div id="backend_sidebar">
    <div class="flex flex-col h-screen">
        <div class="flex-none">
            <div class="force-center">
                <object data="{{ asset('images/logos/AUGUR_GRIS.svg') }}" width="200px"></object>
            </div>
        </div>
        <div class="grow">
            <div class="entry-content">
                @livewire('components.back.sidebar-nav', ['group' => $group, 'item' => $item])
            </div>
        </div>
        <div class="flex-none">
            <div class="entry-footer flex items-center">
                <div class="flex-1 inline-flex items-center">
                    <a href="{{ route('fo.home') }}" title="Retourner au site"><img src="{{ asset('images/logos/AUGUR_icon_fill_Jaune.svg') }}" width="40px"></a>
                    <div class="text-white ml-3">
                        <h3>Administrateur</h3>
                        <p>brian@rsoft.re</p>
                    </div>
                </div>
                <div class="flex-none">
                    <button onclick="window.location='{{ route('logout') }}'" class="btn-icon_secondary" aria-label="Déconnexion"><i class="fa-solid fa-arrow-right-from-bracket"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>
