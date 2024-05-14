<div class="row row-flex">
    @foreach($labels as $label)
        <div class="col-12 col-md-3 mb-5 hvr-grow">
            <div class="card content text-center">
                <div class="card-body align-items-center" style="background-color: #f6f6f6;">
                    <img style="max-height: 300px; width: auto; max-width: 100%;" src="/storage/upload/specific/labels/{{ $label->image }}" class="card-img-top mb-3 p-3 mx-auto d-block" alt="{{ $label->image }}">
                    <h3 class="card-title mb-3">{{ $label->name }}</h3>
                    <p class="card-text"><a href="{{ route('labels.show', ['slug' => $label->getSlug(), 'label' => $label]) }}" class="btn btn-primary">En savoir plus</a></p>
                </div>
            </div>
        </div>
    @endforeach
</div>
