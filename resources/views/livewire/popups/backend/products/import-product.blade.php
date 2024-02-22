<div id="popup">
    <div class="entry-header">
        <div class="flex items-center">
            <div class="flex-1">
                <h1>Importer des produits</h1>
            </div>
            <div class="flex-none">
                <a wire:click="$dispatch('closeModal')" class="btn-icon_secondary_2 block text-black"><i class="fa-solid fa-xmark"></i></a>
            </div>
        </div>
    </div>
    <div class="entry-content">
        <p class="bg-gray-100 px-4 py-2 rounded-lg">
            Vous êtes sur le point d'importer une liste de produits, votre fichier d'import doit absolument être au format <b>CSV (point-virgule)</b>.
            Vous pouvez <a href="" class="underline cursor-pointer">télécharger le template</a> à suivre.
        </p>
        <div class="mt-5">
            <form wire:submit="import" enctype="multipart/form-data">
                @csrf
                <div class="textfield">
                    <label for="file_import">Fichier d'import</label>
                    <input type="file" id="file_import" wire:model.live="file_import" name="file_import" class="@if($errors->has('file_import'))textfield-error @endif" value="{{ old('file_import') }}">
                    @if($errors->has('file_import'))
                        <p class="text-input-error">{{ $errors->first('file_import') }}</p>
                    @endif
                </div>
                <div class="mt-5 text-right">
                    <button type="submit" class="btn-filled_secondary">Importer</button>
                </div>
            </form>
        </div>
    </div>
</div>
