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
                        <div class="container-shop_admin">
                            <div class="flex items-center">
                                <div class="flex-none w-1/3">
                                    <img src="{{ asset('storage/medias/'. $shop->getPicture()) }}">
                                </div>
                                <div class="flex-1 ml-5">
                                    <h2>{{ $shop->title }}</h2>
                                    <h3>{{ $shop->address }}, {{ $shop->postal_code }} ({{ $shop->city }})</h3>
                                    <div class="mt-10">
                                        <a href="{{ route('bo.setting.shop.create', ['id' => $shop->id]) }}" class="btn-filled_secondary"><i class="fa-solid fa-pen-to-square"></i>Modifier</a>
                                        @if($shop->isUsed() == 0)
                                            <a wire:click="delete({{ $shop->id }})" class="btn-icon_transparent"><i class="fa-solid fa-trash"></i></a>
                                        @endif
                                    </div>
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
