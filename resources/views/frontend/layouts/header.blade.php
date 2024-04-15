<nav class="navbar navbar-expand-lg" aria-label="Augur Navbar"  style="border-top: #1b2e47 20px solid;">
    <div class="container pt-3">
        <a class="navbar-brand" href="/"><img class="logo hvr-wobble-to-bottom-right" src="{{ asset('images/logo/logo_icon_jaune.png') }}" alt="logo"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar2" aria-controls="offcanvasNavbar2">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar2" aria-labelledby="offcanvasNavbar2Label">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbar2Label"><img class="img-fluid" src="{{ asset('images/logo/logo_gris.png') }}" alt="logo"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link {{ Nav::isRoute('index') }}" aria-current="page" href="{{ route('index') }}">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Nav::urlDoesContain('labels') }}" aria-current="page" href="{{ route('labels.index') }}">Nos labels</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Nos Produits
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Produits surgelés</a></li>
                            <li><a class="dropdown-item" href="#">Epicerie fine</a></li>
                            <li><a class="dropdown-item" href="#">Produits vrax</a></li>
                            <li><a class="dropdown-item" href="#">Produits Péi</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#">Nos recettes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#">Nos animations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#">Contact</a>
                    </li>
                    @if(Auth::guest())
                        <li class="nav-item me-2">
                            <a class="btn btn-primary hvr-grow-shadow" aria-current="page" href="{{ route('dashboard') }}"> <i class="fa-duotone fa-user fa-fw"></i> Mon compte</a>
                        </li>
                    @endif
                    @if(Auth::user())
                    <li class="nav-item dropdown me-2">
                        <a class="btn btn-primary dropdown-toggle" aria-current="page" href="{{ route('dashboard') }}"> <i class="fa-duotone fa-user fa-fw"></i> {{ Auth::user()->name }} {{ Auth::user()->first_name }}</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Mon Profile</a></li>
                            <li><a class="dropdown-item" href="#">Mes adresses</a></li>
                            <li><a class="dropdown-item" href="#">Mes commande</a></li>
                            <li><form method="POST" action="{{ route('logout') }}"> @csrf <button class="btn btn-danger w-100 btn-logout mt-2">{{ __('Log Out') }}</button> </form></li>
                        </ul>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="btn btn-warning hvr-grow-shadow" aria-current="page" href="#"> <i class="fa-duotone fa-cart-shopping"></i> Panier</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
