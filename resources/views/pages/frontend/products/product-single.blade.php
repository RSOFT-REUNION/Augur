@extends('layouts.frontend')

@section('content-template')
    <div class="container mx-auto">
        <div class="">
            <a href="{{ route('fo.products') }}" class="btn-filled_secondary"><i class="fa-solid fa-arrow-left"></i></a>
        </div>
        <div class="flex flex-col items-center">
            <div class="flex-1 my-10">
                <div class="force-center">
                    <img src="{{ asset('storage/products/'. $product->picture) }}" width="500px"/>
                </div>
            </div>
            <div class="flex-2">
                <div class="border-solid flex flex-col gap-8 h-[315px] shrink-0 border-[#E8E8E8] border rounded-lg">
                    <div class="bg-[#E8E8E8] flex flex-col mb-1 items-start pt-1 pb-2 px-4 rounded-tl-lg rounded-tr-lg">
                        <div class="whitespace-nowrap text-4xl font-['Roboto_Condensed'] font-medium leading-[52px] w-1/2">
                            {{ $product->title }}
                        </div>
                    </div>
                @foreach ($product->getLabelLink() as $product_label)
                    <div class="flex gap-2 flex-wrap items-center ml-20 mr-24">
                        <a href="{{ route('fo.label', ['slug' => $product_label->slug]) }}"><img src="{{ asset('storage/medias/'. $product_label->getPicture()) }}" width="100px"/></a>
                    </div>
                    <div class="flex flex-row items-center ml-12 mr-16">
                        <div class="relative flex flex-col w-[351px] items-end">
                            <div class="text-center w-1/2 font-['Korolev'] font-medium leading-[16px] text-[#1b2e47] absolute top-0 left-0 h-4">
                                {{ $product_label->labels }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
