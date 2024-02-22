<div>
    <div class="entry-header flex items-center">
        <div class="flex-1">
            <h1>Réglages information</h1>
        </div>
        <div class="flex-none inline-flex items-center">

        </div>
    </div>
    <div class="entry-content">
        <div class="text-line_input mt-2">
            <div class="flex items-center">
                <div class="flex-1">
                    <h3>Adresse e-mail principal</h3>
                    <p>Cette adresse e-mail sera visible sur votre site pour tout les utilisateurs</p>
                </div>
                <div class="flex-none">
                    <form wire:submit="updateMainEmail" class="inline-flex items-center">
                        @csrf
                        <div class="textfield">
                            <input type="text" wire:model.live="main_email" placeholder="Adresse e-mail principal" class="focus:outline-none">
                        </div>
                        @if($settingGlobal->main_email != $main_email)
                            <button type="submit" class="btn-icon_secondary ml-2"><i class="fa-solid fa-floppy-disk"></i></button>
                        @endif
                    </form>

                </div>
            </div>
        </div>
        <div class="text-line_input mt-2">
            <div class="flex items-center">
                <div class="flex-1">
                    <h3>Numéro de téléphone principal</h3>
                    <p>Ce numéro sera visible sur votre site pour tout les utilisateurs</p>
                </div>
                <div class="flex-none">
                    <form wire:submit="updateMainPhone" class="inline-flex items-center">
                        @csrf
                        <div class="textfield">
                            <input type="text" wire:model.live="main_phone" placeholder="Numéro de téléphone principal" class="focus:outline-none">
                        </div>
                        @if($settingGlobal->main_phone != $main_phone)
                            <button type="submit" class="btn-icon_secondary ml-2"><i class="fa-solid fa-floppy-disk"></i></button>
                        @endif
                    </form>

                </div>
            </div>
        </div>
        <div class="text-line_input mt-2">
            <div class="flex items-center">
                <div class="flex-1">
                    <h3>Votre Facebook</h3>
                    <p>Les utilisateurs pourront accèder à votre facebook directement depuis votre site.</p>
                </div>
                <div class="flex-none">
                    <form wire:submit="updateSocialFacebook" class="inline-flex items-center">
                        @csrf
                        <div class="textfield">
                            <input type="text" wire:model.live="social_facebook" placeholder="Compte facebook" class="focus:outline-none">
                        </div>
                        @if($settingGlobal->social_facebook != $social_facebook)
                            <button type="submit" class="btn-icon_secondary ml-2"><i class="fa-solid fa-floppy-disk"></i></button>
                        @endif
                    </form>

                </div>
            </div>
        </div>
        <div class="text-line_input mt-2">
            <div class="flex items-center">
                <div class="flex-1">
                    <h3>Votre Instagram</h3>
                    <p>Les utilisateurs pourront accèder à votre instagram directement depuis votre site.</p>
                </div>
                <div class="flex-none">
                    <form wire:submit="updateSocialinsta" class="inline-flex items-center">
                        @csrf
                        <div class="textfield">
                            <input type="text" wire:model.live="social_insta" placeholder="Compte instagram" class="focus:outline-none">
                        </div>
                        @if($settingGlobal->social_insta != $social_insta)
                            <button type="submit" class="btn-icon_secondary ml-2"><i class="fa-solid fa-floppy-disk"></i></button>
                        @endif
                    </form>

                </div>
            </div>
        </div>
        <div class="text-line_input mt-2">
            <div class="flex items-center">
                <div class="flex-1">
                    <h3>Votre Twitter</h3>
                    <p>Les utilisateurs pourront accèder à votre twitter directement depuis votre site.</p>
                </div>
                <div class="flex-none">
                    <form wire:submit="updateSocialtwitter" class="inline-flex items-center">
                        @csrf
                        <div class="textfield">
                            <input type="text" wire:model.live="social_twitter" placeholder="Compte twitter" class="focus:outline-none">
                        </div>
                        @if($settingGlobal->social_twitter != $social_twitter)
                            <button type="submit" class="btn-icon_secondary ml-2"><i class="fa-solid fa-floppy-disk"></i></button>
                        @endif
                    </form>

                </div>
            </div>
        </div>
        <div class="text-line_input mt-2">
            <div class="flex items-center">
                <div class="flex-1">
                    <h3>Votre Youtube</h3>
                    <p>Les utilisateurs pourront accèder à votre youtube directement depuis votre site.</p>
                </div>
                <div class="flex-none">
                    <form wire:submit="updateSocialyoutube" class="inline-flex items-center">
                        @csrf
                        <div class="textfield">
                            <input type="text" wire:model.live="social_youtube" placeholder="Compte youtube" class="focus:outline-none">
                        </div>
                        @if($settingGlobal->social_youtube != $social_youtube)
                            <button type="submit" class="btn-icon_secondary ml-2"><i class="fa-solid fa-floppy-disk"></i></button>
                        @endif
                    </form>

                </div>
            </div>
        </div>
        <div class="text-line_input mt-2">
            <div class="flex items-center">
                <div class="flex-1">
                    <h3>Votre Linkedin</h3>
                    <p>Les utilisateurs pourront accèder à votre linkedin directement depuis votre site.</p>
                </div>
                <div class="flex-none">
                    <form wire:submit="updateSociallinkedin" class="inline-flex items-center">
                        @csrf
                        <div class="textfield">
                            <input type="text" wire:model.live="social_linkedin" placeholder="Compte linkedin" class="focus:outline-none">
                        </div>
                        @if($settingGlobal->social_linkedin != $social_linkedin)
                            <button type="submit" class="btn-icon_secondary ml-2"><i class="fa-solid fa-floppy-disk"></i></button>
                        @endif
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
