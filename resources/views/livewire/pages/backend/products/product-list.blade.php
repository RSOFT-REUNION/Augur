<div>
    <div class="entry-header flex items-center">
        <div class="flex-1">
            <h1>Produits</h1>
        </div>
        <div class="flex-none inline-flex items-center">
            <div class="textfield-line">
                <label for="search"><i class="fa-solid fa-magnifying-glass"></i></label>
                <input type="text" placeholder="Rechercher..." wire:model="search" class="focus:outline-none" role="searchbox">
            </div>
            <p class="bg-gray-100 block py-2 px-4 rounded-lg ml-2">0</p>
        </div>
    </div>
    <div class="entry-content">
        <div class="container-float">
            <button wire:click="$emit('openModal', 'popups.backend.products.import-product')" class="btn-container-float-gray mr-2" title="Importer"><i class="fa-solid fa-upload"></i></button>
            <button onclick="Livewire.emit('openModal', 'popups.backend.products.add-product')" class="btn-container-float"><i class="fa-solid fa-plus mr-3"></i>Ajouter</button>
        </div>
        <form wire:submit.prevent="updateDescription">
            <div class="textfield">
                <label for="short_description">Description courte de présentation</label>
                <textarea wire:model="short_description" id="short_description" placeholder="Entrez une description courte qui sera affiché dans votre page">@if($description) {{ $description->content }} @endif</textarea>
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
                    <a wire:click="$emit('openModal', 'popups.backend.products.add-univers')" class="btn-filled_secondary">Ajouter un univers</a>
                </div>
            </div>
            <p class="">Vous pouvez ajouter jusqu'à 4 univers, chacun des univers est modifiable, cependant la clé unique de celui-ci ne peut changer.</p>
            <div class="grid grid-cols-4 gap-4 mt-5">
                @foreach($univers as $uni)
                    <div class="flex flex-col">
                        <div class="flex-none force-center">
                            <img src="{{ asset('storage/medias/'. $uni->getPicture()) }}" style="height: 500px; border-radius: 10px">
                        </div>
                        <div class="flex-1 text-center mt-3 bg-gray-100 rounded-lg py-2">
                            <h3 class="text-xl">{{ $uni->title }}</h3>
                            <div class="inline-flex items-center">
                                <a wire:click="deleteUnivers({{ $uni->id }})" class="btn-icon_transparent"><i class="fa-solid fa-trash"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        {{-- Fin des univers --}}

        <div class="my-5">
            @if($products->count() > 0)
                <div class="table-primary">
                    <table>
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom du produit</th>
                            <th>Étiquettes</th>
                            <th>Labels</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->title }}</td>
                                <td>
                                    <div class="inline-flex items-center">
                                        @foreach($product->getTags() as $tag)
                                            <p class="text-sm bg-gray-200 px-2 py-1 rounded-lg mr-1">{{ $tag }}</p>
                                        @endforeach
                                    </div>
                                </td>
                                <td>
                                    <div class="inline-flex items-center">
                                        @foreach($product->getLabels() as $label)
                                            <p class="text-sm bg-gray-200 px-2 py-1 rounded-lg mr-1">{{ $label }}</p>
                                        @endforeach
                                    </div>
                                </td>
                                <td>
                                    {{--                                <a href="" class="btn-icon_transparent"><i class="fa-solid fa-pen-to-square"></i></a>--}}
                                    <a wire:click="deleted({{ $product->id }})" class="btn-icon_transparent cursor-pointer"><i class="fa-solid fa-trash-can"></i></a>
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
