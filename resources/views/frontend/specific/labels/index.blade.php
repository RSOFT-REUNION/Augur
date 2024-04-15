@extends('frontend.layouts.layout')

@section('title', 'Liste de nos labels')

@section('main-content')

    <h1 style="text-align: center;">Nos labels</h1>
    <h4 style="text-align: center;" class="mb-5">Des labels certifiés</h4>

    <div class="row row-flex">
        @foreach($labels as $label)
            <div class="col-12 col-md-3 mb-3">
                <div class="card content text-center">
                    <div class="card-body d-flex align-items-center">
                        <img style="max-height: 200px; width: auto; max-width: 100%;" src="/storage/upload/specific/labels/{{ $label->image }}" class="card-img-top mb-3 p-3 mx-auto d-block" alt="{{ $label->image }}">
                    </div>
                    <div class="card-footer text-muted">
                        <h5 class="card-title mb-3">{{ $label->name }}</h5>
                        <p class="card-text"><a href="{{ route('labels.show', ['slug' => $label->getSlug(), 'label' => $label]) }}" class="btn btn-primary">En savoir plus</a></p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="pagination justify-content-center">
        {{ $labels->links() }}
    </div>

@endsection
