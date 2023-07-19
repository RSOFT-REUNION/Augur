<div class="container mx-auto">
    <div class="inline-flex items-center">
        <a href="{{ route('fo.products') }}" class="btn-filled_secondary mr-3"><i class="fa-solid fa-arrow-left"></i></a>
        <h1>{{ $univers->title }}</h1>
    </div>
    <div class="my-20">
        @if($products->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                @foreach($products as $product)
                    <div class="product_thumbnail">
                        <div class="flex-none">
                            <img src="{{ asset('storage/products/'. $product->picture) }}"/>
                        </div>
                        <div class="flex-1 px-3 py-2">
                            <div class="mb-2">
                                @foreach($product->getLabels() as $labels)
                                    <span class="text-sm bg-gray-100 px-2 py-1 rounded-lg">{{ $labels }}</span>
                                @endforeach
                            </div>
                            <p>{{ $product->title }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center bg-gray-100 py-2 rounded-lg">Il n'y a aucun produits dans cet univers</p>
        @endif
    </div>
</div>
