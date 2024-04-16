@extends('backend.layouts.layout')
@section('title', __('Gestion des animations') )

@section('main-content')

    <div class="row m-2">
        <div class="col">
            <div class="card border-left-primary shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Liste des animations</h6>
                    @can('specific.animations.create')
                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('backend.specific.animations.create') }}" class="btn btn-success my-2 hvr-grow"><i class="fa-solid fa-plus"></i> Ajouter une animation</a>
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
                                <th scope="col" class="text-center">Date de début</th>
                                <th scope="col" class="text-center">Date de fin</th>
                                <th scope="col" class="text-center">Magasin</th>
                                <th scope="col" class="text-center" style="width: 15%;"><i
                                        class="fa-duotone fa-arrows-minimize"></i></th>
                            </tr>
                            </thead>

                            @foreach ($animations as $animation)
                                <tr>
                                    <td class="text-center align-middle">{{ $animation->id }}</td>
                                    <td class="text-center align-middle"><img style="max-height: 50px;" src="/storage/upload/specific/animations/{{ $animation->image }}" alt="{{ $animation->name }}"></td>
                                    <td class="text-center align-middle">{{ $animation->name }}</td>
                                    <td class="text-center align-middle">{{ date('d-m-Y', strtotime($animation->start_date)) }}</td>
                                    <td class="text-center align-middle">{{ date('d-m-Y', strtotime($animation->end_date)) }}</td>
                                    <td class="text-center align-middle">{{ $animation->getShopsName($animation->shops_id) }}</td>
                                    <td class="text-center align-middle">
                                        @can('specific.animations.update')
                                            <a href="{{ route('backend.specific.animations.edit', $animation->id) }}"
                                               class="btn btn-success btn-sm" title="Modifier"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>
                                        @endcan
                                        @can('specific.animations.delete')
                                            <button type="button" class="btn btn-danger btn-sm"
                                                    title="Supprimer"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal{{ $animation->id }}">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        @endcan
                                    </td>
                                </tr>
                                @include('backend.layouts.modal-delete', ['id' => $animation->id, 'title' => 'Êtes-vous sûr de vouloir supprimer l\'animation '.$animation->name.' ?', 'route' => 'backend.specific.animations.destroy'])
                            @endforeach

                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
