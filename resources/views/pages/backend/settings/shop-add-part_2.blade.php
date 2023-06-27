@extends('layouts.backend')

@section('content-template')
    <main role="main" id="backend_content">
        <form method="POST" enctype="multipart/form-data">
            @csrf
            <div class="entry-header flex items-center">
                <div class="flex-1">
                    <h1>Magasin - {{ $shop->title }}</h1>
                </div>
            </div>
            <div class="entry-content">
                <button type="submit" id="btn_floating"><i class="fa-solid fa-floppy-disk mr-3"></i>Sauvegarder</button>
                <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                <div>
                    <h2>Horaires du magasin</h2>
                    <textarea name="schedules" class="tiny">{{ old('schedules') }}</textarea>
                </div>
                <div class="mt-3">
                    <h2>Contenu de la page</h2>
                    <textarea name="page_content" class="tiny">{{ old('page_content') }}</textarea>
                </div>
            </div>
        </form>

    </main>
@endsection
