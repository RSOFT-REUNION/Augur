@extends('backend.layouts.layout')
@section('title', __('Gestion des produits') )

@section('main-content')

    <div class="row m-2">
        <div class="col">

            @can('catalog.products.create')
                <div class="d-flex gap-2 justify-content-end mb-3 me-5">
                    <button
                        hx-target="#modal-create"
                        hx-trigger="click"
                        data-bs-toggle="modal"
                        data-bs-target="#modal-create"
                        class="btn btn-success hvr-float-shadow"><i class="fa-solid fa-plus">
                        </i> Ajouter un produit
                    </button>
                </div>
                @include('backend.catalog.product.create')
            @endcan

            <div class="card border-left-primary shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Liste des produits</h6>

                </div>

                <div class="card-body">
                    <div class="table-responsive mb-3">
                        <table id="datatable" class="table datatable table-hover table-bordered w-100">
                            <thead>
                            <tr>
                                <th scope="col" class="text-center" style="width: 5%;">#</th>
                                <th scope="col" class="text-center">Image</th>
                                <th scope="col" class="text-center">Nom</th>
                                <th scope="col" class="text-center">Catégorie</th>
                                <th scope="col" class="text-center">Prix</th>
                                <th scope="col" class="text-center">Poids</th>
                                <th scope="col" class="text-center" style="width: 8%;"><i
                                        class="fa-duotone fa-arrows-minimize"></i></th>
                            </tr>
                            </thead>

                            @foreach ($products as $product)
                                <tr>
                                    <td class="text-center align-middle">{{ $product->id }}</td>
                                    <td class="text-center align-middle">
                                        {{ $product->getFristImages($product) }}
                                    </td>
                                    <td class="text-center align-middle">{{ $product->name }} <br> <span class="fw-lighter fst-italic">url: {{ $product->slug }}</span> </td>
                                    <td class="text-center align-middle">{{ $product->getCategoryName($product->category_id) }}</td>
                                    <td class="text-center align-middle">{{ $product->price }}</td>
                                    <td class="text-center align-middle">{{ $product->size }}</td>
                                    <td class="text-center align-middle">
                                        @can('catalog.products.update')
                                            <a href="{{ route('backend.catalog.products.edit', $product->id) }}"
                                               class="btn btn-success btn-sm hvr-grow" title="Modifier"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>
                                        @endcan
                                        @can('catalog.products.delete')
                                            <button type="button" class="btn btn-danger btn-sm hvr-grow"
                                                    title="Supprimer"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal{{ $product->id }}">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        @endcan
                                    </td>
                                </tr>
                                @include('backend.layouts.modal-delete', ['id' => $product->id, 'title' => 'Êtes-vous sûr de vouloir supprimer le produit '.$product->name.' ?', 'route' => 'backend.catalog.products.destroy'])
                            @endforeach
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection