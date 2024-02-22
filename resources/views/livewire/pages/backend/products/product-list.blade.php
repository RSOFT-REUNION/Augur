<div>
    <div class="flex items-center entry-header">
        <div class="flex-1">
            <h1>Produits</h1>
        </div>
        <div class="inline-flex flex-none items-center">
            <div class="textfield-line">
                <label for="search"><i class="fa-solid fa-magnifying-glass"></i></label>
                <input type="text" placeholder="Rechercher..." wire:model.live="search" class="focus:outline-none" role="searchbox">
            </div>
            <p class="ml-2 block rounded-lg bg-gray-100 px-4 py-2">{{ $products->count() }}</p>
        </div>
    </div>
    <div class="entry-content">
        <div class="container-float">
            <button wire:click="$dispatch('openModal', { component: 'popups.backend.products.import-product' })" class="mr-2 btn-container-float-gray" title="Importer"><i class="fa-solid fa-upload"></i></button>
            <button onclick="Livewire.dispatch('openModal', { component: 'popups.backend.products.add-product' })" class="btn-container-float"><i class="mr-3 fa-solid fa-plus"></i>Ajouter</button>
        </div>
        <form wire:submit="updateDescription">
            <div class="textfield">
                <label for="short_description">Description courte de présentation</label>
                <textarea wire:model.live="short_description" id="short_description" placeholder="Entrez une description courte qui sera affiché dans votre page">@if($description) {{ $description->content }} @endif</textarea>
                @if($errors->has('short_description'))
                    <p class="text-input-error">{{ $errors->first('short_description') }}</p>
                @endif
            </div>
            @if($description)
                @if($description->content != $short_description)
                    @if($short_description)
                        <div class="mt-3">
                            <button type="submit" class="btn-filled_secondary">Enregistrer les modifications</button>
                        </div>
                    @endif
                @endif
            @else
                @if($short_description)
                    <div class="mt-3">
                        <button type="submit" class="btn-filled_secondary">Ajouter la description</button>
                    </div>
                @endif
            @endif

        </form>

        {{-- Ajout de la notion des univers --}}
        <div class="mt-5">
            <div class="flex items-center">
                <div class="flex-1">
                    <h2>Les univers de produits</h2>
                </div>
                <div class="flex-none">
                    <a wire:click="$dispatch('openModal', { component: 'popups.backend.products.add-univers' })" class="btn-filled_secondary">Ajouter un univers</a>
                </div>
            </div>
            <p class="">Vous pouvez ajouter jusqu'à 4 univers, chacun des univers est modifiable, cependant la clé unique de celui-ci ne peut changer.</p>
            <a id="univers_open" class="mt-3 block cursor-pointer rounded-lg border border-transparent bg-gray-100 py-2 text-center font-bold hover:border-gray-200">Afficher les univers</a>
            <div id="univers_close_container" class="hidden">
                <a id="univers_close" class="mt-3 block cursor-pointer rounded-lg border border-transparent bg-gray-100 py-2 text-center font-bold hover:border-gray-200">Masquer les univers</a>
            </div>
            <div id="univers_container" class="hidden">
                <div class="mt-5 grid grid-cols-4 gap-4">
                    @foreach($univers as $uni)
                        <div class="flex flex-col">
                            <div class="flex-none force-center">
                                <img src="{{ asset('storage/medias/'. $uni->getPicture()) }}" class="contain rounded-lg">
                            </div>
                            <div class="mt-3 flex-1 rounded-lg bg-gray-100 py-2 text-center">
                                <h3 class="text-xl">{{ $uni->title }}</h3>
                                <div class="inline-flex items-center">
                                    <a wire:click="deleteUnivers({{ $uni->id }})" class="btn-icon_transparent"><i class="fa-solid fa-trash"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        {{-- Fin des univers --}}

        <div class="my-10 pb-10">
            @if($products->count() > 0)
                <div class="table-primary">
                    <table>
                        <thead>
                        <tr>
                            <th><i class="fa-regular fa-image"></i></th>
                            <th>Nom du produit</th>
                            <th>Étiquettes</th>
                            <th>Labels</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td class="force-center"><img src="{{ asset('storage/products/'. $product->picture) }}" style="max-height: 50px; max-width: 70px"></td>
                                <td>{{ $product->title }}</td>
                                <td>
                                    <div class="inline-flex items-center">
                                        @foreach($product->getTags() as $tag)
                                            <p class="mr-1 rounded-lg bg-gray-200 px-2 py-1 text-sm">{{ $tag }}</p>
                                        @endforeach
                                    </div>
                                </td>
                                <td>
                                    @if(count($product->getLabels()) > 0)
                                        <div class="inline-flex items-center">
                                            @foreach($product->getLabels() as $label)
                                                <p class="mr-1 rounded-lg bg-gray-200 px-2 py-1 text-sm">{{ $label }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <a wire:click="$dispatch('openModal', { component: 'popups.backend.products.edit-product', arguments: {{ json_encode(['product' => $product->id]) }} })" class="btn-icon_transparent"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a wire:click="deleted({{ $product->id }})" class="cursor-pointer btn-icon_transparent"><i class="fa-solid fa-trash-can"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    @if(strlen($search) < 3)
                        {{ $products->links() }}
                    @endif
                </div>
            @else
                <p class="empty-text">Vous n'avez pas encore ajouté de produits</p>
            @endif
        </div>
    </div>
</div>

<script>
    $(document).ready(function ($) {
        //EVENTAIL
        $("#univers_open").click(function (){
            $("#univers_container").show();
            $("#univers_close_container").show();
            $("#univers_open").hide();
        })
        $("#univers_close").click(function (){
            $("#univers_container").hide();
            $("#univers_close_container").hide();
            $("#univers_open").show();
        })
    })
</script>
