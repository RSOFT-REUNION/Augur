@extends('backend.layouts.layout')
@section('title', __('Gestion des commandes'))

@section('main-content')

    <div class="row m-2">
        <div class="col">

            <div class="row justify-content-evenly">
                <div class="col card border-left-primary m-2 p-0">
                    <div class="card-header">
                        <h6 class="m-0 text-center font-weight-bold text-primary">Commandes acceptés</h6>
                    </div>
                    <div class="card-body">
                        <h2 class="card-text text-center text-primary">{{ $orders->where('status', 'paiement accepté')->count() }}</h2>
                    </div>
                </div>
                <div class="col card card border-left-info m-2 p-0">
                    <div class="card-header">
                        <h6 class="m-0 text-center font-weight-bold text-primary">En cours de préparation</h6>
                    </div>
                    <div class="card-body">
                        <h2 class="card-text text-center text-info">{{ $orders->where('status', 'en cours de préparation')->count() }}</h2>
                    </div>
                </div>
                <div class="col card border-left-warning m-2 p-0">
                    <div class="card-header">
                        <h6 class="m-0 text-center font-weight-bold text-primary">Prêt pour livraison</h6>
                    </div>
                    <div class="card-body">
                        <h2 class="card-text text-center text-warning">{{ $orders->where('status', 'prêt pour livraison')->count() }}</h2>
                    </div>
                </div>
                <div class="col card border-left-success m-2 p-0">
                    <div class="card-header">
                        <h6 class="m-0 text-center font-weight-bold text-primary">Commandes livrées</h6>
                    </div>
                    <div class="card-body">
                        <h2 class="card-text text-center text-success">{{ $orders->where('status', 'livré')->count() }}</h2>
                    </div>
                </div>
            </div>

            <div class="card border-left-primary shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Suivi des Commandes</h6>
                    {{-- @can('orders.create')
                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('backend.orders.orders.create') }}"
                               class="btn btn-success my-2  hvr-grow"><i class="fa-solid fa-plus"></i> Ajouter une commande</a>
                        </div>
                    @endcan --}}
                </div>

                <div class="card-body">
                    <div class="table-responsive mb-3">
                        <table id="datatable" class="table datatable table-hover table-bordered w-100">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center" style="width: 5%;">#</th>
                                    <th scope="col" class="text-center">Nom du client</th>
                                    <th scope="col" class="text-center">Date de la commande</th>
                                    <th scope="col" class="text-center">Informations de livraison</th>
                                    <th scope="col" class="text-center">Total</th>
                                    <th scope="col" class="text-center">Statut</th>
                                    <th scope="col" class="text-center" style="width: 15%;"><i
                                            class="fa-duotone fa-arrows-minimize"></i></th>
                                </tr>
                            </thead>

                            @foreach ($orders as $order)
                                <tr>
                                    <td class="text-center">{{ $order->id }}</td>
                                    <td class="text-center">{{ $order->getCustomerName($order->customer_id) }}</td>
                                    <td class="text-center">{{ $order->created_at }}</td>
                                    <td class="text-center">{{ $order->delivery_type }}<br>{{ $order->delivery_location }}
                                    </td>
                                    <td class="text-center">{{ $order->total }} €</td>
                                    <td class="text-center">
                                        <div class="card
                                        @if ($order->status == 'en attente de paiement')
                                        text-bg-secondary
                                        @elseif ($order->status == 'paiement accepté')
                                        text-bg-primary
                                        @elseif ($order->status == 'en cours de préparation')
                                        text-bg-info
                                        @elseif ($order->status == 'prêt pour livraison')
                                        text-bg-warning
                                        @elseif ($order->status == 'en cours de livraison')
                                        text-bg-dark
                                        @elseif ($order->status == 'livré')
                                        text-bg-success
                                        @elseif ($order->status == 'annulé')
                                        text-bg-danger
                                        @elseif ($order->status == 'remboursé')
                                        text-bg-light @endif
                                        "
                                        style="max-width: 18rem;">
                                        <p class="card-text">{{ $order->status }}</p>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        @can('orders.orders.update')
                                            <a href="{{ route('backend.orders.orders.edit', $order->id) }}"
                                                class="btn btn-success btn-sm" title="Modifier"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>
                                        @endcan
                                        {{-- @can('orders.orders.delete')
                                            <button type="button" class="btn btn-danger btn-sm" title="Supprimer"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal{{ $order->id }}">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        @endcan --}}
                                    </td>
                                </tr>
                                @include('backend.layouts.modal-delete', [
                                    'id' => $order->id,
                                    'title' =>
                                        'Êtes-vous sûr de vouloir supprimer la commande ' . $order->name . ' ?',
                                    'route' => 'backend.orders.orders.destroy',
                                ])
                            @endforeach

                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
