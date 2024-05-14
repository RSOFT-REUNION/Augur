@extends('frontend.layouts.layout')

@section('title', 'Liste de nos labels')

@section('main-content')

    <h1 style="text-align: center;">Nos labels</h1>
    <h4 style="text-align: center;" class="mb-5">Des labels certifiés</h4>

    @include('frontend.specific.labels.partials.cards')

    <div class="pagination justify-content-center">
        {{ $labels->links() }}
    </div>

@endsection
