<div id="popup-search">
    <div class="entry-header">
        <form>
            @csrf
            <div class="textfield-front-search">
                <label for=""><i class="fa-solid fa-magnifying-glass"></i></label>
                <input type="text" wire:model="search" placeholder="Rechercher un produit, un label, une animation.." class="focus:outline-none">
            </div>
        </form>
    </div>
    <div class="entry-content">
        @if(count($this->jobsLabel) > 0)
            <div class="mb-5">
                <h2>Les labels</h2>
                <div class="mt-4 grid grid-cols-4 gap-4">
                    @foreach($jobsLabel as $label)
                        <div class="small-label" role="button" data-href="{{ route('fo.label', ['slug' => $label->slug]) }}">
                            <div class="flex flex-col h-full">
                                <div class="flex-1 flex h-full">
                                    <div class="m-auto">
                                        <img src="{{ asset('storage/images/labels/'. $label->logo) }}"/>
                                    </div>
                                </div>
                                <div class="flex-none">
                                    <h3>{{ $label->title }}</h3>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        @if(count($this->jobsEvenement) > 0)
            <div>
                <h2>Les animations</h2>
                <div class="mt-4">
                    <ul>
                        @foreach($jobsEvenement as $evenement)
                            <li class="small-evenement">
                                <div class="flex items-center" role="button" data-href="{{ route('fo.evenements') }}">
                                    <div class="flex-none">
                                        <img src="{{ asset('storage/images/evenements/'. $evenement->cover) }}"/>
                                    </div>
                                    <div class="flex-1">
                                        <p>{{ $evenement->title }}</p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
    </div>
</div>
