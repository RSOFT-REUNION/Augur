<div>
    <div class="entry-header flex items-center">
        <div class="flex-1">
            <h1>Réglages magasins</h1>
        </div>
    </div>
    <div class="entry-content">
        <button onclick="Livewire.emit('openModal', 'popups.backend.settings.add-shop')" id="btn_floating"><i class="fa-solid fa-plus mr-3"></i>Ajouter</button>
        @if($shops->count() > 0)
            <ul>
                @foreach($shops as $shop)
                    <li class="mb-3">
                        <div class="container-shop_admin" role="button" data-href="{{ route('bo.setting.shop.create', ['id' => $shop->id]) }}">
                            <div class="flex items-center">
                                <div class="flex-none">
                                    <img src="{{ asset('storage/medias/'. $shop->getPicture()) }}">
                                </div>
                                <div class="grow px-5">
                                    <h2>{{ $shop->title }}</h2>
                                    <h3>{{ $shop->address }} - {{ $shop->city }} ({{ $shop->postal_code }})</h3>
                                    <p class="mt-5">{{ $shop->description }}</p>
                                </div>
                                <div class="flex-none border-l border-gray-200 px-5">
                                    {!! $shop->schedules !!}
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="empty-text">Vous n'avez pas encore ajouté de magasins</p>
        @endif
    </div>
</div>
