@extends('layouts.app')

@section('content-app')
    <div id="backend_page">
        <div class="flex">
            <div class="flex-none">
                @include('components.templates.back-sidebar')
            </div>
            <div class="grow">
                @yield('content-template')
            </div>
        </div>
    </div>
@endsection
