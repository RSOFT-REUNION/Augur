<div id="discounted_list" class="table-responsive mb-3">
    <table id="datatable" class="table datatable table-hover table-bordered w-100">
        <thead>
        <tr>
            <th scope="col" class="text-center" style="width: 5%;">#</th>
            <th scope="col" class="text-center">Produit</th>
            <th scope="col" class="text-center">Prix de base</th>
            <th scope="col" class="text-center">Prix remisé</th>
            <th scope="col" class="text-center no-sort" width="8%"><i
                    class="fa-duotone fa-arrows-minimize"></i></th>
        </tr>
        </thead>


        @foreach ($discount->products as $product)
            <tr id="product{{ $product->id }}">
                <td class="text-center align-middle">{{ $product->id }}</td>
                <td class="text-center align-middle">{{ $product->product_id.' - '.$product->product->name }}
                </td>
                <td class="text-center align-middle">
                   {{ formatPriceToFloat($product->base_ht) }} € HT <br>
                    {{ formatPriceToFloat($product->base_ttc) }} € TTC
                </td>
                <td class="text-center align-middle">
                    {{ formatPriceToFloat($product->discounted_ht) }} € HT <br>
                    {{ formatPriceToFloat($product->discounted_ttc) }} € TTC
                <td class="text-center">
                    <form> @csrf
                        @method('PUT')
                    <button type="button" class="btn btn-danger"
                            hx-delete="{{ route('backend.catalog.discounts.destroy_product', $product) }}"
                            hx-target="#product{{ $product->id }}"
                            hx-swap="delete"
                            hx-indicator="#spinner{{ $product->id }}"
                    ><i class="fa-regular fa-trash"></i>
                    </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>



    <script>
        $('.datatable').DataTable( {
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




