@extends('layouts.frontend')

@section('content-template')
    <main role="main">
        <div class="container mx-auto">
            @if ($settingGlobal->about_type == 2)
                <div class="text-center">
                    <h1>AÜGUR</h1>
                    <h3>Une démarche engagée</h3>
                </div>
                <div class="tiny-content my-20">
                    {!! $page->content !!}
                </div>
            @endif
            <div>
                <div class="text-center">
                    <h1>Nos labels</h1>
                    <h3>Un gage de qualité</h3>
                    <p class="mt-10">
                        Aügur propose aux consommateurs réunionnais une sélection des principaux labels privilégiés. Une cinquantaine de labels, signes de qualité,<br>
                        marques régionales et démarches engagées qui vont vous permettre d'en savoir plus, pour consommer mieux !
                    </p>
                    <div class="my-20">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                            @foreach($labels as $label)
                                <div class="front-grid_label" role="button" data-href="{{ route('fo.label', ['slug' => $label->slug]) }}">
                                    <div class="flex flex-col h-full">
                                        <div class="flex-1 flex h-full">
                                            <div class="m-auto">
                                                <img src="{{ asset('storage/medias/'. $label->getPicture()) }}"/>
                                            </div>
                                        </div>
                                        <div class="flex-none">
                                            <h2>{{ $label->title }}</h2>
                                            <div class="mt-4 text-center">
                                                <button onclick="window.location='{{ route('fo.label', ['slug' => $label->slug]) }}'" class="btn-filled_primary">En savoir plus</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <button onclick="window.location='{{ route('fo.labels.list') }}'" class="btn-filled_secondary">Voir tous nos labels<i class="fa-solid fa-chevron-right ml-3"></i></button>
                </div>

            </div>
        </div>
        <div class="container-primary mt-20">
            <div class="container mx-auto">
                <div class="pt-10 pb-20 text-center">
                    <h2 class="title-H2">Nos engagements</h2>
                    <h5 class="mb-10">Nos valeurs, notre vision</h5>
                    <div class="grid-engagement_container">
                        <div class="grid grid-cols-1 lg:grid-cols-2 grid-engagement">
                            <div class="grid_picture" style="background-image: url('{{ asset('images/assets/background_engagements.jpg') }}')"></div>
                            <div class="grid_first order-1">
                                <h2>Aügur a pour<br>objectif majeur</h2>
                                <p>de développer la distribution des produits issus de démarches<br>engagées et notamment de l'Agriculture Biologique</p>
                            </div>
                            <div class="grid_white order-3 lg:order-2">
                                <h3>Aügur souhaite privilégier</h3>
                                <p>dès que possible, les produits<br>Origine Réunion & Origine France.</p>
                            </div>
                            <div class="grid_yellow order-2 lg:order-3">
                                <h3>Aügur s'engage sur la traçabilité</h3>
                                <p>des produits vendus, et sur une transparence<br>totale de l'information.</p>
                            </div>
                            <div class="grid_yellow order-4">
                                <h3>Aügur s'engage aux côtés des<br>consommateurs réunionnais</h3>
                                <p>pour leur proposer une alimentation de qualité,<br>qui convient à tous, et à tous les régimes.</p>
                            </div>
                            <div class="grid_white order-5">
                                <h3>Aügur, c'est aussi mieux se nourrir</h3>
                                <p>Sans oublier le plaisir de bien<br>manger !</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="container mx-auto">
            <div class="my-20">
                {{-- Bloc shops --}}
                <div class="text-center">
                    <h2 class="title-H2">Les magasins AÜGUR</h2>
                    <p class="mt-10">
                        Rendez-nous visite dans nos différents magasins AÜGUR et découvrez nos meilleurs produits !
                    </p>
                    <button onclick="window.location='{{ route('fo.shops.list') }}'" class="btn-filled_secondary mt-10"><i class="fa-solid fa-location-dot mr-3"></i>Trouver le magasin le plus proche de chez moi</button>
                </div>
            </div>
        </div>
    </main>
@endsection
