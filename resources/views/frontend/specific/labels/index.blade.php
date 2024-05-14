@extends('frontend.layouts.layout')

@section('title', 'Liste de nos labels')

@section('main-content')
    <div class="text-center" data-aos="fade-left">
        <h1 class="mb-3">Nos labels</h1>
        <h4 class="mb-5">Des labels certifiés</h4>

        @include('frontend.specific.labels.partials.cards')

        <div class="pagination justify-content-center">
            {{ $labels->links() }}
        </div>
    </div>

@endsection
