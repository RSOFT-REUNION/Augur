@extends('frontend.layouts.layout')

@section('title', 'Liste de nos labels')

@section('main-content')

    <div style="margin-top: 60px;" class="mb-5">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-nav mt-5 p-3 rounded-3 shadow">
                <li class="breadcrumb-item"><a href="{{ route('index') }}"><i class="fa-solid fa-home"></i></a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Nos Animations</li>
            </ol>
        </nav>
    </div>

    <h1 style="text-align: center;">Nos Animations</h1>
    <h4 style="text-align: center;" class="mb-5">Ateliers et événements</h4>

    <div class="row row-flex">
        @foreach($animations_encours as $animation)
            <div class="col-12 col-md-3 content hvr-grow rounded-4">
                <a data-bs-toggle="modal" data-bs-target="#old{{ $animation->id }}">
                    <div class="card bg-dark text-white rounded-4">
                        <img class="rounded-4" src="/storage/upload/specific/animations/{{ $animation->image }}" alt="{{ $animation->name }}">
                        <div class="card-img-overlay">
                            <h5 class="card-title pe-2 ps-2">{{ $animation->name }}</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="modal fade" id="old{{ $animation->id }}" tabindex="-1" aria-labelledby="old{{ $animation->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $animation->name }}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <img class="rounded-4 w-100" src="/storage/upload/specific/animations/{{ $animation->image }}" alt="{{ $animation->name }}">
                            <div class="p-3 mt-3">
                                {!! $animation->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <hr>
    <h4 style="text-align: center;" class="mb-5">Nos prochaines animations !</h4>
    <div class="row row-flex">
        @foreach($animations_avenir as $animation)
            <div class="col-12 col-md-3 content hvr-grow rounded-4">
                <a data-bs-toggle="modal" data-bs-target="#old{{ $animation->id }}">
                    <div class="card bg-dark text-white rounded-4">
                        <img class="rounded-4" src="/storage/upload/specific/animations/{{ $animation->image }}" alt="{{ $animation->name }}">
                        <div class="card-img-overlay">
                            <h5 class="card-title pe-2 ps-2">{{ $animation->name }}</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="modal fade" id="old{{ $animation->id }}" tabindex="-1" aria-labelledby="old{{ $animation->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $animation->name }}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <img class="rounded-4 w-100" src="/storage/upload/specific/animations/{{ $animation->image }}" alt="{{ $animation->name }}">
                            <div class="p-3 mt-3">
                                {!! $animation->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>


    <hr>
    <h4 style="text-align: center;" class="mb-5">Retour sur nos précédentes animations !</h4>
    <div class="row row-flex">
        @foreach($animations_old as $animation)
            <div class="col-12 col-md-3 content hvr-grow rounded-4">
                <a data-bs-toggle="modal" data-bs-target="#old{{ $animation->id }}">
                    <div class="card bg-dark text-white rounded-4">
                        <img class="rounded-4" src="/storage/upload/specific/animations/{{ $animation->image }}" alt="{{ $animation->name }}">
                        <div class="card-img-overlay">
                            <h5 class="card-title pe-2 ps-2">{{ $animation->name }}</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="modal fade" id="old{{ $animation->id }}" tabindex="-1" aria-labelledby="old{{ $animation->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $animation->name }}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <img class="rounded-4 w-100" src="/storage/upload/specific/animations/{{ $animation->image }}" alt="{{ $animation->name }}">
                            <div class="p-3 mt-3">
                                {!! $animation->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection
