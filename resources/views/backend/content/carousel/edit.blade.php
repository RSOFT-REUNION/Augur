<div class="modal fade" id="editModal{{ $slide->id }}" tabindex="-1" aria-labelledby="addModal"
     aria-hidden="true" style="display: none;">
    <form action="{{ route('backend.content.carrousel.update', $slide) }}" method="post"  class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Modifier l'image
                    </h5>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-control-label" for="name">Nom <span class="small text-danger">*</span> :</label>
                        <input type="text" name="name" id="name" class="@error('name') is-invalid @enderror form-control" value="{{ $slide->name }}" required></input>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-control-label" for="description">Description :</label>
                        <input type="text" name="description" id="description" class="@error('description') is-invalid @enderror form-control" value="{{ $slide->description }}"></input>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-control-label" for="url">Lien :</label>
                                <input type="text" name="url" id="url" class="@error('url') is-invalid @enderror form-control" value="{{ $slide->url }}"></input>
                                @error('url')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-control-label" for="title_url">Bouton :</label>
                                <input type="text" name="title_url" id="title_url" class="@error('title_url') is-invalid @enderror form-control" value="{{ $slide->title_url }}"></input>
                                @error('title_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                        <i class="fa-solid fa-rotate-left"></i>&nbsp;Annuler
                    </button>

                    <button type="submit" class="btn btn-success">
                        <i class="fa-solid fa-edit"></i>&nbsp;Modifier
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
