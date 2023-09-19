@extends('layouts.frontend')

@section('header-carousel')
    <div class="carousel-single_title" style="background-image: url('{{ asset('images/assets/background_login.jpg') }}')">
        <h1>Mon profil</h1>
    </div>
@endsection

@section('content-template')
    <main role="main">
        <div class="container mx-auto py-10">
            <div class="flex flex-col lg:flex-row">
                <div class="flex-1 mr-2 my-5 lg:my-0 order-2 lg:order-1">
                    {{-- Affichage de la fidélité --}}
                    @if(auth()->user()->EBP_customer)
                        <div class="mb-5 bg-primary text-white py-5 px-10 rounded-lg">
                            <div class="flex items-center">
                                <div class="flex-1">
                                    <p class="text-xl font-bold">Mes points fidélité</p>
                                </div>
                                <div class="flex-none">
                                    <p class="text-4xl font-bold">3 000</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <h2 class="front-subtitle">Mes participations</h2>
                    @if($participations->count() > 0)
                        <ul class="mt-3">
                            @foreach($participations as $part)
                                <li class="profile_evenements-list mb-2">
                                    <div class="flex items-center">
                                        <div class="flex-none">
                                            <img src="{{ asset('storage/medias/'. $part->getEvenement()->getPicture()) }}" />
                                        </div>
                                        <div class="flex-1 ml-5">
                                            <h4 class="font-bold text-xl">{{ $part->getEvenement()->title }}</h4>
                                            <p>Le {{ $part->getEvenement()->getDate() }}</p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                    @else
                        <div class="mt-3">
                            <p class="empty-text">Vous n'avez pas encore participer à des événements</p>
                        </div>
                    @endif
                </div>
                <div class="flex-none ml-2 width-300 order-1 lg:order-2">
                    <div class="container-filled w-full">
                        <div class="flex bg-secondary px-2 py-1 rounded-lg">
                            <div class="flex-1">
                                <h3>Mes informations</h3>
                            </div>
                        </div>
                        <div class="mt-10 px-3">
                            <div class="flex items-center">
                                <div class="flex-1">
                                    <p>Prénom & Nom :</p>
                                    <p>Adresse e-mail :</p>
                                    <p>Inscrit depuis le :</p>
                                    <p>Newsletter :</p>
                                </div>
                                <div class="flex-1 text-right">
                                    <p class="font-bold">{{ $me->firstname }} {{ $me->lastname }}</p>
                                    <p class="font-bold">{{ $me->email }}</p>
                                    <p class="font-bold">{{ $me->getCreatedAt() }}</p>
                                    <p class="font-bold">{!! $me->newsletterIcon() !!}</p>
                                </div>
                            </div>
                            <div class="mt-3 text-center">
                                <button onclick="Livewire.emit('openModal', 'popups.frontend.edit-profile')" class="btn-filled_secondary"><i class="fa-solid fa-user-pen mr-3"></i>Modifier</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
