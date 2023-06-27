@extends('layouts.backend')

@section('content-template')
    <main role="main" id="backend_content">
        <div class="entry-header flex items-center">
            <div class="flex-1">
                @if($label)
                    <h1>Modification du label: {{ $label->title }}</h1>
                @else
                    <h1>Ajout d'un label</h1>
                @endif
            </div>
        </div>
        <div class="entry-content">
            <form method="POST" enctype="multipart/form-data" action="@if($label) {{ route('bo.labels.edit.post', ['id' => $label->id]) }} @else {{ route('bo.labels.add.post') }} @endif">
                @csrf
                <button type="submit" id="btn_floating-blue">@if($label) <i class="fa-solid fa-pen-to-square mr-3"></i>Modifier mon label @else <i class="fa-solid fa-floppy-disk mr-3"></i>Sauvegarder mon label @endif</button>
                @if($label)
                    <input type="hidden" name="label_id" value="{{ $label->id }}">
                @endif
                <div class="textfield">
                    <label for="title">Nom du label<span class="text-red-500">*</span></label>
                    <input type="text" id="title" name="title" placeholder="Entrez le nom de votre label" class="@if($errors->has('title'))textfield-error @endif" value="@if($label){{ $label->title }}@else{{ old('title') }}@endif">
                    @if($errors->has('title'))
                        <p class="text-input-error">{{ $errors->first('title') }}</p>
                    @endif
                </div>
                <div class="textfield mt-2">
                    <label for="cover">Logo du label<span class="text-red-500">*</span></label>
                    <input type="file" id="cover" name="cover" class="@if($errors->has('cover'))textfield-error @endif" value="{{ old('cover') }}">
                    @if($errors->has('cover'))
                        <p class="text-input-error">{{ $errors->first('cover') }}</p>
                    @endif
                </div>
                <div class="textfield mt-2">
                    <label for="description">Contenu du label<span class="text-red-500">*</span></label>
                    <textarea name="description" id="description" class="tiny">@if($label) {{ $label_content }} @else {{ old('description') }} @endif</textarea>
                    @if($errors->has('description'))
                        <p class="text-input-error">{{ $errors->first('description') }}</p>
                    @endif
                </div>
            </form>
        </div>
    </main>
@endsection
