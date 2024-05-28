@extends('backend.layouts.layout')
@section('title', __('Gestion des Promotions') )

@section('main-content')

    <div class="row m-2">
        <div class="col">

            @can('content.carousel.create')
                <div class="d-flex gap-2 justify-content-end mb-3 me-5">
                    <a href="{{ route('backend.catalog.discounts.create') }}"
                       class="btn btn-success hvr-float-shadow"><i class="fa-solid fa-plus"></i> Ajouter un produit</a>
                </div>
            @endcan

            <div class="card border-left-primary shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Liste des promotions</h6>
                </div>


            </div>
        </div>
    </div>
@endsection
