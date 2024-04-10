@extends('backend.layouts.layout')
@section('title', __('Gestion des produits') )

@section('main-content')

    <div class="row m-2">
        <div class="col">
            <div class="card border-left-primary shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Liste des produits</h6>
                    @can('catalog.products.create')
                        <div class="d-flex gap-2 justify-catalog-end">
                            <a href="{{ route('backend.catalog.products.create') }}"
                               class="btn btn-success my-2  hvr-grow"><i class="fa-solid fa-plus"></i> Ajouter un produit</a>
                        </div>
                    @endcan
                </div>

                <div class="card-body">
                    <div class="table-responsive mb-3">
                        <table id="datatable" class="table datatable table-hover table-bordered w-100">
                            <thead>
                            <tr>
                                <th scope="col" class="text-center" style="width: 5%;">#</th>
                                <th scope="col" class="text-center">Titre</th>
                                <th scope="col" class="text-center">Url</th>
                                <th scope="col" class="text-center">Catégorie</th>
                                <th scope="col" class="text-center">Description</th>
                                <th scope="col" class="text-center">Prix</th>
                                <th scope="col" class="text-center">Taille</th>
                                <th scope="col" class="text-center" style="width: 15%;"><i
                                        class="fa-duotone fa-arrows-minimize"></i></th>
                            </tr>
                            </thead>

                            @foreach ($products as $product)
                                <tr>
                                    <td class="text-center">{{ $product->id }}</td>
                                    <td>{{ $product->title }}</td>
                                    <td>{{ $product->slug }}</td>
                                    <td>{{ $product->getCategoryName($product->category_id) }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->size }}</td>
                                    <td class="text-center">
                                        @can('catalog.products.update')
                                            <a href="{{ route('backend.catalog.products.edit', $product->id) }}"
                                               class="btn btn-success btn-sm" title="Modifier"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>
                                        @endcan
                                        @can('catalog.products.delete')
                                            <button type="button" class="btn btn-danger btn-sm"
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
