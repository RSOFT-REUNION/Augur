<div id="popup-search">
    <div class="entry-header">
        <form>
            @csrf
            <div class="textfield-front-search">
                <label for=""><i class="fa-solid fa-magnifying-glass"></i></label>
                <input type="text" wire:model.live="search" placeholder="Rechercher un produit, un label, une animation.." class="focus:outline-none">
            </div>
        </form>
    </div>
    @if(count($this->jobsLabel) > 0 || count($this->jobsEvenement) > 0 || count($this->jobsProduct) || count($this->jobsRecipe))
        <div class="entry-content">
            @if(count($this->jobsLabel) > 0)
                <div class="mb-5">
                    <h2>Les labels</h2>
                    <div class="mt-4 grid grid-cols-4 gap-4">
                        @foreach($jobsLabel as $label)
                            <div class="small-label" role="button" data-href="{{ route('fo.label', ['slug' => $label->slug]) }}">
                                <div class="flex flex-col h-full">
                                    <div class="flex-1 flex h-full">
                                        <div class="m-auto">
                                            <img src="{{ asset('storage/medias/'. $label->getPicture()) }}"/>
                                        </div>
                                    </div>
                                    <div class="flex-none">
                                        <h3>{{ $label->title }}</h3>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            @if(count($this->jobsEvenement) > 0)
                <div>
                    <h2>Les animations</h2>
                    <div class="mt-4">
                        <ul>
                            @foreach($jobsEvenement as $evenement)
                                <li class="small-evenement">
                                    <div class="flex items-center" role="button" data-href="{{ route('fo.evenements') }}">
                                        <div class="flex-none">
                                            <img src="{{ asset('storage/medias/'. $evenement->getPicture()) }}" loading="lazy"/>
                                        </div>
                                        <div class="flex-1">
                                            <p>{{ $evenement->title }}</p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            @if(count($this->jobsProduct) > 0)
                <div>
                    <h2>Les produits</h2>
                    <ul class="mt-4">
                        @foreach($jobsProduct as $product)
                            <li class="small-evenement mb-1">
                                <div class="flex items-center" role="button" data-href="{{ route('fo.products.single', ['id' => $product->id]) }}">
                                    <div class="flex-none">
                                        @if($product->picture != null)
                                            <img src="{{ asset('storage/products/'. $product->picture) }}" loading="lazy"/>
                                        @else
                                            <img src="{{ asset('storage/medias/none_picture.svg') }}" loading="lazy"/>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <p>{{ $product->title }}</p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(count($this->jobsRecipe) > 0)
                <div>
                    <h2>Les recettes</h2>
                    <ul class="mt-4">
                        @foreach($jobsRecipe as $recipe)
                            <li class="small-evenement mb-1">
                                <div class="flex items-center" role="button" data-href="{{ route('fo.recipes.single', ['id' => $recipe->id]) }}">
                                    <div class="flex-none">
                                        @if($recipe->media_id != null)
                                            <img src="{{ asset('storage/medias/'. $recipe->getPicture()) }}" loading="lazy"/>
                                        @else
                                            <img src="{{ asset('storage/medias/none_picture.svg') }}" loading="lazy"/>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <p>{{ $recipe->title }}</p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    @endif
</div>
