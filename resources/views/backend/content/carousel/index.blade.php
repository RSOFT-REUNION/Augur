@extends('backend.layouts.layout')
@section('title', __('Gestion des images du carrousel') )

@section('main-content')

    <div class="row m-2">
        <div class="col">
            <div class="card border-left-primary shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Liste des images du carrousel</h6>
                    @can('content.carousel.create')
                        <div class="d-flex gap-2 justify-content-end">
                            <a data-bs-toggle="modal" data-bs-target="#addModal"
                               class="btn btn-success my-2 hvr-grow"><i class="fa-solid fa-plus"></i> Ajouter une images</a>
                        </div>
                        @include('backend.content.carousel.create')
                    @endcan
                </div>

                <div class="card-body">
                    <div class="mb-3">

                        <div class="row row-flex">
                            @foreach ($sliders as $slide)
                                <div class="col-3 content">
                                    <div class="card mb-3">
                                        <img class="card-img-top" src="/storage/upload/content/carousel/{{ $slide->image }}" alt="{{ $slide->name }}">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $slide->name }}</h5>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-center">
                                                @can('content.pages.update')
                                                    <button type="button"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editModal{{ $slide->id }}"
                                                       class="btn btn-success btn-sm" title="Modifier"><i
                                                            class="fa-solid fa-pen-to-square"></i></button>
                                                @endcan
                                                @can('content.pages.delete')
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                            title="Supprimer"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#deleteModal{{ $slide->id }}">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                @endcan
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @include('backend.content.carousel.edit')
                                @include('backend.layouts.modal-delete', ['id' => $slide->id, 'title' => 'Êtes-vous sûr de vouloir supprimer l\'image '.$slide->name.' ?', 'route' => 'backend.content.carrousel.destroy'])
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
