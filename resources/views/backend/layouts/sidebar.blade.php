<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('backend.dashboard') }}">
        <div style="width: 80%">
            <img class="w-100 hvr-grow-rotate shadow rounded-bottom-4 backgroundwhite" src="{{ asset('backend/img/logo.png') }}">
        </div>
    </a>
    <!-- Dashboard -->
    <li class="mt-4 nav-item {{ Nav::isRoute('backend.dashboard') }}">
        <a class="nav-link" href="{{ route('backend.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>{{ __('Dashboard') }}</span></a>
    </li>
    <hr class="sidebar-divider">

    <!-- Contenu -->
    @canany(filtrerPermission('content'))
        <li class="nav-item {{ Nav::isResource('contenu') }}">
            <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#contenu" aria-expanded="false" aria-controls="collapseTwo">
                <i class="fa-solid fa-folder-grid"></i>
                <span>Contenu</span>
            </a>
            <div id="contenu" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    @canany(filtrerPermission('content.pages'))
                        <a class="collapse-item" href="{{ route('backend.content.pages.index') }}"><i class="fa-solid fa-memo"></i> Pages</a>
                    @endcanany
                    @canany(filtrerPermission('content.categories'))
                        <a class="collapse-item" href="{{ route('backend.content.categories.index') }}"><i class="fa-solid fa-list"></i> Catégories</a>
                    @endcanany
                        @canany(filtrerPermission('content.carousel'))
                            <a class="collapse-item" href="{{ route('backend.content.carrousel.index') }}"><i class="fa-solid fa-presentation-screen"></i> Carrousel</a>
                        @endcanany
                </div>
            </div>
        </li>
        <hr class="sidebar-divider">
    @endcanany


        <!-- Catalogue -->
        @canany(filtrerPermission('catalog'))
        <li class="nav-item {{ Nav::isResource('catalogue') }}">
            <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#catalogue" aria-expanded="false" aria-controls="collapseTwo">
                <i class="fa-solid fa-folder-grid"></i>
                <span>Catalogue</span>
            </a>
            <div id="catalogue" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    @canany(filtrerPermission('catalog.products'))
                        <a class="collapse-item" href="{{ route('backend.catalog.products.index') }}"><i class="fa-solid fa-cubes-stacked"></i> Produits</a>
                    @endcanany
                    @canany(filtrerPermission('catalog.categories'))
                        <a class="collapse-item" href="{{ route('backend.catalog.categories.index') }}"><i class="fa-solid fa-layer-group"></i> Catégories</a>
                    @endcanany
                    @canany(filtrerPermission('catalog.brands'))
                        <a class="collapse-item" href="{{ route('backend.catalog.brands.index') }}"><i class="fa-solid fa-crown"></i> Marques & Fournisseurs</a>
                    @endcanany
                    @canany(filtrerPermission('catalog.stocks'))
                        <a class="collapse-item" href="{{ route('backend.catalog.stocks.index') }}"><i class="fa-solid fa-boxes-stacked"></i> Stocks</a>
                    @endcanany
                    @canany(filtrerPermission('catalog.shops'))
                        <a class="collapse-item" href="{{ route('backend.catalog.shops.index') }}"><i class="fa-solid fa-store"></i> Magasins</a>
                    @endcanany
                </div>
            </div>
        </li>
        <hr class="sidebar-divider">
    @endcanany



    <!-- settings -->
    @canany(filtrerPermission('settings'))
        <li class="nav-item {{ Nav::isResource('parametres') }}">
            <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#settings" aria-expanded="false" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>Paramètres</span>
            </a>
            <div id="settings" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    @canany(filtrerPermission('settings.teams'))
                        <a class="collapse-item" href="{{ route('backend.settings.teams.index') }}"><i class="fa-duotone fa-users"></i> Equipes</a>
                    @endcanany
                    @canany(filtrerPermission('settings.information'))
                        <a class="collapse-item" href="{{ route('backend.settings.informations.index') }}"><i class="fa-solid fa-circle-info"></i> Informations</a>
                        <a class="collapse-item" href="{{ route('backend.settings.legalnotice.index') }}"><i class="fa-solid fa-memo-circle-info"></i> Mentions légales</a>
                        <a class="collapse-item" href="{{ route('backend.settings.termsofservice.index') }}"><i class="fa-solid fa-users-rectangle"></i> Conditions générales d'utilisation</a>
                    @endcanany
                </div>
            </div>
        </li>
        <hr class="sidebar-divider">
    @endcanany


    <!-- Specific -->
    @canany(filtrerPermission('specific'))
        <li class="nav-item {{ Nav::isResource('specifique') }}">
            <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#specific" aria-expanded="false" aria-controls="collapseTwo">
                <i class="fa-solid fa-fingerprint"></i> <span>Specifique</span>
            </a>
            <div id="specific" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ route('backend.specific.labels.index') }}"><i class="fa-solid fa-award"></i> Labels</a>
                    <a class="collapse-item" href="{{ route('backend.specific.animations.index') }}"><i class="fa-solid fa-certificate"></i> Animations</a>
                </div>
            </div>
        </li>
    @endcanany

</ul>
