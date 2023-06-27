@extends('layouts.frontend')

@section('header-carousel')
    <div class="carousel-single_title" style="background-image: url('{{ asset('images/assets/background_login.jpg') }}')">
        <h1>Mon profil</h1>
    </div>
@endsection

@section('content-template')
    <main role="main">
        <div class="container mx-auto pt-10">
            <div class="flex">
                <div class="flex-1 mr-2">
                    <h2 class="front-subtitle">Mes participations</h2>
                    <div class="mt-3">
                        <p class="empty-text">Vous n'avez pas encore participer à des événements</p>
                    </div>
                </div>
                <div class="flex-none ml-2">
                    <div class="container-filled width-400">
                        <div class="flex items-center bg-secondary px-2 py-1 rounded-lg">
                            <div class="flex-1">
                                <h3>Mes informations</h3>
                            </div>
                            <div class="flex-none">
                                <div id="icon_user-profile">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                            </div>
                        </div>
                        <div class="mt-10 px-3">
                            <div class="flex items-center">
                                <div class="flex-1">
                                    <p>Prénom & Nom :</p>
                                    <p>Adresse e-mail :</p>
                                    <p>Inscrit depuis le :</p>
                                    <p>Abonné à la newsletter :</p>
                                </div>
                                <div class="flex-1 text-right">
                                    <p class="font-bold">{{ $me->firstname }} {{ $me->lastname }}</p>
                                    <p class="font-bold">{{ $me->email }}</p>
                                    <p class="font-bold">{{ $me->getCreatedAt() }}</p>
                                    <p class="font-bold">{!! $me->newsletterIcon() !!}</p>
                                </div>
                            </div>
                            <div class="mt-3 text-right">
                                <button onclick="" class="btn-filled_secondary">Modifier</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
