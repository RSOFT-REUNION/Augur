@extends('frontend.layouts.layout')
@section('title', $adresse->exists ? __('Modifier une adresse') : __('Créer une adresse'))

@section('main-content')

    <h1 class="text-center">
        @if ($adresse->exists)
            Modification
        @else
            Création
        @endif
        d'une adresse
    </h1>

    <div class="row row-flex">
        <div class="col-12 col-md-3"></div>
        <div class="col-12 col-md-6 align-self-center">
            <section class="card p-3 w-100 hvr-shadow rounded-4">
                <form
                    action="{{ route($adresse->exists ? 'adresse.update' : 'adresse.store', $adresse) }}"
                    method="post" class="mt-6 space-y-6" enctype="multipart/form-data">
                    @csrf
                    @method($adresse->exists ? 'put' : 'post')

                    <div class="form-group">
                        <label class="form-control-label" for="alias">Alias <span
                                class="small text-danger">*</span> : </label>
                        <input id="alias" type="text" name="alias"
                               class="@error('alias') is-invalid @enderror form-control" required
                               value="{{ old('alias', $adresse->alias) }}">
                        @error('alias')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-control-label" for="first_name">Prénom <span
                                class="small text-danger">*</span> : </label>
                        <input id="first_name" type="text" name="first_name"
                               class="@error('first_name') is-invalid @enderror form-control" required
                               value="{{ old('first_name', $adresse->first_name) }}">
                        @error('first_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-control-label" for="last_name">Nom <span
                                class="small text-danger">*</span> : </label>
                        <input id="last_name" type="text" name="last_name"
                               class="@error('last_name') is-invalid @enderror form-control" required
                               value="{{ old('last_name', $adresse->last_name) }}">
                        @error('last_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-control-label" for="address">Adresse <span
                                class="small text-danger">*</span> : </label>
                        <input id="address" type="text" name="address"
                               class="@error('address') is-invalid @enderror form-control" required
                               value="{{ old('address', $adresse->address) }}">
                        @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-control-label" for="address2">Complément d'adresse : </label>
                        <input id="address2" type="text" name="address2"
                               class="@error('address2') is-invalid @enderror form-control"
                               value="{{ old('address2', $adresse->address2) }}">
                        @error('address2')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-control-label" for="other">Autre :</label>
                        <input id="other" type="text" name="other"
                               class="@error('other') is-invalid @enderror form-control"
                               value="{{ old('other', $adresse->other) }}">
                        @error('other')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-control-label" for="postal_code">Code postal <span
                                class="small text-danger">*</span> : </label>
                        <input id="postal_code" type="text" name="postal_code"
                               class="@error('postal_code') is-invalid @enderror form-control" required
                               value="{{ old('postal_code', $adresse->postal_code) }}">
                        @error('postal_code')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-control-label" for="city">Ville <span
                                class="small text-danger">*</span> : </label>
                        <input id="city" type="text" name="city"
                               class="@error('city') is-invalid @enderror form-control" required
                               value="{{ old('city', $adresse->city) }}">
                        @error('city')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-control-label" for="country">Pays <span
                                class="small text-danger">*</span> : </label>
                        <input id="country" type="text" name="country"
                               class="@error('country') is-invalid @enderror form-control" required
                               value="{{ old('country', $adresse->country) }}">
                        @error('country')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-control-label" for="phone">Téléphone <span
                                class="small text-danger">*</span> : </label>
                        <input id="phone" type="text" name="phone"
                               class="@error('phone') is-invalid @enderror form-control" required
                               value="{{ old('phone', $adresse->phone) }}">
                        @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-control-label" for="other_phone">Autre Téléphone : </label>
                        <input id="other_phone" type="text" name="other_phone"
                               class="@error('other_phone') is-invalid @enderror form-control"
                               value="{{ old('other_phone', $adresse->other_phone) }}">
                        @error('other_phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2 justify-content-center mt-3">
                        <button type='button' class="btn btn-danger"
                                onclick="location.href='{{ route('adresse.index') }}'">
                            <i class="fa-solid fa-rotate-left"></i>&nbsp;Annuler
                        </button>
                        <button type="submit" class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i>
                            @if ($adresse->exists)
                                Modifier
                            @else
                                Créer
                            @endif
                        </button>&nbsp;&nbsp;
                    </div>

                </form>
            </section>
        </div>
        <div class="col-12 col-md-3"></div>
    </div>



@endsection
