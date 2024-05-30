@extends('frontend.layouts.layout')

@section('title', 'Liste de nos labels')

@section('main-content')

    <div style="margin-top: 60px;" class="mb-5">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-nav mt-5 p-3 rounded-3 shadow">
                <li class="breadcrumb-item"><a href="{{ route('index') }}"><i class="fa-solid fa-home"></i></a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Nos labels</li>
            </ol>
        </nav>
    </div>

    <div class="text-center" data-aos="fade-left">
        <h1 class="mb-3">Nos labels</h1>
        <h3 class="mb-5">Des labels certifiés</h3>

        @include('frontend.specific.labels.partials.cards')

        <div class="pagination justify-content-center">
            {{ $labels->links() }}
        </div>
    </div>

@endsection
