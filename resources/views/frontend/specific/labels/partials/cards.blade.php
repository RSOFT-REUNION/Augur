<div class="row row-flex">
    @foreach($labels as $label)
        <div class="col-12 col-md-3 mb-5 hvr-grow">
            <div class="card content text-center">
                <a href="{{ route('labels.show', ['slug' => $label->getSlug(), 'label' => $label]) }}">
                <div class="card-body align-items-center" style="background-color: #f6f6f6;">
                    <img style="max-height: 300px; width: auto; max-width: 100%;" src="{{ getImageUrl('/upload/specific/labels/'.$label->image, 300, 300, 'fill-max') }}" class="card-img-top mb-3 p-3 mx-auto d-block" alt="{{ $label->image }}">
                    <h4 class="card-title mb-3 text-black">{{ $label->name }}</h4>
                    <p class="card-text"><a href="{{ route('labels.show', ['slug' => $label->getSlug(), 'label' => $label]) }}" class="btn btn-primary">En savoir plus</a></p>
                </div>
                </a>
            </div>
        </div>
    @endforeach
</div>
