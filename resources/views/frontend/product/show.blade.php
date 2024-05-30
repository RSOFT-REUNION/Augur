@extends('frontend.layouts.layout')

@section('title', $produit->name)

@section('main-content')

    <div style="margin-top: 60px;" class="mb-5">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-nav mt-5 p-3 rounded-3 shadow">
                <li class="breadcrumb-item"><a href="{{ route('index') }}"><i class="fa-solid fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ route('product.fisrt_category_list') }}">Nos Produits</a></li>
                @if(@getCategoryParentInfo($produit->category->category_id))
                    @if(@getCategoryParentInfo(getCategoryParentInfo($produit->category->category_id)->category_id) != null)
                        <li class="breadcrumb-item"><a href="/nos-produits/{{ getCategoryParentInfo(getCategoryParentInfo($produit->category->category_id)->category_id)->slug }}">{{ getCategoryParentInfo(getCategoryParentInfo($produit->category->category_id)->category_id)->name }}</a></li>
                    @endif
                    <li class="breadcrumb-item"><a href="/nos-produits/{{ getCategoryParentInfo($produit->category->category_id)->slug }}">{{ getCategoryParentInfo($produit->category->category_id)->name }}</a></li>
                @endif
                @if($produit->category)
                    <li class="breadcrumb-item"><a href="/nos-produits/{{ $produit->category->slug }}">{{ $produit->category->name }}</a></li>
                @endif
                <li class="breadcrumb-item active text-white" aria-current="page">{{ $produit->name }}</li>
            </ol>
        </nav>
    </div>

    <div class="position-relative">
        <h1 class="text-center mb-5"  data-aos="flip-up">{{ $produit->name }}</h1>
        <div class="position-absolute top-0" style="right: 25px;">
            <button class="btn btn-warning rounded-5" data-bs-toggle="modal" data-bs-target="#composition"><i class="fa-solid fa-circle-info"></i></button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="composition" tabindex="-1" aria-labelledby="composition" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Ingrédients, Allergènes, etc...</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {!! nl2br($produit->composition) !!}
                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="row">
        <div class="col-md-5 col-12" data-aos="fade-up-right">
            @foreach($produit->images as $image)
                @if($image->id == $produit->fav_image)
                    <img src="{{ $image->getImageUrl() }}" class="img-fluid" alt="{{ $produit->name }}">
                @endif
            @endforeach
        </div>
        <div class="col-md-7 col-12" data-aos="fade-left">
            <h4 class="text-center mb-5">{{ $produit->short_description }}</h4>
            <div class="row row-cols-2 align-items-center mb-4">
                <div class="col">
                    <p>
                        Ref: {{ $produit->code_article }}<br>
                        Stock : {{ formatStockToFloat($produit->stock) }}<br>
                        @if($produit->stock_unit == 'unit')
                            Poids à l'unité : {{ formatPriceToFloat($produit->weight) .' '. $produit->weight_unit }}
                        @endif
                    </p>
                </div>
                <div class="col text-center"><h1>{{ formatPriceToFloat($produit->price_ttc) }} €</h1></div>
            </div>

            <div class="text-center mb-4">
                @if($produit->stock > 0)
                    <form>  @csrf
                        <button type="button" class="btn btn-primary btn-lg hvr-grow-shadow hvr-icon-buzz-out" id="add_cart"
                                hx-post="{{ route('cart.add_product', $produit) }}"
                                hx-target="#nb_produit"
                                hx-swap="outerHTML"><i class="fa-solid fa-cart-plus hvr-icon"></i> Ajouter au panier
                        </button>
                    </form>
                @else
                    <h4 class="text-bg-danger rounded-3 w-50 p-2 mx-auto">Produit en rupture de stock</h4>
                @endif
            </div>

            <div class="text-center mb-4">
                @foreach($produit->labels as $label)
                    <img src="{{ getImageUrl('/upload/specific/labels/'.$label->image, 150, 150, 'fill-max') }}" class="mb-3 p-3 hvr-rotate" alt="{{ $label->image }}">
                @endforeach
            </div>
        </div>
    </div>

    <hr>

    {!! $produit->content !!}


@endsection
