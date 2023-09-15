<div class="mb-10">
    <div class="entry-header flex items-center">
        <div class="flex-1">
            <h1>Tableau de bord</h1>
        </div>
        <div class="flex-none">
            {{--<div class="textfield-line">
                <label for="search"><i class="fa-solid fa-magnifying-glass"></i></label>
                <input type="text" placeholder="Rechercher..." class="focus:outline-none" role="searchbox">
            </div>--}}
        </div>
    </div>
    <div class="entry-content">
        {{-- Alert message --}}
        <div id="alert-box_dashboard">
            <div class="flex items-center">
                <div class="flex-1 inline-flex items-center">
                    <i class="fa-solid fa-star mr-3"></i>
                    <p>Bienvenue sur votre nouveau site AÜGUR, si vous avez besoin d'aide, n'hésitez pas à nous contacter !</p>
                </div>
                <div class="flex-none">
                    <button onclick="Livewire.emit('openModal', 'popups.backend.support-message')" class="btn-outline_primary">Contacter le support<i class="fa-solid fa-circle-question ml-3"></i></button>
                </div>
            </div>
        </div>

        {{--<div class="px-4 py-2 bg-red-500 text-white rounded-lg mt-2">
        	<p>Des modifications et des corrections sont en cours ce jour !</p>
        </div>--}}

        {{-- Grids --}}
        <div class="grid grid-cols-4 gap-10 mt-9">
            <div class="dash-grid_item text-center" role="button" data-href="{{ route('bo.sav') }}">
                <h2><i class="fa-solid fa-comments mr-3"></i>{{ $contacts->count() }}</h2>
                <p>Message de contact</p>
            </div>
            <div class="dash-grid_item text-center" role="button" data-href="{{ route('bo.evenements') }}">
                <h2><i class="fa-solid fa-calendar-week mr-3"></i>{{ $evenements->count() }}</h2>
                <p>Événements</p>
            </div>
            <div class="dash-grid_item col-span-2">
                @if($evenementsNow->count() > 0)
                    @foreach($evenementsNow as $ev)
                        <div class="flex items-center" role="button" data-href="{{ route('bo.evenements') }}">
                            <div class="flex-none">
                                <div id="grid_picture" style="background-image: url('{{ asset('storage/medias/'. $ev->getPicture()) }}')"></div>
                            </div>
                            <div class="flex-1 ml-5">
                                <h3>{{ $ev->title }}</h3>
                                <p>{{ \Illuminate\Support\Str::limit($ev->description_short) }}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="flex items-center" role="button" data-href="{{ route('bo.evenements') }}">
                        <div class="flex-none">
                            <div id="grid_picture" style="background-image: url('{{ asset('images/assets/add_evenments.jpg') }}')"></div>
                        </div>
                        <div class="flex-1 ml-5">
                            <h3>Vous n'avez pas d'événements en cours.</h3>
                        </div>
                    </div>
                @endif

            </div>
            <div class="dash-grid_item text-center" role="button" data-href="{{ route('bo.recette') }}">
                <h2><i class="fa-solid fa-plate-wheat mr-3"></i>{{ $recipes->count() }}</h2>
                <p>Recettes</p>
            </div>
            <div class="dash-grid_item text-center" role="button" data-href="{{ route('bo.labels') }}">
                <h2><i class="fa-solid fa-ribbon mr-3"></i>{{ $labels->count() }}</h2>
                <p>Labels</p>
            </div>
            <div class="dash-grid_item text-center" role="button" data-href="{{ route('bo.customers') }}">
                <h2><i class="fa-solid fa-users mr-3"></i>{{ $customers->count() }}</h2>
                <p>Clients</p>
            </div>
            <div class="dash-grid_item text-center" role="button" data-href="{{ route('bo.products.list') }}">
                <h2><i class="fa-solid fa-leaf mr-3"></i>{{ $products->count() }}</h2>
                <p>Produits</p>
            </div>
        </div>

        {{-- Recent activity --}}
        <div class="title-line_big">
            <h2>Activité récente</h2>
            <hr/>
        </div>
        @foreach($activities as $activity)
            <div class="list-box mt-2 border border-transparent hover:border-blue-600 cursor-pointer">
                <div class="flex items-center">
                    <div class="flex-1">
                        <p>
                            @if($activity->type == 0)
                                <i class="fa-solid fa-circle-plus mr-3"></i>
                            @elseif($activity->type == 1)
                                <i class="fa-solid fa-comment mr-3"></i>
                            @endif
                            {{ $activity->message }}
                        </p>
                    </div>
                    <div class="flex-none inline-flex items-center">
                        <p class="text-gray-500">{{ $activity->getDate() }}</p>
                        @if($activity->item != null)
                            <a href="" class="border-l border-gray-300 pl-3 ml-3 hover:text-blue-400">VOIR</a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</div>
