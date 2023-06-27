<div>
    <div class="entry-header flex items-center">
        <div class="flex-1">
            <h1>Tableau de bord</h1>
        </div>
        <div class="flex-none">
            <div class="textfield-line">
                <label for="search"><i class="fa-solid fa-magnifying-glass"></i></label>
                <input type="text" placeholder="Rechercher..." class="focus:outline-none" role="searchbox">
            </div>
        </div>
    </div>
    <div class="entry-content">
        {{-- Alert message --}}
        <div id="alert-box_dashboard">
            <div class="flex items-center">
                <div class="flex-1 inline-flex items-center">
                    <i class="fa-solid fa-star mr-3"></i>
                    <p>Bienvenue sur votre nouveau site AÜGUR, si vous avez besoin d'aide n'hésitez pas à nous contacter !</p>
                </div>
                <div class="flex-none">
                    <button onclick="" class="btn-outline_primary">Contacter le support<i class="fa-solid fa-circle-question ml-3"></i></button>
                </div>
            </div>
        </div>

        {{-- Grids --}}
        <div class="grid grid-cols-4 gap-10 mt-9">
            <div class="dash-grid_item row-span-2">
                TESt
            </div>
            <div class="dash-grid_item text-center">
                <h2><i class="fa-solid fa-calendar-week mr-3"></i>{{ $evenements->count() }}</h2>
                <p>Événements</p>
            </div>
            <div class="dash-grid_item col-span-2">
                <div class="flex items-center">
                    <div class="flex-none">
                        <div id="grid_picture" style="background-image: url('{{ asset('images/assets/add_evenments.jpg') }}')"></div>
                    </div>
                    <div class="flex-1 ml-5">
                        <h3>Vous n'avez pas d'événements en cours</h3>
                        <p>Lorsque vous avez des événements en cours, vous pourrez suivre en temps réel leurs statuts et le nombre de participants directement ici.</p>
                    </div>
                </div>
            </div>
            <div class="dash-grid_item text-center">
                <h2><i class="fa-solid fa-ribbon mr-3"></i>{{ $labels->count() }}</h2>
                <p>Labels</p>
            </div>
            <div class="dash-grid_item text-center">
                <h2><i class="fa-solid fa-users mr-3"></i>{{ $customers->count() }}</h2>
                <p>Clients</p>
            </div>
            <div class="dash-grid_item text-center">
                <h2><i class="fa-solid fa-leaf mr-3"></i>14</h2>
                <p>Produits</p>
            </div>
        </div>

        {{-- Recent activity --}}
        <div class="title-line_big">
            <h2>Activité récente</h2>
            <hr/>
        </div>
        @foreach($activities as $activity)
            <div class="list-box mt-2">
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
                    <div class="flex-none">
                        <p class="text-gray-500">{{ $activity->getDate() }}</p>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</div>
