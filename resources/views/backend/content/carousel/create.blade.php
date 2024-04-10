<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModal"
     aria-hidden="true" style="display: none;">
    <form action="{{ route('backend.content.carrousel.store') }}" method="post"  class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Ajouter une image
                    </h5>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-control-label" for="name">Nom <span class="small text-danger">*</span> :</label>
                        <input type="text" name="name" id="name" class="@error('name') is-invalid @enderror form-control" value="{{ old('name' ) }}" required></input>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-control-label" for="description">Description :</label>
                        <input type="text" name="description" id="description" class="@error('description') is-invalid @enderror form-control" value="{{ old('description' ) }}"></input>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-control-label" for="url">Lien :</label>
                                <input type="text" name="url" id="url" class="@error('url') is-invalid @enderror form-control" value="{{ old('url' ) }}"></input>
                                @error('url')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-control-label" for="title_url">Bouton :</label>
                                <input type="text" name="title_url" id="title_url" class="@error('title_url') is-invalid @enderror form-control" value="{{ old('title_url', 'En savoir plus...') }}"></input>
                                @error('title_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-control-label" for="image">Image <span class="small text-danger">*</span> :</label>
                        <input type="file" name="image" id="image" class="@error('image') is-invalid @enderror form-control" value="{{ old('image' ) }}" required></input>
                        @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="alert-warning fade show p-3">
                        <i class="fa-solid fa-circle-info"></i> Vous devez fournir une image au format 1920x600
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                        <i class="fa-solid fa-rotate-left"></i>&nbsp;Annuler
                    </button>

                    <button type="submit" class="btn btn-success">
                        <i class="fa-solid fa-plus"></i>&nbsp;Ajouter
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
