<div id="images_list">
    @foreach($products->images as $image)
        <div id="image{{ $image->id }}" class="text-center mb-3 w-100 hvr-grow">
            <img src="{{ $image->getImageUrl() }}" alt="{{ $image->image_name }}" class="w-auto mx-auto d-block" style="max-height: 150px;">

            <button type="button" class="btn btn-danger w-50 mt-2"
                    hx-delete="{{ route('backend.catalog.products.destroy_image', $image) }}"
                    hx-target="#image{{ $image->id }}"
                    hx-swap="delete"
            ><span class="htmx-indicator spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Supprimer
            </button>

            @if($image->id != $products->fav_image)
                <button type="button" class="btn btn-primary position-absolute top-0 end-0 me-2 mt-2" id="fav_image"
                        hx-post="{{ route('backend.catalog.products.fav_image', $image) }}"
                        hx-target="#images_list"
                        hx-swap="outerHTML"
                ><i class="fa-regular fa-star"></i></button>
            @else
                <div class="btn btn-primary position-absolute top-0 end-0 me-2 mt-2"><i class="fa-solid fa-star"></i></div>
            @endif
        </div>
    @endforeach
</div>
