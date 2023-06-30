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
            <button wire:click="" class="btn-container-float-gray mr-2" title="Importer"><i class="fa-solid fa-upload"></i></button>
            <button onclick="Livewire.emit('openModal', 'popups.backend.products.add-product')" class="btn-container-float"><i class="fa-solid fa-plus mr-3"></i>Ajouter</button>
        </div>


    </div>
</div>
