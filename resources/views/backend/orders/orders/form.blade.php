@extends('backend.layouts.layout')
@section('title', $orders->exists ? __('Modifier une commande') : __('Créer une commande'))

@section('main-content')

    <div class="row m-2">
        <div class="col">
            <div class="card border-left-primary shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"> @if($orders->exists)
                            Modification
                        @else
                            Création
                        @endif
                        d'une commande</h6>
                </div>

                <div class="card-body">

                    <form action="{{ route($orders->exists ? 'backend.orders.orders.update' : 'backend.orders.orders.store', $orders) }}" method="post"  class="mt-6 space-y-6">
                        @csrf
                        @method($orders->exists ? 'put' : 'post')

                        <div class="row">

                            <div class="col-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="created_at">Date de la commande</label>
                                    <input id="created_at" type="text" name="created_at" disabled
                                           class="@error('created_at') is-invalid @enderror form-control"
                                           value="{{ $orders->created_at }}">
                                    @error('created_at')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="reference">Référence de commande </label>
                                    <input id="reference" type="text" name="reference" disabled placeholder="Réf. (à venir)"
                                           class="@error('reference') is-invalid @enderror form-control" required
                                           value="{{ old('reference', $orders->reference) }}">
                                    @error('reference')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-3">
                                {{-- <div class="form-group">
                                    <label class="form-control-label" for="customer_id">Nom du client </label>
                                    <input id="customer_id" type="text" name="customer_id" disabled
                                           class="@error('customer_id') is-invalid @enderror form-control" required
                                           value="{{ old('customer_id', getCustomerName($order->customer_id)) }}">
                                    @error('customer_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div> --}}
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="total">Total (€) <span class="small text-danger">*</span></label>
                                    <input id="total" type="text" name="total"
                                           class="@error('total') is-invalid @enderror form-control" required
                                           value="{{ old('total', $orders->total) }}">
                                    @error('total')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="delivery_type">Type de livraison <span class="small text-danger">*</span></label>
                                    <select name="delivery_type" id="delivery_type" class="@error('delivery_type') is-invalid @enderror form-control" required>
                                        <option value="retrait en magasin" {{ old('delivery_type', $orders->delivery_type) == 'retrait en magasin' ? 'selected' : '' }}>Retrait en magasin</option>
                                        <option value="livraison à domicile" {{ old('delivery_type', $orders->delivery_type) == 'livraison à domicile' ? 'selected' : '' }}>Livraison à domicile</option>
                                    </select>
                                    @error('delivery_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <label class="form-control-label" for="delivery_location">Adresse de livraison <span class="small text-danger">*</span></label>
                                    <input id="delivery_location" type="text" name="delivery_location"
                                           class="@error('delivery_location') is-invalid @enderror form-control"
                                           value="{{ $orders->delivery_location }}">
                                    @error('delivery_location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>




                        <div class="m-0w">
                            <div class="form-group">
                                <label class="form-control-label" for="status">Statut <span class="small text-danger">*</span></label>
                                <select name="status_id" id="status_id" class="@error('status') is-invalid @enderror form-control" required>
                                    @foreach($status_list as $status)
                                        <option value="{{ $status->id }}">{{ $status->status }}</option>
                                    @endforeach
                                </select>
                                @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex gap-2 justify-content-center mt-3">
                            <button type='button' class="btn btn-danger" onclick="location.href='{{ route('backend.orders.orders.index') }}'">
                                <i class="fa-solid fa-rotate-left"></i>&nbsp;Annuler
                            </button>
                            <button type="submit" class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i>
                                @if($orders->exists)
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
