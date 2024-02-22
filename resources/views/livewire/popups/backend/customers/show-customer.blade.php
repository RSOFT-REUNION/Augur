<div id="popup">
    <div class="entry-header">
        <div class="flex items-center">
            <div class="flex-1">
                <h1><strong>{{ $user->lastname }}</strong> {{ $user->firstname }}</h1>
            </div>
            <div class="flex-none">
                <a wire:click="$dispatch('closeModal')" class="btn-icon_secondary_2 block text-black"><i class="fa-solid fa-xmark"></i></a>
            </div>
        </div>
    </div>
    <div class="entry-content">
        @if($user->EBP_customer != null)
            <div class="bg-primary text-white py-5 px-10 rounded-md drop-shadow-xl mb-3">
                <div class="flex items-center">
                    <div class="flex-1">
                        <p class="font-bold">Points de fidélité</p>
                    </div>
                    <div class="flex-none">
                        <p class="text-4xl font-bold">{{ $user->getFidelityPoint() }}</p>
                    </div>
                </div>
            </div>
        @endif
        <div class="mt-2">
            <x-partials.inputs.box-text label="Code client EBP" content="{{ $user->getEBPCustomer() }}" class="" />
            <x-partials.inputs.box-text label="Nom de famille" content="{{ $user->lastname }}" class="mt-2" />
            <x-partials.inputs.box-text label="Prénom" content="{{ $user->firstname }}" class="mt-2" />
            <x-partials.inputs.box-text label="Numéro de téléphone" content="{{ $user->getPhone() }}" class="mt-2" />
            <x-partials.inputs.box-text label="Adresse e-mail" content="{{ $user->email }}" class="mt-2" />
            <x-partials.inputs.box-text label="Abonnée à la newsletter" content="{!! $user->newsletterIcon() !!}" class="mt-2" />
        </div>
    </div>
</div>
