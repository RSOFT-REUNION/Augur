@extends('layouts.frontend')

@section('content-template')
    <main role="main">
        @livewire('pages.frontend.products.products', ['univers' => $univers])
    </main>
@endsection
