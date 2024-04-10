@extends('backend.layouts.layout')
@section('title', $brands->exists ? __('Modifier une marque') : __('Créer une marque'))

@section('main-content')

    <div class="row m-2">
        <div class="col">
            <div class="card border-left-primary shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"> @if($brands->exists)
                            Modification
                        @else
                            Création
                        @endif
                        d'une marque</h6>
                </div>

                <div class="card-body">

                    <form action="{{ route($brands->exists ? 'backend.catalog.brands.update' : 'backend.catalog.brands.store', $brands) }}" method="post"  class="mt-6 space-y-6">
                        @csrf
                        @method($brands->exists ? 'put' : 'post')

                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <label class="form-control-label" for="name">Nom de la marque <span class="small text-danger">*</span></label>
                                    <input id="name" type="text" name="name"
                                           class="@error('name') is-invalid @enderror form-control" required
                                           value="{{ old('name', $brands->name) }}">
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="slug">Slug</label>
                                    <input id="slug" type="text" name="slug" disabled
                                           class="@error('slug') is-invalid @enderror form-control"
                                           value="{{ $brands->slug }}">
                                    @error('slug')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="m-0w">
                            <div class="form-group">
                                <label class="form-control-label" for="description">Description <span class="small text-danger">*</span></label>
                                <textarea name="description" id="description" class="@error('description') is-invalid @enderror form-control" required>{{ old('description', $brands->description) }}</textarea>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex gap-2 justify-catalog-center mt-3">
                            <button type='button' class="btn btn-danger" onclick="location.href='{{ route('backend.catalog.brands.index') }}'">
                                <i class="fa-solid fa-rotate-left"></i>&nbsp;Annuler
                            </button>
                            <button type="submit" class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i>
                                @if($brands->exists)
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
