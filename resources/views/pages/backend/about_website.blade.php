@extends('layouts.backend')

@section('content-template')
    <main role="main" id="backend_content">
        <div class="entry-header flex items-center">
            <div class="flex-1">
                <h1>À propos</h1>
            </div>
            <div class="flex-none">
                <p class="bg-blue-900 text-white px-4 py-2 rounded-lg">Version actuel - {{ Config::get('augur.app_version') }}</p>
            </div>
        </div>
        <div class="entry-content mb-10">
            {{-- Version actuel --}}
            <div class="container-version_actual">
                <div class="container-version-header">
                    <div class="flex items-center">
                        <div class="flex-1">
                            <h4>Version 1.1.1 <span class="px-3 py-1 rounded-lg bg-yellow-300 text-sm text-black ml-4"><i class="fa-solid fa-person-digging mr-2"></i>Correctif</span></h4>
                        </div>
                        <div class="flex-none">
                            <p>12/07/2023</p>
                        </div>
                    </div>
                </div>
                <div class="container-version-content">
                    <h5><i class="fa-solid fa-file-lines mr-2"></i>Les animations</h5>
                    <ul>
                        <li><span class="text-sm bg-green-200 text-green-800 py-1 px-2 rounded-md">Nouveautés</span> Il est maintenant possible de modifier les informations d'une animation.</li>
                        <li>La suppression d'une animation est de nouveau fonctionnel.</li>
                        <li>Correction de l'affichage de la description d'une animation dans le tableau de bord</li>
                    </ul>
                    <h5 class="mt-5"><i class="fa-solid fa-file-lines mr-2"></i>Les labels</h5>
                    <ul>
                        <li>La modification d'un logo de label est de nouveau fonctionnel.</li>
                        <li>Correction de l'affichage du bouton "<b>sauvegarder</b>" dans les labels pour les petits écrans</li>
                    </ul>
                    <h5 class="mt-5"><i class="fa-solid fa-file-lines mr-2"></i>Les produits</h5>
                    <ul>
                        <li><span class="text-sm bg-blue-200 text-blue-800 py-1 px-2 rounded-md">Optimisations</span> Le système de gestion des photos a été revu pour la bonne prise en charge des imports</li>
                        <li> Suppression de l'affichage des tags au niveau de la liste des produits (FRONTEND) <i>(En reflexion pour réintégration lors d'une prochaine mise à jour)</i></li>
                    </ul>
                    <h5 class="mt-5"><i class="fa-solid fa-file-lines mr-2"></i>Les magasins</h5>
                    <ul>
                        <li><span class="text-sm bg-blue-200 text-blue-800 py-1 px-2 rounded-md">Optimisations</span> L'affichage de la liste des magasins dans le back-office a été revus</li>
                        <li><span class="text-sm bg-green-200 text-green-800 py-1 px-2 rounded-md">Nouveautés</span> Il est maintenant possible de modifier les informations d'un magasin et de les supprimer <i>(uniquement si non référencé dans une animation)</i></li>
                    </ul>
                    <h5 class="mt-5"><i class="fa-solid fa-circle-info mr-2"></i>Page "A propos" <span class="text-sm bg-green-200 text-green-800 py-1 px-2 rounded-md">Nouveautés</span></h5>
                    <ul>
                        <li>Mise en place du suivi de version dans la section "A PROPOS". Vous permets de suivre les évolutions du site et les fonctionnalités qui vont arriver !</li>
                    </ul>
                </div>
            </div>
        </div>
    </main>
@endsection
