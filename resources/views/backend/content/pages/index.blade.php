@extends('backend.layouts.layout')
@section('title', __('Gestion des pages') )

@section('main-content')

    <div class="row m-2">
        <div class="col">
            <div class="card border-left-primary shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Liste des pages</h6>
                    @can('content.pages.create')
                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('backend.content.pages.create') }}"
                               class="btn btn-success my-2  hvr-grow"><i class="fa-solid fa-plus"></i> Ajouter une
                                page</a>
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
                                <th scope="col" class="text-center" style="width: 15%;"><i
                                        class="fa-duotone fa-arrows-minimize"></i></th>
                            </tr>
                            </thead>

                            @foreach ($pages as $page)
                                <tr>
                                    <td class="text-center">{{ $page->id }}</td>
                                    <td>{{ $page->title }}</td>
                                    <td>{{ $page->slug }}</td>
                                    <td>{{ $page->getCategoryName($page->category_id) }}</td>
                                    <td>{{ $page->description }}</td>
                                    <td class="text-center">
                                        @can('content.pages.update')
                                            <a href="{{ route('backend.content.pages.edit', $page->id) }}"
                                               class="btn btn-success btn-sm" title="Modifier"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>
                                        @endcan
                                        @can('content.pages.delete')
                                            <button type="button" class="btn btn-danger btn-sm"
                                                    title="Supprimer"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal{{ $page->id }}">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        @endcan
                                    </td>
                                </tr>
                                @include('backend.layouts.modal-delete', ['id' => $page->id, 'title' => 'Êtes-vous sûr de vouloir supprimer la page '.$page->name.' ?', 'route' => 'backend.content.pages.destroy'])
                            @endforeach

                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
