@extends('frontend.layouts.layout')
@section('title', __('Mon Compte') )

@section('main-content')

    <h3>Bonjour {{ Auth::user()->name }} {{ Auth::user()->first_name }}</h3>

    <form method="POST" action="{{ route('logout') }}"> @csrf <button class="btn btn-danger btn-logout mt-2 mb-4">{{ __('Log Out') }}</button> </form>

    <div class="container">

        <div class="row row-flex">
            <div class="col-12 col-md-3 align-self-center text-center">
                <a href="{{ route('profile.edit') }}" class="text-decoration-none blackcolor">
                <section class="card p-3 w-100 hvr-shadow rounded-4">
                    <header>
                        <i class="fa-solid fa-user-tie fa-4x mb-3"></i>
                        <p>Informations</p>
                    </header>
                </section>
                </a>
            </div>

            <div class="col-12 col-md-3 align-self-center text-center">
                <a href="{{ route('adresse.index') }}" class="text-decoration-none blackcolor">
                    <section class="card p-3 w-100 hvr-shadow rounded-4">
                        <header>
                            <i class="fa-solid fa-location-dot fa-4x mb-3"></i>
                            <p>Adresse</p>
                        </header>
                    </section>
                </a>
            </div>

            <div class="col-12 col-md-3 align-self-center text-center">
                <a href="{{ route('adresse.index') }}" class="text-decoration-none blackcolor">
                    <section class="card p-3 w-100 hvr-shadow rounded-4">
                        <header>
                            <i class="fa-solid fa-calendar-week fa-4x mb-3"></i>
                            <p>Historique de mes commandes</p>
                        </header>
                    </section>
                </a>
            </div>
        </div>

    </div>


@endsection
