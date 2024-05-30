<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="modal-create" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="modal-body mb-3 m-2 ml-4 mr-4">
                <form id="createForm" class="justify-content-center" action="{{ route('backend.catalog.discounts.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

<div class="row">
    {{-- NOM --}}
    <div class="form-group col-8">
        <label class="form-control-label" for="name">Nom de la promotion <span class="small text-danger">(obligatoire)</span></label>
        <input type="text" id="name" name="name"
               class="@error('name') is-invalid @enderror form-control required"
               value="{{ old('name') }}">
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- POURCENTAGE DE REMISE --}}
    <div class="form-group col-4">
        <label for="percentage" class="form-label">Pourcentage de remise</label>
        <div class="input-group">
            <input type="number" class="@error('percentage') is-invalid @enderror form-control" min="1" max="100" id="percentage" name="percentage" value="{{ old('percentage') }}">
            <span class="input-group-text">%</span>
        </div>
        @error('percentage')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>


                    <div class="row">
                        <div class="col">
                            {{--DATES --}}
                            <div class="form-group">
                                <label class="form-control-label" for="start_date">Début : </label>
                                <input type="date" id="start_date" name="start_date"
                                       class="@error('start_date') is-invalid @enderror form-control"
                                       value="{{ old('start_date') }}">
                                @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="end_date">Fin : </label>
                                <input type="date" id="end_date" name="end_date"
                                       class="@error('end_date') is-invalid @enderror form-control"
                                       value="{{ old('end_date') }}">
                                @error('end_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                        {{-- ICONE --}}
                        <div class="col">
                            <div class="form-group">
                                <div class="row">
                                    <label class="form-control-label" for="icon">Icône</label>
                                </div>
                                <div>
                                    <input type="radio" class="btn-check" name="icon" id="star" @if( (old('icon') == 'star') || (old('icon') == null)) checked @endif value="star">
                                    <label class="btn btn-lg btn-outline-dark hvr-grow" for="star"><i class="fa-regular fa-star"></i></label>

                                    <input type="radio" class="btn-check" name="icon" id="heart" @if(old('icon') == 'heart') checked @endif value="heart">
                                    <label class="btn btn-lg btn-outline-dark hvr-grow" for="heart"><i class="fa-regular fa-heart"></i></label>

                                    <input type="radio" class="btn-check hvr-shrink" name="icon" id="bolt" @if(old('icon') == 'bolt') checked @endif value="bolt">
                                    <label class="btn btn-lg btn-outline-dark hvr-grow" for="bolt"><i class="fa-regular fa-bolt"></i></label>

                                    <input type="radio" class="btn-check hvr-shrink" name="icon" id="gift" @if(old('icon') == 'gift') checked @endif value="gift">
                                    <label class="btn btn-lg btn-outline-dark hvr-grow" for="gift"><i class="fa-regular fa-gift"></i></label>

                                    <input type="radio" class="btn-check hvr-shrink" name="icon" id="snowflake" @if(old('icon') == 'snowflake') checked @endif value="snowflake">
                                    <label class="btn btn-lg btn-outline-dark hvr-grow" for="snowflake"><i class="fa-regular fa-snowflake"></i></label>

                                    <input type="radio" class="btn-check hvr-shrink" name="icon" id="grill-hot" @if(old('icon') == 'grill-hot') checked @endif value="grill-hot">
                                    <label class="btn btn-lg btn-outline-dark hvr-grow" for="grill-hot"><i class="fa-regular fa-grill-hot"></i></label>

                                    <input type="radio" class="btn-check hvr-shrink" name="icon" id="fish" @if(old('icon') == 'fish') checked @endif value="fish">
                                    <label class="btn btn-lg btn-outline-dark hvr-grow" for="fish"><i class="fa-regular fa-fish"></i></label>

                                    <input type="radio" class="btn-check hvr-shrink" name="icon" id="leaf" @if(old('icon') == 'leaf') checked @endif value="leaf">
                                    <label class="btn btn-lg btn-outline-dark hvr-grow" for="leaf"><i class="fa-regular fa-leaf"></i></label>

                                    <input type="radio" class="btn-check hvr-shrink" name="icon" id="award" @if(old('icon') == 'award') checked @endif value="award">
                                    <label class="btn btn-lg btn-outline-dark hvr-grow" for="award"><i class="fa-regular fa-award"></i></label>

                                    <input type="radio" class="btn-check hvr-shrink" name="icon" id="head-side" @if(old('icon') == 'head-side') checked @endif value="head-side">
                                    <label class="btn btn-lg btn-outline-dark hvr-grow" for="head-side"><i class="fa-regular fa-head-side"></i></label>

                                    <input type="radio" class="btn-check hvr-shrink" name="icon" id="meat" @if(old('icon') == 'meat') checked @endif value="meat">
                                    <label class="btn btn-lg btn-outline-dark hvr-grow" for="meat"><i class="fa-regular fa-meat"></i></label>

                                    <input type="radio" class="btn-check hvr-shrink" name="icon" id="sparkles" @if(old('icon') == 'sparkles') checked @endif value="sparkles">
                                    <label class="btn btn-lg btn-outline-dark hvr-grow" for="sparkles"><i class="fa-regular fa-sparkles"></i></label>

                                    <input type="radio" class="btn-check hvr-shrink" name="icon" id="bookmark" @if(old('icon') == 'bookmark') checked @endif value="bookmark">
                                    <label class="btn btn-lg btn-outline-dark hvr-grow" for="bookmark"><i class="fa-regular fa-bookmark"></i></label>

                                    <input type="radio" class="btn-check hvr-shrink" name="icon" id="circle-euro" @if(old('icon') == 'circle-euro') checked @endif value="circle-euro">
                                    <label class="btn btn-lg btn-outline-dark hvr-grow" for="circle-euro"><i class="fa-regular fa-circle-euro"></i></label>

                                    <input type="radio" class="btn-check hvr-shrink" name="icon" id="mug-tea" @if(old('icon') == 'mug-tea') checked @endif value="mug-tea">
                                    <label class="btn btn-lg btn-outline-dark hvr-grow" for="mug-tea"><i class="fa-regular fa-mug-tea"></i></label>

                                    <input type="radio" class="btn-check hvr-shrink" name="icon" id="watermelon-slice" @if(old('icon') == 'watermelon-slice') checked @endif value="watermelon-slice">
                                    <label class="btn btn-lg btn-outline-dark hvr-grow" for="watermelon-slice"><i class="fa-regular fa-watermelon-slice"></i></label>

                                    <input type="radio" class="btn-check hvr-shrink" name="icon" id="tree-palm" @if(old('icon') == 'tree-palm') checked @endif value="tree-palm">
                                    <label class="btn btn-lg btn-outline-dark hvr-grow" for="tree-palm"><i class="fa-regular fa-tree-palm"></i></label>

                                    <input type="radio" class="btn-check hvr-shrink" name="icon" id="user-tie" @if(old('icon') == 'user-tie') checked @endif value="user-tie">
                                    <label class="btn btn-lg btn-outline-dark hvr-grow" for="user-tie"><i class="fa-regular fa-user-tie"></i></label>
                                </div>
                                <div id="icon" class="form-text">
                                    <i class="fa-light fa-circle-info"></i>
                                    L'icône sert à l'affichage côté client dans les menus de navigations, sur les filtres promos etc.
                                </div>
                                @error('icon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>


                    {{-- DESCRIPTION COURTE --}}
                    <div class="form-group">
                        <label class="form-control-label" for="short_description">Description courte <span class="small text-body-secondary">(facultatif)</span></label>
                        <textarea id="short_description" name="short_description" maxlength="255" rows="3"
                               class="@error('short_description') is-invalid @enderror form-control">{{ old('short_description') }}</textarea>
                        <div id="price_ttc" class="form-text">Maximum 255 caractères.</div>
                        @error('short_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between pt-3">
                        <p class="small text-danger"></p>
                        <div class="d-flex">
                            <div class="form-check form-switch d-flex align-items-center mx-3">
                                <input type="checkbox" id="active" name="active"
                                       role="switch" checked
                                       class="form-check-input">
                                <label class="form-check-label" for="active">Activer</label>
                            </div>
                            <button type="submit" class="btn btn-primary text-nowrap">Valider</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>







