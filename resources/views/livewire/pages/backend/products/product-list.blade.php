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
