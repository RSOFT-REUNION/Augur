<div>
    <div class="entry-header flex items-center">
        <div class="flex-1">
            <h1>Équipe</h1>
        </div>
        <div class="flex-none inline-flex items-center">
            <button wire:click="$dispatch('openModal', { component: 'popups.backend.add-team' })" class="btn-filled_secondary">Ajouter un membre</button>
        </div>
    </div>
    <div class="entry-content">
        @if($teams->count() > 0)
            <div class="table-primary">
                <table>
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Adresse e-mail</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($teams as $team)
                        <tr>
                            <td>{{ $team->id }}</td>
                            <td>{{ $team->lastname }}</td>
                            <td>{{ $team->firstname }}</td>
                            <td>{{ $team->email }}</td>
                            <td><a wire:click="deletedRole({{ $team->id }})" class="hover:text-red-500 cursor-pointer"><i class="fa-solid fa-trash"></i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="empty-text">Aucun membre est mentionner comme faisant partie de votre organisation</p>
        @endif
    </div>
</div>
