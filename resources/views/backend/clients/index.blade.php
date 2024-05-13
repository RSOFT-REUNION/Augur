@extends('backend.layouts.layout')
@section('title', __('Gestion des clients') )

@section('main-content')

    <div class="row m-2">
        <div class="col">
            <div class="card border-left-primary shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Liste des clients</h6>
                </div>

                <div class="card-body">

                    <div class="table-responsive mb-3">
                        <table id="datatable" class="table datatable table-hover table-bordered w-100">
                            <thead>
                            <tr>
                                <th scope="col" class="text-center" style="width: 5%;">#</th>
                                <th scope="col" class="text-center">Nom</th>
                                <th scope="col" class="text-center">Prénom</th>
                                <th scope="col" class="text-center">Adresse Mail</th>
                                <th scope="col" class="text-center no-sort" style="width: 5%;"><i class="fa-duotone fa-envelope-open-text"></i></th>
                                <th scope="col" class="text-center no-sort" style="width: 5%;"><i class="fa-duotone fa-shield-check"></i></th>
                                <th scope="col" class="text-center no-sort" style="width: 10%;"><i
                                        class="fa-duotone fa-arrows-minimize"></i></th>
                            </tr>
                            </thead>

                            @foreach ($clients as $client)
                                <tr>
                                    <td class="text-center">{{ $client->id }}</td>
                                    <td>{{ $client->name }}</td>
                                    <td>{{ $client->first_name }}</td>
                                    <td>{{ $client->email }}</td>
                                    <td class="text-center">{{ $client->checkNewsletter($client->newsletter) }}</td>
                                    <td class="text-center">{{ $client->checkEmailVerified($client->email_verified_at) }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('backend.clients.client.adresse', $client->id ) }}" class="btn btn-warning btn-sm"><i class="fa-solid fa-location-dot"></i></a>
                                        @can('clients.delete')
                                            <button type="button" class="btn btn-danger btn-sm"
                                                    title="Supprimer"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal{{ $client->id }}">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        @endcan
                                    </td>
                                </tr>
                                @include('backend.layouts.modal-delete', ['id' => $client->id, 'title' => 'Êtes-vous sûr de vouloir supprimer le client '.$client->name.' '.$client->first_name.' ?', 'route' => 'backend.clients.client.destroy'])
                            @endforeach

                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
