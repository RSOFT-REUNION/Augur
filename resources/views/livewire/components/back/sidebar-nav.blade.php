<div>
    @if($group == 'backend')
        <ul>
            <li><a href="{{ route('bo.dashboard') }}" class="btn-sidebar @if($item == 'dashboard') btn-sidebar_active @endif"><i class="fa-solid fa-house-chimney mr-3"></i>Tableau de bord</a></li>
            <div class="title-line">
                <h2>Mon activité</h2>
                <hr/>
            </div>
            <li><a href="{{ route('bo.customers') }}" class="btn-sidebar @if($item == 'customer') btn-sidebar_active @endif"><i class="fa-solid fa-users mr-3"></i>Clients</a></li>
            <li><a href="{{ route('bo.products.list') }}" class="btn-sidebar @if($item == 'product') btn-sidebar_active @endif"><i class="fa-solid fa-leaf mr-3"></i>Produits</a></li>
            <li><a href="{{ route('bo.recette') }}" class="btn-sidebar @if($item == 'recette') btn-sidebar_active @endif"><i class="fa-solid fa-list-ol mr-3"></i>Recettes</a></li>
            <li><a href="{{ route('bo.evenements') }}" class="btn-sidebar @if($item == 'evenement') btn-sidebar_active @endif"><i class="fa-solid fa-calendar-week mr-3"></i>Animations</a></li>
            <li><a href="{{ route('bo.labels') }}" class="btn-sidebar @if($item == 'label') btn-sidebar_active @endif"><i class="fa-solid fa-ribbon mr-3"></i>Labels & engagements</a></li>
            <div class="title-line">
                <h2>Mon site</h2>
                <hr/>
            </div>
            <li><a href="{{ route('bo.pages.general') }}" class="btn-sidebar @if($item == 'pages') btn-sidebar_active @endif"><i class="fa-solid fa-pager mr-3"></i>Mes pages</a></li>
            <li><a href="{{ route('bo.media') }}" class="btn-sidebar @if($item == 'media') btn-sidebar_active @endif"><i class="fa-solid fa-image mr-3"></i>Médias</a></li>
            <div class="title-line">
                <h2>Mon entreprise</h2>
                <hr/>
            </div>
            <li><a href="{{ route('bo.team') }}" class="btn-sidebar @if($item == 'team') btn-sidebar_active @endif"><i class="fa-solid fa-users-gear mr-3"></i>Équipe</a></li>
            <li><a href="{{ route('bo.setting.general') }}" class="btn-sidebar"><i class="fa-solid fa-sliders mr-3"></i>Réglages</a></li>
            <li><a href="{{ route('bo.about') }}" class="btn-sidebar @if($item == 'about') btn-sidebar_active @endif"><i class="fa-solid fa-info-circle mr-3"></i>À propos</a></li>
        </ul>
    @elseif($group == 'settings')
        <ul>
            <li><a href="{{ route('bo.dashboard') }}" class="btn-sidebar_back mb-3"><i class="fa-solid fa-arrow-left-long mr-3"></i>Retour</a></li>
            <li><a href="{{ route('bo.setting.general') }}" class="btn-sidebar @if($item == 'home') btn-sidebar_active @endif"><i class="fa-solid fa-sliders mr-3"></i>Général</a></li>
            <li><a href="{{ route('bo.setting.shop') }}" class="btn-sidebar @if($item == 'shop') btn-sidebar_active @endif"><i class="fa-solid fa-shop mr-3"></i>Magasins</a></li>
            <li><a href="{{ route('bo.setting.legal') }}" class="btn-sidebar @if($item == 'legal') btn-sidebar_active @endif"><i class="fa-solid fa-file-contract mr-3"></i>Mentions légales</a></li>
            <li><a href="{{ route('bo.setting.conditions') }}" class="btn-sidebar @if($item == 'conditions') btn-sidebar_active @endif"><i class="fa-solid fa-users-viewfinder mr-3"></i>CGU</a></li>
        </ul>
    @elseif($group == 'pages')
        <ul>
            <li><a href="{{ route('bo.dashboard') }}" class="btn-sidebar_back mb-3"><i class="fa-solid fa-arrow-left-long mr-3"></i>Retour</a></li>
            <li><a href="{{ route('bo.pages.general') }}" class="btn-sidebar @if($item == 'home') btn-sidebar_active @endif"><i class="fa-solid fa-sliders mr-3"></i>Général</a></li>
            <li><a href="{{ route('bo.pages.about') }}" class="btn-sidebar @if($item == 'about') btn-sidebar_active @endif"><i class="fa-solid fa-circle-info mr-3"></i>Page - À propos</a></li>
        </ul>
    @endif
</div>
