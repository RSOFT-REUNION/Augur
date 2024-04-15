@extends('backend.layouts.layout')
@section('title', $label->exists ? __('Modifier un label') : __('Créer un label'))

@section('main-content')

    <div class="row m-2">
        <div class="col">
            <div class="card border-left-primary shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"> @if($label->exists)
                            Modification
                        @else
                            Création
                        @endif
                        d'un label</h6>
                </div>

                <div class="card-body">
                    <form action="{{ route($label->exists ? 'backend.specific.labels.update' : 'backend.specific.labels.store', $label) }}" method="post"  class="mt-6 space-y-6" enctype="multipart/form-data">
                    @csrf
                    @method($label->exists ? 'put' : 'post')

                        @if($label->exists)
                            <div class="text-center mb-3">
                                <img style="max-height: 150px;" src="/storage/upload/specific/labels/{{ $label->image }}" alt="{{ $label->name }}">
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="name">Nom <span class="small text-danger">*</span> : </label>
                                    <input id="name" type="text" name="name"
                                           class="@error('name') is-invalid @enderror form-control" required
                                           value="{{ old('name', $label->name) }}">
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="image">
                                        @if($label->exists)
                                            Changer l'image :
                                        @else
                                            Image <span class="small text-danger">*</span> :
                                        @endif
                                    </label>
                                    <input type="file" name="image" id="image" class="@error('image') is-invalid @enderror form-control" value="{{ old('image' ) }}"></input>
                                    @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="description">Description <span class="small text-danger">*</span> :</label>
                            <textarea id="description" name="description" class="summernote">{{ old('content', $label->description) }}</textarea>
                        </div>

                        <div class="d-flex gap-2 justify-content-center mt-3">
                            <button type='button' class="btn btn-danger" onclick="location.href='{{ route('backend.specific.labels.index') }}'">
                                <i class="fa-solid fa-rotate-left"></i>&nbsp;Annuler
                            </button>
                            <button type="submit" class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i>
                                @if($label->exists)
                                    Modifier
                                @else
                                    Créer
                                @endif
                            </button>&nbsp;&nbsp;
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
