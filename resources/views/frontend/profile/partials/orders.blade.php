@extends('frontend.profile.dashboard')
@section('title', __('Mes commandes') )


@section('dashboard-breadcrumb')
    <div style="margin-top: 60px;" class="mb-5">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-nav mt-5 p-3 rounded-3 shadow">
                <li class="breadcrumb-item"><a href="{{ route('index') }}"><i class="fa-solid fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Mon compte</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Mes commandes</li>
            </ol>
        </nav>
    </div>
@endsection

@section('dashboard-content')
    <div class="text-end mb-4">
        <a class="hvr-grow-shadow btn btn-warning" href="{{ route('dashboard') }}"><i class="fa-solid fa-circle-left"></i> Retour</a>
    </div>

    <h2>Mes commandes</h2>



@endsection
