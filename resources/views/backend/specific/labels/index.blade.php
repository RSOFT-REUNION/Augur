@extends('backend.layouts.layout')
@section('title', __('Gestion des labels') )

@section('main-content')

    <div class="row m-2">
        <div class="col">
            <div class="card border-left-primary shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Liste des labels</h6>
                    @can('specific.labels.create')
                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('backend.specific.labels.create') }}" class="btn btn-success my-2 hvr-grow"><i class="fa-solid fa-plus"></i> Ajouter un label</a>
                        </div>
                    @endcan
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        <table id="datatable" class="table datatable table-hover table-bordered w-100">
                            <thead>
                            <tr>
                                <th scope="col" class="text-center" style="width: 5%;">#</th>
                                <th scope="col" class="text-center" style="width: 20%;">Image</th>
                                <th scope="col" class="text-center">Nom</th>
                                <th scope="col" class="text-center" style="width: 15%;"><i
                                        class="fa-duotone fa-arrows-minimize"></i></th>
                            </tr>
                            </thead>

                            @foreach ($labels as $label)
                                <tr>
                                    <td class="text-center align-middle">{{ $label->id }}</td>
                                    <td class="text-center align-middle"><img style="max-height: 50px;" src="/storage/upload/specific/labels/{{ $label->image }}" alt="{{ $label->name }}"></td>
                                    <td class="text-center align-middle">{{ $label->name }}</td>
                                    <td class="text-center align-middle">
                                        @can('specific.labels.update')
                                            <a href="{{ route('backend.specific.labels.edit', $label->id) }}"
                                               class="btn btn-success btn-sm" title="Modifier"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>
                                        @endcan
                                        @can('specific.labels.delete')
                                            <button type="button" class="btn btn-danger btn-sm"
                                                    title="Supprimer"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal{{ $label->id }}">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        @endcan
                                    </td>
                                </tr>
                                @include('backend.layouts.modal-delete', ['id' => $label->id, 'title' => 'Êtes-vous sûr de vouloir supprimer la page '.$label->name.' ?', 'route' => 'backend.specific.labels.destroy'])
                            @endforeach

                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
