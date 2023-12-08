@extends('layouts.backend')

@section('content-template')
    <main role="main" id="backend_content">
        <div class="entry-header flex items-center">
            <div class="flex-1 inline-flex items-center">
                <a href="{{ route('bo.evenements') }}" class="btn-icon_secondary mr-4"><i class="fa-solid fa-arrow-left"></i></a>
                <h1>{{ $evenement->title }}</h1>
            </div>
        </div>
        <div class="entry-content">
            @if($evenement_user->count() > 0 || $evenement_guests->count() > 0)
                <div class="table-primary">
                    <table>
                        <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Adresse e-mail</th>
                            <th>phone</th>
                            <th>Compte</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($evenement_user as $evenement)
                            <tr>
                                <td>{{ $evenement->user->lastname }}</td>
                                <td>{{ $evenement->user->firstname }}</td>
                                <td>{{ $evenement->user->email }}</td>
                                <td>{{$evenement->user->phone }}</td>
                                <td class="w-32">
                                    <div class="flex flex-row items-center justify-center">
                                        <span class="text-green-500 mx-7 my-2">Actif</span>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @foreach($evenement_guests as $guests)
                            <tr>
                                <td>{{ $guests->lastname }}</td>
                                <td>{{ $guests->firstname }}</td>
                                <td>{{ $guests->email }}</td>
                                <td>{{ $guests->phone }}</td>
                                <td class="w-32">
                                    <div class="flex flex-row items-center justify-center">
                                        <span class="text-red-500 mx-7 my-2">Non actif</span>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="empty-text">Aucun utilisateur ne participe à l'animation.</p>
            @endif
        </div>
    </main>
@endsection