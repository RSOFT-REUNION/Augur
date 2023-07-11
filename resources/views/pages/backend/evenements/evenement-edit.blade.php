@extends('layouts.backend')

@section('content-template')
    <main role="main" id="backend_content">
        <form method="POST" action="{{ route('bo.evenements.edit.post', ['id' => $evenement->id]) }}">
            @csrf
            <div class="entry-header flex items-center">
                <div class="flex-1 inline-flex items-center">
                    <a href="{{ route('bo.evenements') }}" class="btn-icon_secondary mr-2"><i class="fa-solid fa-arrow-left"></i></a>
                    <h1>{{ $evenement->title }}</h1>
                </div>
                <div class="flex-none inline-flex items-center">
                    <button type="submit" class="btn-filled_secondary"><i class="fa-solid fa-floppy-disk mr-3"></i>Sauvegarder</button>
                </div>
            </div>
            <div class="entry-content">
                <div class="textfield">
                    <label for="title">Nom de l'évènement<span class="text-red-500">*</span></label>
                    <input type="text" id="title" wire:model="title" name="title" placeholder="Entrez le nom de l'évènement" class="@if($errors->has('title'))textfield-error @endif" value="{{ $evenement->title }}">
                    @if($errors->has('title'))
                        <p class="text-input-error">{{ $errors->first('title') }}</p>
                    @endif
                </div>
                <div class="textfield mt-2">
                    <label for="description">Description courte de l'évènement<span class="text-red-500">*</span></label>
                    <textarea name="description" id="description" placeholder="Entrez une description courte">{{ $evenement->description_short }}</textarea>
                    @if($errors->has('title'))
                        <p class="text-input-error">{{ $errors->first('title') }}</p>
                    @endif
                </div>
                @if($evenement->one_day != 0)
                <div class="flex mt-2">
                    <div class="flex-1 mr-2">
                        <div class="textfield">
                            <label for="start_date">Date de début<span class="text-red-500">*</span></label>
                            <input type="date" id="start_date" wire:model="start_date" name="start_date" class="@if($errors->has('start_date'))textfield-error @endif" value="{{ $evenement->start_date }}">
                            @if($errors->has('start_date'))
                                <p class="text-input-error">{{ $errors->first('start_date') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="flex-1 ml-2">
                        <div class="textfield">
                            <label for="end_date">Date de fin<span class="text-red-500">*</span></label>
                            <input type="date" id="end_date" wire:model="end_date" name="end_date" class="@if($errors->has('end_date'))textfield-error @endif" value="{{ $evenement->end_date }}">
                            @if($errors->has('end_date'))
                                <p class="text-input-error">{{ $errors->first('end_date') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                @else
                    <div class="textfield">
                        <label for="date">Date de l'évènement<span class="text-red-500">*</span></label>
                        <input type="date" id="date" wire:model="date" name="date" class="@if($errors->has('date'))textfield-error @endif" value="{{ $evenement->date }}">
                        @if($errors->has('date'))
                            <p class="text-input-error">{{ $errors->first('date') }}</p>
                        @endif
                    </div>
                @endif
                <div class="flex mt-2">
                    <div class="flex-1 mr-2">
                        <div class="textfield">
                            <label for="start_time">Heure de début<span class="text-red-500">*</span></label>
                            <input type="time" id="start_time" wire:model="start_time" name="start_time" class="@if($errors->has('start_time'))textfield-error @endif" value="{{ $evenement->start_time }}">
                            @if($errors->has('start_time'))
                                <p class="text-input-error">{{ $errors->first('start_time') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="flex-1 ml-2">
                        <div class="textfield">
                            <label for="end_time">Heure de fin<span class="text-red-500">*</span></label>
                            <input type="time" id="end_time" wire:model="end_time" name="end_time" class="@if($errors->has('end_time'))textfield-error @endif" value="{{ $evenement->end_time }}">
                            @if($errors->has('end_time'))
                                <p class="text-input-error">{{ $errors->first('end_time') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="textfield mt-2">
                    <label for="page_content">Contenue de la page</label>
                    <textarea name="page_content" id="page_content" class="tiny">{{ $evenement->page_content }}</textarea>
                </div>
            </div>
        </form>
    </main>
@endsection
