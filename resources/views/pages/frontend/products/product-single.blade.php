@extends('layouts.frontend')

@section('content-template')
    <div class="container mx-auto py-10">
        <div class="">
            <a href="{{ route('fo.products') }}" class="btn-filled_secondary"><i class="fa-solid fa-arrow-left"></i></a>
        </div>
        <div class="flex flex-col items-center">
            <div class="flex-1 my-10">
                <div class="force-center">
                    <img src="{{ asset('storage/products/'. $product->picture) }}" width="500px"/>
                </div>
            </div>
            <div class="flex-none">
                <div class="border flex flex-col shrink-0 border-gray-100 rounded-lg min-w-[700px]">
                    <div class="bg-gray-100 flex flex-col mb-1 pt-1 pb-2 px-4 rounded-tl-lg rounded-tr-lg">
                        <div class="whitespace-nowrap text-4xl font-['Roboto_Condensed'] font-medium leading-[52px] text-center">
                            <h2>{{ $product->title }}</h2>
                        </div>
                    </div>
                    @if ($product->description)
                        <div class="my-10 flex flex-col items-center">
                            <div class="border-b border-secondary flex flex-col gap-y-7 items-start w-1/2 pb-10">
                                <h2 class="text-xl font-semibold">Description du produit :</h2>
                                <p>{{ $product->description }}</p>
                            </div>
                        </div>
                    @endif
                    @if(count($product->getLabelLink()) > 0)
                        <div class="flex items-center mx-auto gap-5 py-5">
                            @foreach ($product->getLabelLink() as $product_label)
                                <a href="{{ route('fo.label', ['slug' => $product_label->slug]) }}"><img src="{{ asset('storage/medias/'. $product_label->getPicture()) }}" style="height: 100px"/></a>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 my-5 text-center">Aucun label n'est lié à ce produit</p>
                    @endif
            </div>
        </div>
    </div>
@endsection
