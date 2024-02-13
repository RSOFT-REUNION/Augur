@extends('layouts.backend')

@section('content-template')
    <main role="main" id="backend_content">
        <div class="entry-header flex items-center">
            <div class="flex-1">
                <h1>À propos</h1>
            </div>
            <div class="flex-none">
                <p class="bg-blue-900 text-white px-4 py-2 rounded-lg">Version actuelle - {{ Config::get('augur.app_version') }}</p>
            </div>
        </div>
        <div class="entry-content mb-10">
            {{-- Fonctionnalités à venir --}}
            {{--<div class="border border-purple-500 px-3 py-3 bg-purple-100 rounded-lg">
                <div class="flex items-center">
                    <div class="flex-1">
                        <p class="text-purple-500 text-2xl font-bold"><i class="fa-solid fa-star fa-shake mr-2" style="--fa-animation-duration: 20s; --fa-animation-iteration-count: 1;"></i>Fonctionnalités à venir</p>
                    </div>
                </div>
                <ul class="mt-2 list-disc pl-10">
                    <li>Ajout des recettes produits</li>
                </ul>
            </div>--}}

            {{-- Version actuel --}}
            <div class="container-version_actual mt-5">
                <div class="container-version-header">
                    <div class="flex items-center">
                        <div class="flex-1">
                            <h4>Version 1.4 <span class="px-3 py-1 rounded-lg bg-blue-300 text-sm text-black ml-4"><i class="fa-solid fa-wrench mr-2"></i>Mise à jour mineure</span></h4>
                        </div>
                        <div class="flex-none">
                            <p>19/09/2023</p>
                        </div>
                    </div>
                </div>
                <div class="container-version-content">
                    <h5><i class="fa-solid fa-users mr-2"></i>Les utilisateurs</h5>
                    <ul>
                        <li>Il n'est plus possible maintenant pour un utilisateur de créer son compte, il doit obligatoirement passer par une demande de création.</li>
                        <ul class="ml-5">
                            <li>Chaque demande de nouveau compte est envoyé par mail à l'adresse de contact par défaut. Les demandes en attente sont également visibles dans le back-office.</li>
                            <li>Il est maintenant possible de voir les informations d'un client et d'ajouter le <b>code client EBP</b>.</li>
                            <li>Il est maintenant possible de rechercher un client par son <b>code client EBP</b>.</li>
                        </ul>
                        <li>Il existe maintenant une liaison entre EBP et le site internet, afin de récupérer les points de fidélité client.</li>
                    </ul>
                </div>
            </div>


            {{-- Version old --}}
            <div class="container-version_old mt-5">
                <div class="container-version-header">
                    <div class="flex items-center">
                        <div class="flex-1">
                            <h4>Version 1.3 <span class="px-3 py-1 rounded-lg bg-blue-300 text-sm text-black ml-4"><i class="fa-solid fa-wrench mr-2"></i>Mise à jour mineure</span></h4>
                        </div>
                        <div class="flex-none">
                            <p>08/08/2023</p>
                        </div>
                    </div>
                </div>
                <div class="container-version-content">
                    <h5><i class="fa-solid fa-file-lines mr-2"></i>Les recettes</h5>
                    <ul>
                        <li>Ajout de la notion de recettes</li>
                    </ul>
                    <h5 class="mt-5"><i class="fa-solid fa-comments mr-2"></i>Les messages</h5>
                    <ul>
                        <li>Il est maintenant possible de voir les messages que l'on a reçu depuis le back-office</li>
                    </ul>
                    <h5 class="mt-5"><i class="fa-solid fa-gear mr-2"></i>Général</h5>
                    <ul>
                        <li>Ajout de Google Analytics</li>
                    </ul>
                </div>
            </div>

            <div class="container-version_old mt-5">
                <div class="container-version-header">
                    <div class="flex items-center">
                        <div class="flex-1">
                            <h4>Version 1.2.2 <span class="px-3 py-1 rounded-lg bg-yellow-300 text-sm text-black ml-4"><i class="fa-solid fa-person-digging mr-2"></i>Correctif</span></h4>
                        </div>
                        <div class="flex-none">
                            <p>27/07/2023</p>
                        </div>
                    </div>
                </div>
                <div class="container-version-content">
                    <h5><i class="fa-solid fa-file-lines mr-2"></i>Les produits</h5>
                    <ul>
                        <li><span class="text-sm bg-green-200 text-green-800 py-1 px-2 rounded-md">Nouveautés</span> Modification de l'affichage de la liste des produits et d'un produit simple</li>
                        <li>Optimisation des photos (côté serveur) lors de l'ajout d'articles ou de la modification.</li>
                        <li>Les univers sont dorénavant masqués par défaut dans le back-office.</li>
                    </ul>
                    <h5 class="mt-5"><i class="fa-solid fa-gear mr-2"></i>Optimisations</h5>
                    <ul>
                        <li>Optimisation de toutes les photos dans le but d'améliorer leur chargement</li>
                    </ul>
                </div>
            </div>

            <div class="container-version_old mt-5">
                <div class="container-version-header">
                    <div class="flex items-center">
                        <div class="flex-1">
                            <h4>Version 1.2.1 <span class="px-3 py-1 rounded-lg bg-yellow-300 text-sm text-black ml-4"><i class="fa-solid fa-person-digging mr-2"></i>Correctif</span></h4>
                        </div>
                        <div class="flex-none">
                            <p>20/07/2023</p>
                        </div>
                    </div>
                </div>
                <div class="container-version-content">
                    <h5><i class="fa-solid fa-file-lines mr-2"></i>Les produits</h5>
                    <ul>
                        <li>Correction de l'affichage des labels au niveau d'un produit</li>
                        <li>Optimisation de l'import des photos pour les articles <span class="text-red-500">Uniquement des photos au format JPG, PNG ou JPEG</span></li>
                        <li>Correction de la modification des produits.</li>
                    </ul>
                    <h5 class="mt-5"><i class="fa-solid fa-gear mr-2"></i>A propos</h5>
                    <ul>
                        <li><span class="text-sm bg-green-200 text-green-800 py-1 px-2 rounded-md">Nouveautés</span> Possibilité de voir les fonctionnalités à venir sur votre site !</li>
                    </ul>
                </div>
            </div>

            <div class="container-version_old mt-5">
                <div class="container-version-header">
                    <div class="flex items-center">
                        <div class="flex-1">
                            <h4>Version 1.2 <span class="px-3 py-1 rounded-lg bg-blue-300 text-sm text-black ml-4"><i class="fa-solid fa-wrench mr-2"></i>Mise à jour mineure</span></h4>
                        </div>
                        <div class="flex-none">
                            <p>19/07/2023</p>
                        </div>
                    </div>
                </div>
                <div class="container-version-content">
                    <h5><i class="fa-solid fa-file-lines mr-2"></i>Page d'accueil</h5>
                    <ul>
                        <li><span class="text-sm bg-green-200 text-green-800 py-1 px-2 rounded-md">Nouveautés</span> Ajout de la notion <b>"Qui sommes-nous"</b> au niveau du premier point visible. (Modifiable depuis les "pages")</li>
                    </ul>
                    <h5 class="mt-5"><i class="fa-solid fa-file-lines mr-2"></i>Les produits</h5>
                    <ul>
                        <li><span class="text-sm bg-green-200 text-green-800 py-1 px-2 rounded-md">Nouveautés</span> Ajout de la notion <b>des univers</b>. <i>(Chaque articles doit être configuré dans un univers)</i></li>
                        <li>Modification de l'affichage des produits</li>
                    </ul>
                    <h5 class="mt-5"><i class="fa-solid fa-gear mr-2"></i>Réglages</h5>
                    <ul>
                        <li><span class="text-sm bg-green-200 text-green-800 py-1 px-2 rounded-md">Nouveautés</span> Possibilité de choisir quelles données "<b>Qui sommes-nous</b>" afficher sur la page d'accueil. <i>(choix entre le contenu de la page "Qui sommes-nous" ou bien entre un contenu à part)</i></li>
                        <li>Changement de la disposition des réglages. Les paramètres de contact et de réseaux sociaux se trouvent maintenant dans "Informations"</li>
                    </ul>
                </div>
            </div>

            <div class="container-version_old mt-5">
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
                        <li>La suppression d'une animation est de nouveau fonctionnelle.</li>
                        <li>Correction de l'affichage de la description d'une animation dans le tableau de bord</li>
                    </ul>
                    <h5 class="mt-5"><i class="fa-solid fa-file-lines mr-2"></i>Les labels</h5>
                    <ul>
                        <li>La modification d'un logo de label est de nouveau fonctionnelle.</li>
                        <li>Correction de l'affichage du bouton "<b>sauvegarder</b>" dans les labels pour les petits écrans</li>
                    </ul>
                    <h5 class="mt-5"><i class="fa-solid fa-file-lines mr-2"></i>Les produits</h5>
                    <ul>
                        <li><span class="text-sm bg-blue-200 text-blue-800 py-1 px-2 rounded-md">Optimisations</span> Le système de gestion des photos a été revu pour la bonne prise en charge des imports</li>
                        <li> Suppression de l'affichage des tags au niveau de la liste des produits (FRONTEND) <i>(En reflexion pour réintégration lors d'une prochaine mise à jour)</i></li>
                    </ul>
                    <h5 class="mt-5"><i class="fa-solid fa-file-lines mr-2"></i>Les magasins</h5>
                    <ul>
                        <li><span class="text-sm bg-blue-200 text-blue-800 py-1 px-2 rounded-md">Optimisations</span> L'affichage de la liste des magasins dans le back-office a été revu</li>
                        <li><span class="text-sm bg-green-200 text-green-800 py-1 px-2 rounded-md">Nouveautés</span> Il est maintenant possible de modifier les informations d'un magasin et de les supprimer <i>(uniquement si non référencés dans une animation)</i></li>
                    </ul>
                    <h5 class="mt-5"><i class="fa-solid fa-circle-info mr-2"></i>Page "A propos" <span class="text-sm bg-green-200 text-green-800 py-1 px-2 rounded-md">Nouveautés</span></h5>
                    <ul>
                        <li>Mise en place du suivi de version dans la section " PROPOS". Vous permets de suivre les évolutions du site et les fonctionnalités qui vont arriver !</li>
                    </ul>
                </div>
            </div>
        </div>
    </main>
@endsection
