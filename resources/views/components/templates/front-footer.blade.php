<footer id="front-footer">
    <div class="entry-content">
        <div class="container mx-auto">
            <div class="grid grid-cols-4 gap-5 items-start">
                <div>
                    <object data="{{ asset('images/logos/AUGUR_BLANC.svg') }}" id="footer-logo"></object>
                </div>
                <div>
                    <h2>Informations</h2>
                    <ul>
                        <li><a href="" class="">À propos de nous</a></li>
                        <li><a href="{{ route('fo.shops.list') }}">Nos magasins</a></li>
                        <li><a href="{{ route('fo.legal') }}">Mentions légales</a></li>
                        <li><a href="{{ route('fo.conditions') }}">Conditions générales d'utilisation</a></li>
                    </ul>
                </div>
                <div>
                    <h2>Mes informations</h2>
                    <ul>
                        @if(auth()->guest())
                            <li><a href="{{ route('fo.sign') }}">Connexion / Inscription</a></li>
                        @else
                            <li><a href="{{ route('fo.profile') }}">Mes informations</a></li>
                            <li><a href="">Télécharger mes données</a></li>
                            <li><a href="">Supprimer mes données</a></li>
                            <li><a href="{{ route('logout') }}">Me déconnecter</a></li>
                        @endif
                    </ul>
                </div>
                <div>
                    <h2>Liens rapide</h2>
                    <ul>
                        <li><a href="{{ route('fo.contact') }}">Nous contacter</a></li>
                        <li><a href="{{ route('fo.evenements') }}">Nos animations</a></li>
                        <li><a href="{{ route('fo.labels.list') }}">Nos labels</a></li>
                        <li><a href="">Nos produits</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="entry-footer">
        <div class="container mx-auto">
            <div class="flex items-center">
                <div class="flex-1">
                    <p>©2023 | AÜGUR | Développé par <a href="www.rsoft.re" class="font-bold">RSOFT REUNION</a></p>
                </div>
                <div class="flex-none">
                    <a href="" class="mr-2"><i class="fa-brands fa-twitter"></i></a>
                    <a href="" class="mr-2"><i class="fa-brands fa-instagram"></i></a>
                    <a href="" class="mr-2"><i class="fa-brands fa-facebook"></i></a>
                    @if(!auth()->guest() && auth()->user()->team == 1)
                        <a href="{{ route('bo.dashboard') }}" class="border border-black px-2 py-1 rounded-lg hover:bg-black hover:text-white duration-300">Espace personnel</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</footer>
