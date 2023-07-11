@extends('layouts.backend')

@section('content-template')
    <main role="main" id="backend_content">
        <form method="POST" enctype="multipart/form-data">
            @csrf
            <div class="entry-header flex items-center">
                <div class="flex-1 inline-flex items-center">
                    <a href="{{ route('bo.setting.shop') }}" class="btn-icon_secondary mr-3"><i class="fa-solid fa-arrow-left"></i></a>
                    <h1>Magasin - {{ $shop->title }}</h1>
                </div>
            </div>
            <div class="entry-content mb-10">
                <button type="submit" id="btn_floating"><i class="fa-solid fa-floppy-disk mr-3"></i>Sauvegarder</button>
                <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                <div class="textfield">
                    <label for="title">Nom du magasin<span class="text-red-500">*</span></label>
                    <input type="text" id="title" name="title" placeholder="Entrez le nom du magasin" class="@if($errors->has('title'))textfield-error @endif" value="{{ $shop->title }}">
                    @if($errors->has('title'))
                        <p class="text-input-error">{{ $errors->first('title') }}</p>
                    @endif
                </div>
                <div class="textfield mt-2">
                    <label for="address">Adresse du magasin<span class="text-red-500">*</span></label>
                    <input type="text" id="address" name="address" placeholder="Entrez le nom du magasin" class="@if($errors->has('address'))textfield-error @endif" value="{{ $shop->address }}">
                    @if($errors->has('address'))
                        <p class="text-input-error">{{ $errors->first('address') }}</p>
                    @endif
                </div>
                <div class="flex mt-2">
                    <div class="flex-1 mr-2">
                        <div class="textfield">
                            <label for="postal_code">Code postale<span class="text-red-500">*</span></label>
                            <input type="text" id="postal_code" name="postal_code" placeholder="Entrez le code postale" class="@if($errors->has('postal_code'))textfield-error @endif" value="{{ $shop->postal_code }}">
                            @if($errors->has('postal_code'))
                                <p class="text-input-error">{{ $errors->first('postal_code') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="flex-1 ml-2">
                        <div class="textfield">
                            <label for="city">Ville<span class="text-red-500">*</span></label>
                            <input type="text" id="city" name="city" placeholder="Entrez le nom de la ville" class="@if($errors->has('city'))textfield-error @endif" value="{{ $shop->city }}">
                            @if($errors->has('city'))
                                <p class="text-input-error">{{ $errors->first('city') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <h2>Horaires du magasin</h2>
                    <textarea name="schedules" class="tiny">{{ $shop->schedules }}</textarea>
                </div>
                <div class="mt-3">
                    <h2>Contenu de la page</h2>
                    <textarea name="page_content" class="tiny">{{ $shop->page_content }}</textarea>
                </div>
            </div>
        </form>

    </main>
@endsection
