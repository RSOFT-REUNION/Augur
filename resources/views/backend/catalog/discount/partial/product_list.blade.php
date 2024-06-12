<div id="discounted_list" >

@if($discount->exists)
    <div class="row m-2">
        <div class="col">
            <div class="card border-left-warning shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-flex">
                        <div class="flex-fill"><h6 class="m-0 font-weight-bold text-warning">Liste Produits</h6></div>
                        <div class="p-2 flex-fill text-end">
                            <button type="button" class="btn btn-warning btn-sm text-end"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modal-add">
                                <i class="fa-solid fa-plus"></i> Ajouter des produits
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @include('backend.catalog.discount.partial.discounted_products')
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL LISTE DES PRODUITS AJOUTABLES A LA REMISE --}}
    <div class="modal fade" id="modal-add" tabindex="-1" aria-labelledby="modal-add" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modal-add">Ajouter des produits</h5>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body mb-3 m-2 ml-4 mr-4">
                    <form    hx-post='{{ route('backend.catalog.discounts.add_products', $discount) }}'
                             hx-target="#discounted_list"
                             hx-swap="outerHTML">
                        @csrf

                        <div>
                            <table id="datatableproduit" class="table table-hover table-bordered w-100">
                                <thead>
                                <tr>
                                    <th scope="col" class="text-center" style="width: 5%;">#</th>
                                    <th scope="col" class="text-center"></th>
                                    <th scope="col" class="text-center">Nom</th>
                                    <th scope="col" class="text-center">Prix TTC</th>
                                </tr>
                                </thead>
                                @foreach($products_list as $product)
                                    @if($discount->products->where('product_id', $product->id)->isEmpty())
                                        <tr id="product{{ $product->id }}">
                                            <td class="text-center align-middle">
                                                <input type="checkbox" value="{{ $product }}" name="discount_products[]" id="product{{ $product->id }}">
                                            </td>
                                            <td class="text-center align-middle"><img src="{{ $product->getFirstImagesURL(50, 50) }}"></td>
                                            <td class="text-center align-middle">{{ $product->name }}</td>
                                            <td class="text-center align-middle">{{ formatPriceToFloat($product->price_ttc) }} €</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </table>
                        </div>

                        <div class="input-group mb-2 mt-4 justify-content-end">
                            <button class="btn btn-success" data-bs-dismiss="modal">
                                <i class="fa-solid fa-plus"></i> Ajouter
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endif

    <script>
        $('#datatableproduit').DataTable( {
            order: [],
            "columnDefs": [ {
                "targets"  : 'no-sort',
                "orderable": false,
            }],
            language: {
                processing:     "Traitement en cours...",
                search:         "<i class=\"fa-solid fa-magnifying-glass\"></i>",
                lengthMenu:    "Afficher _MENU_ &eacute;l&eacute;ments",
                info:           "_TOTAL_ &eacute;l&eacute;ments",
                infoEmpty:      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
                infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                infoPostFix:    "",
                loadingRecords: "Chargement en cours...",
                zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
                emptyTable:     "Aucune donnée disponible dans le tableau",
                paginate: {
                    first:      "<i class=\"fa-solid fa-backward-fast\"></i>",
                    previous:   "<i class=\"fa-solid fa-backward-step\"></i>",
                    next:       "<i class=\"fa-solid fa-forward-step\"></i>",
                    last:       "<i class=\"fa-solid fa-forward-fast\"></i>"
                },
                aria: {
                    sortAscending:  ": activer pour trier la colonne par ordre croissant",
                    sortDescending: ": activer pour trier la colonne par ordre décroissant"
                }
            }
        } );
    </script>
</div>
