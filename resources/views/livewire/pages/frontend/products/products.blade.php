<div class="container mx-auto">
    <div class="inline-flex items-center">
        <a href="{{ route('fo.products') }}" class="btn-filled_secondary mr-3"><i class="fa-solid fa-arrow-left"></i></a>
        <h1>{{ $univers->title }}</h1>
    </div>
    <div class="my-20">
        @if($products->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($products as $product)
                    <div class="product_thumbnail group/item hover:shadow-lg cursor-pointer" role="button" data-href="{{ route('fo.products.single', ['id' => $product->id]) }}">
                        <span class="helper animate-pulse group/icon invisible group-hover/item:visible"><i class="fa-solid fa-arrow-up-right-from-square"></i></span>
                        <div class="product_thumbnail-content force-center">
                            @if($product->picture)
                                <img src="{{ asset('storage/products/'. $product->picture) }}"/>
                            @else
                                <img src="{{ asset('storage/medias/none_picture.svg') }}"/>
                            @endif
                            <p>{{ $product->title }}</p>
                        </div>
                        @if(count($product->getLabelLink()) > 0)
                            <div class="product_thumbnail-labels px-auto inline-flex">
                                <div class="mx-auto flex items-center">
                                    @foreach($product->getLabelLink() as $labels)
                                        @if($labels)
                                            <img src="{{ asset('storage/medias/'. $labels->getPicture()) }}" class="px-1"/>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
            <div class="mt-10">
                {{ $products->links() }}
            </div>
        @else
            <p class="text-center bg-gray-100 py-2 rounded-lg">Il n'y a aucun produits dans cet univers</p>
        @endif
    </div>
</div>
