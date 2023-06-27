<div>
    <div class="entry-header flex items-center">
        <div class="flex-1">
            <h1>Réglages généraux</h1>
        </div>
        <div class="flex-none inline-flex items-center">

        </div>
    </div>
    <div class="entry-content">
        <div class="text-line_input">
            <div class="flex items-center">
                <div class="flex-1">
                    <h3>Passer le site en maintenance</h3>
                    <p>Votre site ne sera plus accessible pour les personne ne faisant pas partie de votre organisation</p>
                </div>
                <div class="flex-none">
                    <label for="maintenance_mode" class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" wire:click="maintenance_mode" id="maintenance_mode" class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    </label>
                </div>
            </div>
        </div>
        <div class="text-line_input mt-2">
            <div class="flex items-center">
                <div class="flex-1">
                    <h3>Type de maintenance</h3>
                    <p>Sélectionnez la raison de votre maintenance</p>
                </div>
                <div class="flex-none">
                    <form class="inline-flex items-center">
                        @csrf
                        <div class="textfield">
                            <select wire:model="mainteance_type" class="focus:outline-none">
                                <option value="">-- Sélectionnez un type --</option>
                                <option value="1">Maintenance pour test de nouvelles fonctionnalités</option>
                                <option value="2">Maintenance pour correction</option>
                            </select>
                        </div>
                        <button type="submit" class="btn-icon_secondary ml-2"><i class="fa-solid fa-floppy-disk"></i></button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
