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
            @if($evenement_user->count() > 0)
                <div class="table-primary">
                    <table>
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Adresse e-mail</th>
                            <th>phone</th>
                            {{-- <th>Compte</th> --}}
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($evenement_user as $evenement)
                            <tr>
                                <td>{{ $evenement->user->id }}</td>
                                <td>{{ $evenement->user->lastname }}</td>
                                <td>{{ $evenement->user->firstname }}</td>
                                <td>{{ $evenement->user->email }}</td>
                                <td>{{$evenement->user->phone }}</td>
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