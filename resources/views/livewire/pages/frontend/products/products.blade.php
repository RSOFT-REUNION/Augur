<div class="container mx-auto">
    <div class="inline-flex items-center">
        <a href="{{ route('fo.products') }}" class="btn-filled_secondary mr-3"><i class="fa-solid fa-arrow-left"></i></a>
        <h1>{{ $univers->title }}</h1>
    </div>
    <div class="my-20">
        @if($products->count() > 0)
        @else
            <p class="text-center bg-gray-100 py-2 rounded-lg">Il n'y a aucun produits dans cet univers</p>
        @endif
    </div>
</div>
