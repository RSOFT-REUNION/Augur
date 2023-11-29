@extends('layouts.backend')

@section('content-template')
    <main role="main" id="backend_content">
        @livewire('pages.backend.recettes.recettes-add', ['temp' => $temp_recipe, 'recipe_id' => $recipe])
    </main>
@endsection
