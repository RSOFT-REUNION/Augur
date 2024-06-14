@extends('backend.layouts.layout')
@section('title', __('Gestion des catégories') )

@section('main-content')

    <div class="row m-2">
        <div class="col">
            <div class="d-flex gap-2 justify-content-end mb-3 me-5">
                @can('catalog.categories.import')
                    <button type='button' class="btn btn-info hvr-float-shadow text-white" data-bs-toggle="modal" data-bs-target="#importModal">
                        <i class="fa-solid fa-file-import"></i>&nbsp;Importation
                    </button>
                    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Importer un fichier</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('backend.catalog.categories.import') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="input-group mb-3">
                                            <input type="file" name="csv" class="form-control" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                            <button class="btn btn-primary" type="submit">Envoyer</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endcan
                @can('catalog.categories.create')
                        <a href="{{ route('backend.catalog.categories.create') }}"
                           class="btn btn-success hvr-float-shadow"><i class="fa-solid fa-plus"></i> Ajouter une catégorie</a>
                @endcan
            </div>

            <div class="card border-left-primary shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Liste des Catégories</h6>
                </div>

                <div class="card-body">
                    <div class="table-responsive mb-3">
                        <table id="datatable" class="table datatable table-hover table-bordered w-100">
                            <thead>
                            <tr>
                                <th scope="col" class="text-center" style="width: 5%;">#</th>
                                <th scope="col" class="text-center">Image</th>
                                <th scope="col" class="text-center">Nom</th>
                                <th scope="col" class="text-center">Slug</th>
                                <th scope="col" class="text-center">Catégorie</th>
                                <th scope="col" class="text-center" width="5%">Produits</th>
                                <th scope="col" class="text-center" width="5%">Menu</th>
                                <th scope="col" class="text-center" width="5%">Activé</th>
                                <th scope="col" class="text-center" style="width:8%;"><i
                                        class="fa-duotone fa-arrows-minimize"></i></th>
                            </tr>
                            </thead>

                            @foreach ($categories as $category)
                                <tr>
                                    <td class="text-center">{{ $category->id }}</td>
                                    <td class="text-center align-middle">
                                        @if($category->image != null)
                                            <img src="{{ getImageUrl('/upload/catalog/category/'.$category->image, 50, 50) }}" alt="{{ $category->name  }}">
                                        @endif
                                    </td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>{{ $category->getCategoryName($category->category_parent_id) }}</td>
                                    <td  class="text-center align-middle">{{ count($category->products->where('active', 1)) }}</td>
                                    <td  class="text-center align-middle">{{ getActive($category->is_menu) }}</td>
                                    <td  class="text-center align-middle">{{ getActive($category->active) }}</td>
                                    <td class="text-center">
                                        @can('catalog.categories.edit')
                                            <a href="{{ route('backend.catalog.categories.edit', $category->id) }}"
                                               class="btn btn-success btn-sm hvr-grow" title="Modifier"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>
                                        @endcan
                                        @can('catalog.categories.delete')
                                            <button type="button" class="btn btn-danger btn-sm hvr-grow"
                                                    title="Supprimer"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal{{ $category->id }}">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        @endcan
                                    </td>
                                </tr>
                                @foreach ($category->childrenCategories as $childCategory)
                                    @include('backend.catalog.category.child_category', ['child_category' => $childCategory])
                                    @include('backend.layouts.modal-delete', ['id' => $childCategory->id, 'title' => 'Êtes-vous sûr de vouloir supprimer '.$childCategory->name.' et toutes les sous-catégories ?', 'route' => 'backend.catalog.categories.destroy'])
                                @endforeach
                                @include('backend.layouts.modal-delete', ['id' => $category->id, 'title' => 'Êtes-vous sûr de vouloir supprimer '.$category->name.' et toutes les sous-catégories ?', 'route' => 'backend.catalog.categories.destroy'])
                            @endforeach

                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
