@extends('layouts.backend')

@section('content-template')
    <main role="main" id="backend_content">
        @livewire('pages.backend.recettes.recettes-list')
    </main>
@endsection
