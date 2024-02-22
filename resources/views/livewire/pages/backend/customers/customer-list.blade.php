<div>
    <div class="entry-header flex items-center">
        <div class="flex-1">
            <h1>Clients</h1>
        </div>
        <div class="flex-none inline-flex items-center">
            <div class="textfield-line">
                <label for="search"><i class="fa-solid fa-magnifying-glass"></i></label>
                <input type="text" placeholder="Rechercher..." wire:model.live="search" class="focus:outline-none" role="searchbox">
            </div>
            <p class="bg-gray-100 block py-2 px-4 rounded-lg ml-2">{{ $customers->count() }}</p>
        </div>
    </div>
    <div class="entry-content">
        @if($customers_temp->count() > 0)
            <h2>Demandes d'inscription</h2>
            <div class="table-primary mb-5">
                <table>
                    <thead>
                    <tr>
                        <th>Nom de famille</th>
                        <th>Prénom</th>
                        <th>Numéro de téléphone</th>
                        <th>Adresse e-mail</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($customers_temp as $temp)
                        <tr>
                            <td>{{ $temp->lastname }}</td>
                            <td>{{ $temp->firstname }}</td>
                            <td>{{ $temp->phone }}</td>
                            <td>{{ $temp->email }}</td>
                            <td class="w-[200px]"><button type="button" wire:click="$dispatch('openModal', { component: 'popups.backend.customers.configure-customer', arguments: {{ json_encode(['user' => $temp->id]) }} })" class="btn-filled_secondary">Ajouter l'utilisateur</button></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        <h2>Liste des clients</h2>
        @if($customers->count() > 0)
            <div class="table-primary">
                <table>
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Code client EBP</th>
                        <th>Nom de famille</th>
                        <th>Prénom</th>
                        <th>Adresse e-mail</th>
                        <th>Newsletter</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($customers as $customer)
                        <tr class="hover:text-blue-800 cursor-pointer" wire:click="$dispatch('openModal', { component: 'popups.backend.customers.show-customer', arguments: {{ json_encode(['user' => $customer->id])  }} })">
                            <td>{{ $customer->id }}</td>
                            <td>
                                @if($customer->EBP_customer != null)
                                    {{ $customer->EBP_customer }}
                                @else
                                    <span class="text-sm bg-red-200 px-2 py-1 rounded-md">Pas configuré</span>
                                @endif
                            </td>
                            <td>{{ $customer->lastname }}</td>
                            <td>{{ $customer->firstname }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{!! $customer->newsletterIcon() !!}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $customers->links() }}
            </div>
        @else
            <p class="empty-text">Personne ne s'est inscrit sur votre site pour le moment</p>
        @endif
    </div>
</div>
