<div class="container mx-auto">
    <div class="text-center">
        <h1>Nos produits</h1>
        <h3>Des choix de grande qualité</h3>
    </div>
    <div class="">
    </div>
    <div class="my-20">
        {{--<div class="textfield-line width-500 mb-5">
            <label for="search"><i class="fa-solid fa-magnifying-glass"></i></label>
            <input type="text" placeholder="Rechercher..." wire:model="search" class="focus:outline-none bg-white" role="searchbox">
        </div>--}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-10">
            @foreach($products as $product)
                <div class="front-grid_product">
                    <div class="flex flex-col h-full">
                        <div class="flex-1 flex h-full">
                            <div class="mx-auto">
                                @if($product->picture != null)
                                    <img src="{{ asset('storage/products/'. $product->picture) }}"/>
                                @else
                                    <img src="{{ asset('storage/medias/none_picture.svg') }}"/>
                                @endif
                            </div>
                        </div>
                        <div class="flex-none py-3 px-5">
                            <div class="inline-flex items-center mb-3">
                                @foreach($labels as $label)
                                    @foreach($product->getLabels() as $lab)
                                        @if($lab == $label->title)
                                            <object data="{{ asset('storage/medias/'. $label->getPicture()) }}" width="100px"></object>
                                        @endif
                                    @endforeach
                                @endforeach
                            </div>
                            <h2>{{ $product->title }}</h2>
                            <!--
                            <div class="inline-flex items-center mb-3">
                                @if(count($product->getTags()) > 0)
                                    @foreach($product->getTags() as $tag)
                                        @if($tag == 'BIO')
                                            <object data="{{ asset('images/assets/icon_bio.svg') }}" width="50px"></object>
                                        @endif
                                        @if($tag == 'VEGAN')
                                            <object data="{{ asset('images/assets/icon_vegan.svg') }}" width="50px"></object>
                                        @endif
                                        @if($tag != 'BIO' && $tag != 'VEGAN')
                                            <span class="bg-gray-100 mr-1 px-2 py-1 rounded-lg">
                                                {{ $tag }}
                                            </span>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                            -->
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-5">
            {{ $products->links() }}
        </div>

    </div>
</div>
