@extends('frontend.profile.dashboard')
@section('title', __('Mes adresses') )


@section('dashboard-breadcrumb')
    <div style="margin-top: 60px;" class="mb-5">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-nav mt-5 p-3 rounded-3 shadow">
                <li class="breadcrumb-item"><a href="{{ route('index') }}"><i class="fa-solid fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Mon compte</a></li>
                <li class="breadcrumb-item"><a href="{{ route('address.index') }}">Mes adresses</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">@if ($adresse->exists) Modification @else Ajout @endif d'une adresse</li>
            </ol>
        </nav>
    </div>
@endsection

@section('dashboard-content')
    <div class="text-end mb-4">
        <a class="hvr-grow-shadow btn btn-warning" href="{{ route('address.index') }}"><i class="fa-solid fa-circle-left"></i> Retour</a>
    </div>

    <h2>@if ($adresse->exists) Modification @else Ajout @endif d'une adresse</h2>

    <div class="card p-3 w-100 hvr-shadow rounded-4 bg-gray">
        <form
            action="{{ route($adresse->exists ? 'address.update' : 'address.store', $adresse) }}"
            method="post" class="mt-6 space-y-6" enctype="multipart/form-data">
            @csrf
            @method($adresse->exists ? 'put' : 'post')

            <div class="form-group">
                <label class="form-control-label" for="alias">Alias <span
                        class="small text-danger">*</span> : </label>
                <input id="alias" type="text" name="alias"
                       class="@error('alias') is-invalid @enderror form-control w-50" required
                       value="{{ old('alias', $adresse->alias) }}">
                @error('alias')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-control-label" for="name">Nom <span
                        class="small text-danger">*</span> : </label>
                <input id="name" type="text" name="name"
                       class="@error('name') is-invalid @enderror form-control" required
                       value="{{ old('name', $adresse->name) }}">
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <div class="row">
                <div class="col-6">
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
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label class="form-control-label" for="address2">Complément d'adresse : </label>
                        <input id="address2" type="text" name="address2"
                               class="@error('address2') is-invalid @enderror form-control"
                               value="{{ old('address2', $adresse->address2) }}">
                        @error('address2')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label class="form-control-label" for="postal_code">Code postal <span
                                class="small text-danger">*</span> : </label>
                        <input id="postal_code" type="text" name="postal_code"
                               class="@error('postal_code') is-invalid @enderror form-control" required
                               value="{{ old('postal_code', $adresse->postal_code) }}" placeholder="974">
                        @error('postal_code')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-4">
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
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label class="form-control-label" for="country">Pays <span
                                class="small text-danger">*</span> : </label>
                        <input id="country" type="text" name="country"
                               class="@error('country') is-invalid @enderror form-control" required
                               value="{{ old('country', $adresse->country) }}" placeholder="La Réunion">
                        @error('country')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label class="form-control-label" for="phone">Téléphone <span
                                class="small text-danger">*</span> : </label>
                        <input id="phone" type="text" name="phone"
                               class="@error('phone') is-invalid @enderror form-control" required
                               value="{{ old('phone', $adresse->phone) }}" placeholder="0692">
                        @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label class="form-control-label" for="other_phone">Autre Téléphone : </label>
                        <input id="other_phone" type="text" name="other_phone"
                               class="@error('other_phone') is-invalid @enderror form-control"
                               value="{{ old('other_phone', $adresse->other_phone) }}">
                        @error('other_phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </div>




            <div class="form-group">
                <label class="form-control-label" for="other">Autre informations :</label>
                <input id="other" type="text" name="other"
                       class="@error('other') is-invalid @enderror form-control"
                       value="{{ old('other', $adresse->other) }}">
                @error('other')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>






            <div class="d-flex gap-2 justify-content-center mt-3">
                <button type="submit" class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i>
                    @if ($adresse->exists)
                        Modifier
                    @else
                        Ajouter
                    @endif
                </button>&nbsp;&nbsp;
            </div>

        </form>
    </div>


@endsection
