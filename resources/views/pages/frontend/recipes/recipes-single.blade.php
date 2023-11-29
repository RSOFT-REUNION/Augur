@extends('layouts.frontend')

@section('content-template')
    <main role="main" class="container mx-auto">
        <div class="">
            <button type="button" onclick="window.location.href='{{ route('fo.recipes') }}'" class="btn-filled_secondary"><i class="fa-solid fa-arrow-left mr-3"></i>Retourner à la liste</button>
        </div>
        <div class="text-center">
            <h1>{{ $recipe->title }}</h1>
            <div class="mt-5 flex justify-center">
                <img src="{{ asset('storage/medias/'. $recipe->getPicture()) }}" class="rounded-lg">
            </div>
            @if($recipe->description != null)
                <p class="mt-5">{{ $recipe->description }}</p>
            @endif
        </div>
        <div class="my-10 flex flex-col lg:flex-row border-t border-gray-100 pt-10">
            <div class="flex-none lg:w-[300px] xl:w-[400px] lg:mr-5">
                <h2>Les ingrédients pour {{ $recipe->recipe_for }} personnes</h2>
                <div class="mt-3 bg-gray-100 rounded-lg px-6 py-2 font-medium">
                    <ul>
                        @foreach($ingredients as $ingredient)
                            <li class="my-3">{{ $ingredient->title }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="flex-1 mt-10 lg:mt-0 lg:ml-5">
                <h2>Préparation</h2>
                <ul>
                    @foreach($steps as $step)
                        <li class="my-3">
                            <div class="flex items-center">
                                <div class="flex-none mr-4">
                                    <h4 class="text-2xl">{{ $step->step }}</h4>
                                </div>
                                <div class="flex-1 ml-4 bg-gray-100 border-l-2 border-primary">
                                    <div class="px-3 py-2">
                                        <p>{{ $step->content }}</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </main>
@endsection
