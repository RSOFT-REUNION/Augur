<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="modal-create" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Créer un produit
                </h5><button type="button" class="btn btn-light" data-bs-dismiss="modal">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('backend.catalog.products.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="d-flex gap-2 justify-content-end mb-3 me-5">
                        <div class="row m-2">

                            <div class="form-group">
                                <label class="form-control-label" for="name">Libellé du produit <span class="small text-danger">*</span></label>
                                <input id="name" type="text" name="name"
                                       class="@error('name') is-invalid @enderror form-control" required
                                       value="{{ old('name') }}">
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-secondary">Catégorie</h6>
                                </div>
                                <div class="card-body">
                                    <select class="form-select tomselect @error('categorie') is-invalid @enderror" aria-label="category_id"
                                            id="category_id" name="category_id">
                                        <option value=""> Aucune catégorie </option>
                                    {{--    @foreach($categories_list as $category_list)
                                            <option @if($category_list->id == $product->category_id) selected @endif value="{{ $category_list->id }}"> {{ $category_list->name }}</option>
                                        @endforeach--}}
                                    </select>
                                    @error('categorie')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary">OK</button>
                </form>
            </div>
        </div>

    </div>
</div>
