<div id="popup">
    <div class="entry-header">
        <div class="flex items-center">
            <div class="flex-1">
                <h1>Ajouter d'un membre dans l'équipe</h1>
            </div>
            <div class="flex-none">
                <a wire:click="$emit('closeModal')" class="btn-icon_secondary_2 block text-black"><i class="fa-solid fa-xmark"></i></a>
            </div>
        </div>
    </div>
    <div class="entry-content">
        <form wire:submit.prevent="add">
            @csrf
            <div class="textfield">
                <label for="member">Utilisateur<span class="text-red-500">*</span></label>
                <select wire:model="member" id="member">
                    <option value="">-- Sélectionner un membre --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->lastname }} {{ $user->firstname }} ({{ $user->email }})</option>
                    @endforeach
                </select>
            </div>
            @if($member)
                <div class="mt-5 text-right">
                    <button type="submit" class="btn-filled_secondary">Ajouter</button>
                </div>
            @endif
        </form>
    </div>
</div>
