@extends('layouts.frontend')

@section('content-template')
    <main role="main">
        <div class="container mx-auto my-10">
            <div class="tiny-content">
                {!! $settingGlobal->conditions !!}
            </div>
        </div>
    </main>
@endsection
