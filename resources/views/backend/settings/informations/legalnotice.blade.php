@extends('backend.layouts.layout')
@section('title', __('Mentions légales') )

@section('main-content')

    <div class="row m-2">
        <div class="col">
            <div class="card border-left-primary shadow mb-4">

                <form action="{{ route('backend.settings.legalnotice.update') }}" method="post"
                      class="mt-6 space-y-6">
                    @csrf

                    <div class="card-body">
                        <div class="form-group">
                            <textarea id="legalnotice" name="legalnotice" class="@error('content') is-invalid @enderror form-control summernote" aria-label="With textarea">{{ $infos->legalnotice }}</textarea>
                            @error('legalnotice')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2 justify-content-center mt-3">
                            <button type="submit" class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i>
                                Modifier
                            </button>&nbsp;&nbsp;
                        </div>

                    </div>

                </form>

            </div>
        </div>
    </div>

@endsection
