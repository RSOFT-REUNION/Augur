<main role="main" id="backend_content">
    <div class="entry-header flex items-center">
        <div class="flex-1">
            <h1>Liste des messages</h1>
        </div>
        <div class="flex-none inline-flex items-center">
            {{--<div class="textfield-line">
                <label for="search"><i class="fa-solid fa-magnifying-glass"></i></label>
                <input type="text" placeholder="Rechercher..." wire:model.live="search" class="focus:outline-none" role="searchbox">
            </div>--}}
            <p class="bg-gray-100 block py-2 px-4 rounded-lg ml-2">{{ $messages->count() }}</p>
        </div>
    </div>
    <div class="entry-content">
        @if($messages->count() > 0)
            <div class="table-primary">
                <table>
                    <thead>
                    <tr>
                        <th>Lu</th>
                        <th>Nom & prénom</th>
                        <th>Adresse e-mail</th>
                        <th>Sujet</th>
                        <th>Date d'envoie</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($messages as $message)
                        <tr class="hover:bg-blue-100 cursor-pointer" wire:click="$dispatch('openModal', { component: 'popups.backend.sav-show-message', arguments: {{ json_encode(['message_id' => $message->id]) }} })">
                            <td>{!! $message->getReadState() !!}</td>
                            <td>{{ $message->lastname }} {{ $message->firstname }}</td>
                            <td>{{ $message->email }}</td>
                            <td>{{ $message->subject }}</td>
                            <td>{{ $message->getDate() }}</td>
                            <td><a wire:click="deleteMessage({{ $message->id }})" class="hover:text-red-500 cursor-pointer"><i class="fa-solid fa-trash-can"></i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-5">
                {{ $messages->links() }}
            </div>
        @else
            <p class="text-center bg-gray-100 py-3 rounded-lg">Vous n'avez aucun message de contact</p>
        @endif
    </div>
</main>
