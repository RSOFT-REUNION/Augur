@extends('layouts.frontend')

@section('content-template')
    <main role="main">
        <div class="container mx-auto">
            <div class="text-center">
                <h1>AÜGUR</h1>
                <h3>Une démarche engagée</h3>
            </div>
            <div class="tiny-content my-20">
                {!! $page->content !!}
            </div>
        </div>
    </main>
@endsection
