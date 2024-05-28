<div class="card border-left-secondary shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-secondary">Complémentaires (Spécifiques selon le client)</h6>
    </div>
    <div class="card-body">

        <div class="m-0w">
            <label for="permissions" class="form-label">Labels</label>
            <select class="form-select tomselectmultiple @error('labels') is-invalid @enderror" multiple aria-label="Labels" id="labels" name="labels[]">
                @foreach($labels as $label)
                    <option value="{{ $label->id }}"  {{ in_array($label->id, $product_labels ?? []) ? 'selected' : '' }} {{ in_array($label->id, old('labels') ?? []) ? 'selected' : '' }}>
                        {{ $label->name }}
                    </option>
                @endforeach
            </select>
            @error('labels')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>


        <div class="form-group">
            <label class="form-control-label" for="code_article">Code Article</label>
            <input type="text" id="code_article" name="code_article"
                   class="@error('code_article') is-invalid @enderror form-control"
                   value="{{ old('code_article', $product->code_article) }}">
            @error('code_article')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label class="form-control-label" for="composition">Composition (ingrédients, allergènes etc.) </label>
            <textarea name="composition" id="composition" class="@error('composition') is-invalid @enderror form-control">{{ old('composition', $product->composition) }}</textarea>
            <div id="composition" class="form-text">Indiquez ici les matériaux, la provenance des ingrédients, les allergènes. Maximum 255 caractères.</div>
            @error('composition')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label class="form-control-label" for="tags">Tags </label>
            <textarea type="text" id="tags" name="tags"
                      style="height: 100px;"
                      class="@error('tags') is-invalid @enderror form-control">{{ old('tags', $product->tags) }}</textarea>
            <div id="composition" class="form-text">Pour le référencement et les statistiques de vente.</div>
            @error('tags')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        {{--<div class="col">
            <label class="form-control-label" for="tags">Tags </label>
            <select class="form-select tomselect @error('tags') is-invalid @enderror"
                    id="tags"
                    name="tags">
                <option value=""></option>
                --}}{{-- @foreach($tags as $tag)
                     <option @if($product->tags == $tag->id) selected @endif value="{{ $tag->id }}"> {{ $brand->name }}</option>
                 @endforeach--}}{{--
            </select>
            @error('tags')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            </div>--}}
    </div>
</div>
