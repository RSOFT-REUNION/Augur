@extends('frontend.layouts.layout')
@section('title', __('Adresse') )

@section('main-content')

    <h1 class="text-center">Mes adresses</h1>
    <div class="d-flex justify-content-end">
        <a href="{{ route('adresse.create') }}" class="btn btn-success "><i class="fa-solid fa-plus"></i> Ajouter une nouvelle adresse</a>
    </div>

    <div class="row row-flex">

            <div class="row row-flex">
                @forelse($address as $addres)
                <div class="col-12 col-md-3">
                    <section class="card p-3 w-100 hvr-shadow rounded-4">
                            <h5 class="card-text text-center">{{ $addres->alias }}</h5>
                            <p class="card-text">{{ $addres->first_name }} {{ $addres->last_name }}</p>
                            <p class="card-text">{{ $addres->address }}</p>
                            <p class="card-text">{{ $addres->address2 }}</p>
                            <p class="card-text">{{ $addres->other }}</p>
                            <p class="card-text">{{ $addres->city }} - {{ $addres->postal_code }}</p>
                            <p class="card-text">{{ $addres->country }}</p>
                            <p class="card-text">{{ $addres->phone }}</p>
                            <p class="card-text">{{ $addres->other_phone }}</p>

                        <div class="row">
                            <div class="col-6 text-center">
                                <a href="{{ route('adresse.edit', $addres->id) }}"
                                   class="btn btn-success btn-sm" title="Modifier"><i
                                        class="fa-solid fa-pen-to-square"></i>&nbsp;Modifier</a>
                            </div>
                            <div class="col-6 text-center">
                                <form action="{{ route('adresse.destroy', $addres->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Supprimer" onclick="return confirm('Êtes-vous sûr de bien vouloir supprimer cet élément?');">
                                        <i class="fa-solid fa-trash"></i>&nbsp;Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                    </section>
                </div>
            @empty
                <h4 class="text-center">Vous n'avais pas encore d'adresse</h4>
            @endif
            </div>

    </div>
@endsection
