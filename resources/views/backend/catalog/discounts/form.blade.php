@extends('backend.layouts.layout')
@section('title', $discount->exists ? __('Modifier une promotion') : __('Créer une promotion'))

@section('main-content')
    <form action="{{ route($discount->exists ? 'backend.catalog.discounts.update' : 'backend.catalog.discounts.store', $discount) }}" method="post"  class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method($discount->exists ? 'put' : 'post')

        <div class="d-flex gap-2 justify-content-end mb-3 me-5">
            <div class="form-check form-switch d-flex align-items-center">
                <input class="form-check-input"
                       @if(!$discount->exists) checked @endif
                        @if($discount->active) checked @endif
                        type="checkbox" role="switch" id="active" name="active">
                 <label class="form-check-label" for="active">Activer</label>
             </div>
            <button type='button' class="btn btn-danger hvr-float-shadow"
                    onclick="location.href='{{ route('backend.catalog.discounts.index') }}'">
                <i class="fa-solid fa-rotate-left"></i>&nbsp;Annuler
            </button>
            <button type="submit" class="btn btn-success hvr-float-shadow"><i class="fa-solid fa-pen-to-square"></i>
                @if ($discount->exists)
                    Modifier
                @else
                    Créer
                @endif
            </button>
        </div>

            <div class="row m-2">




                <div class="col-md-8 col-12">

                    <div class="card border-left-secondary shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-secondary">Dates</h6>
                        </div>
                        <div class="card-body row">
                            <div class="form-group col">
                                <label class="form-control-label" for="start_date">Date de début <span class="small text-danger">*</span> : </label>
                                <input id="start_date" type="datetime-local" name="start_date"
                                       class="@error('start_date') is-invalid @enderror form-control" required
                                       value="{{ old('start_date', $discount->start_date) }}">
                                @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col">
                                <label class="form-control-label" for="end_date">Date de fin <span class="small text-danger">*</span> : </label>
                                <input id="end_date" type="datetime-local" name="end_date"
                                       class="@error('end_date') is-invalid @enderror form-control" required
                                       value="{{ old('end_date', $discount->end_date) }}">
                                @error('end_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>




                    <div class="card border-left-primary shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Informations</h6>
                        </div>

                        <div class="card-body">

                            <div class="row">
                                <div class="form-group col">
                                    <label class="form-control-label" for="name">Nom <span
                                            class="small text-danger">*</span></label>
                                    <input id="name" type="text" name="name"
                                           class="@error('name') is-invalid @enderror form-control" required
                                           value="{{ old('name', $discount->name) }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col">
                                    <label class="form-control-label" for="code">Code EBP</label>
                                    <input id="code" type="text" name="code"
                                           class="@error('code') is-invalid @enderror form-control"
                                           value="{{ old('code', $discount->code) }}">
                                    @error('code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="discount_rule_id" class="form-control-label">Règle de calcul <span class="small text-danger">*</span></label>
                                <button
                                    hx-target="#addDiscountRuleModal"
                                    hx-trigger="click"
                                    data-bs-toggle="modal"
                                    data-bs-target="#addDiscountRuleModal"
                                    class="btn btn-light btn-sm"><i class="fa-solid fa-plus">
                                    </i> Ajouter une règle de calcul
                                </button>
                                <select class="form-select @error('discount_rule_id') is-invalid @enderror" aria-label="discount_rule_id"
                                        id="discount_rule_id" name="discount_rule_id">
                                    @foreach($rules_list as $rule)
                                        <option @if($rule->id == $discount->discount_rule_id) selected @endif value="{{ $rule->id }}"> {{ $rule->name }}</option>
                                    @endforeach
                                </select>
                                @error('discount_rule_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-control-label" for="description">Description courte</label>
                                <textarea name="description" id="description" class="@error('description') is-invalid @enderror form-control">{{ old('description', $discount->description) }}</textarea>
                                @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="card border-left-primary shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Produits remisés</h6>
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('backend.catalog.discounts.create') }}"
                                   class="btn btn-success hvr-float-shadow"><i class="fa-solid fa-plus"></i> Ajouter un produit</a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive mb-3">
                                <table id="datatable" class="table datatable table-hover table-bordered w-100">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="text-center" style="width: 5%;">#</th>
                                        <th scope="col" class="text-center">Image</th>
                                        <th scope="col" class="text-center">Libellé</th>
                                        <th scope="col" class="text-center">Prix de base</th>
                                        <th scope="col" class="text-center">Prix remisé</th>
                                        <th scope="col" class="text-center">Stock</th>
                                        <th scope="col" class="text-center no-sort" width="8%"><i class="fa-duotone fa-arrows-minimize"></i></th>
                                    </tr>
                                    </thead>

                                    @foreach ($details as $detail)
                                        <tr>
                                            <td class="text-center align-middle">{{ $detail->product->id }}</td>
                                            <td class="text-center align-middle">{{ $detail->product->getFirstImages($product) }}</td>
                                            <td class="text-center align-middle">{{ $detail->product->name }} <br> <span class="fw-lighter fst-italic">lien de la fiche produit: {{ $detail->product->slug }}</span> </td>
                                            <td class="text-center align-middle">HT: {{ formatPriceToFloat($detail->product->price_ht) }} €  | TTC: {{ formatPriceToFloat($detail->product->price_ttc) }} €</td>
                                            <td class="text-center align-middle">{{ formatPriceToFloat($detail->product->tva) }} %</td>
                                            <td class="text-center align-middle">{{ formatStockToFloat($product->stock) }}</td>
                                            <td class="text-center">
                                                @can('catalog.shops.update')
                                                    <a href="{{ route('backend.catalog.shops.edit', $detail->id) }}"
                                                       class="btn btn-success btn-sm hvr-grow" title="Modifier"><i
                                                            class="fa-solid fa-pen-to-square"></i></a>
                                                @endcan
                                                @can('catalog.shops.delete')
                                                    <button type="button" class="btn btn-danger btn-sm hvr-grow"
                                                            title="Supprimer"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#deleteModal{{ $detail->id }}">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                @endcan
                                            </td>
                                        </tr>
                                        @include('backend.layouts.modal-delete', ['id' => $detail->id, 'title' => 'Êtes-vous sûr de vouloir supprimer cette promotion '.$detail->name.' ?', 'route' => 'backend.catalog.discounts.destroy'])
                                    @endforeach

                                </table>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="col-md-4 col-12">
                    <div class="card border-left-warning shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-warning">Image</h6>
                        </div>
                        <div class="card-body">
                            @if (!'/storage/upload/catalog/discounts/'.$discount->image)
                                <img class="w-100" src="/storage/upload/catalog/discounts/{{ $discount->image }}"  alt="{{ $discount->name }}">
                            @endif
                            <div class="form-group mt-3">
                                <label class="form-control-label" for="image">
                                    @if (!'/storage/upload/catalog/discounts/'.$discount->image)
                                        Changer l'image :
                                    @else
                                        Image :
                                    @endif
                                </label>
                                <input type="file" name="image" id="image"
                                       class="@error('image') is-invalid @enderror form-control"
                                       value="{{ old('image', $discount->image) }}"></input>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>


                </div>

            </div>

</form>


{{--        <div class="modal fade" id="addDiscountRuleModal" tabindex="-1" role="dialog" aria-labelledby="addDiscountRuleModalTitle" aria-hidden="true">
            <form action="{{route('backend.catalog.discounts.add_rule')}}" method="post"  class="mt-6 space-y-6">
                @csrf
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addDiscountRuleModalTitle">Ajouter une règle de calcul</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group col">
                                <label class="form-control-label" for="name">Date de fin <span class="small text-danger">*</span> : </label>
                                <input id="name" type="datetime-local" name="name"
                                       class="@error('name') is-invalid @enderror form-control" required
                                       value="{{ old('name', $rule->name) }}">
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                            <button class="btn btn-success">Ajouter</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>--}}

@endsection
