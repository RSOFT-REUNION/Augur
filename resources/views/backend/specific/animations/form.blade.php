@extends('backend.layouts.layout')
@section('title', $animation->exists ? __('Modifier une animation') : __('Créer une animation'))

@section('main-content')

    <div class="row m-2">
        <div class="col">
            <div class="card border-left-primary shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"> @if($animation->exists)
                            Modification
                        @else
                            Création
                        @endif
                        d'une animation</h6>
                </div>

                <div class="card-body">
                    <form action="{{ route($animation->exists ? 'backend.specific.animations.update' : 'backend.specific.animations.store', $animation) }}" method="post"  class="mt-6 space-y-6" enctype="multipart/form-data">
                        @csrf
                        @method($animation->exists ? 'put' : 'post')

                        @if($animation->exists)
                            <div class="text-center mb-3">
                                <img style="max-height: 150px;" src="/storage/upload/specific/animations/{{ $animation->image }}" alt="{{ $animation->name }}">
                            </div>
                       @endif

                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="name">Titre de l'événement <span class="small text-danger">*</span> : </label>
                                    <input id="name" type="text" name="name"
                                           class="@error('name') is-invalid @enderror form-control" required
                                           value="{{ old('name', $animation->name) }}">
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="image">
                                        @if($animation->exists)
                                            Changer l'image de présentation :
                                        @else
                                            Image de présentation <span class="small text-danger">*</span> :
                                        @endif
                                    </label>
                                    <input type="file" name="image" id="image" class="@error('image') is-invalid @enderror form-control" value="{{ old('image' ) }}"></input>
                                    @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="start_date">Date de début <span class="small text-danger">*</span> : </label>
                                    <input id="start_date" type="datetime-local" name="start_date"
                                           class="@error('start_date') is-invalid @enderror form-control" required
                                           value="{{ old('start_date', $animation->start_date) }}">
                                    @error('start_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="end_date">Date de fin <span class="small text-danger">*</span> : </label>
                                    <input id="end_date" type="datetime-local" name="end_date"
                                           class="@error('end_date') is-invalid @enderror form-control" required
                                           value="{{ old('end_date', $animation->end_date) }}">
                                    @error('end_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <label for="shops_id" class="form-control-label">Magasin concernée <span class="small text-danger">*</span> :</label>
                                    <select class="form-select tomselect @error('shops_id') is-invalid @enderror" aria-label="shops_id"
                                            id="shops_id" name="shops_id">
                                        @foreach($shops_list as $shop)
                                            <option @if($shop->id == $animation->shops_id) selected @endif value="{{ $shop->id }}"> {{ $shop->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('shops_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-control-label" for="description">Description <span class="small text-danger">*</span> :</label>
                                <textarea id="description" name="description" class="summernote">{{ old('description', $animation->description) }}</textarea>
                            </div>

                        </div>

                        <div class="d-flex gap-2 justify-content-center mt-3">
                            <button type='button' class="btn btn-danger" onclick="location.href='{{ route('backend.specific.animations.index') }}'">
                                <i class="fa-solid fa-rotate-left"></i>&nbsp;Annuler
                            </button>
                            <button type="submit" class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i>
                                @if($animation->exists)
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
