@extends('layouts.backend')

@section('content-template')
    <main role="main" id="backend_content">
        <div class="entry-header flex items-center">
            <div class="flex-1">
                <h1>À propos</h1>
            </div>
            <div class="flex-none">
                <p class="bg-blue-900 text-white px-4 py-2 rounded-lg">Version actuel - {{ Config::get('augur.app_version') }}</p>
            </div>
        </div>
        <div class="entry-content">
            <p class="empty-text">Cette fonctionnalité est a venir !</p>
        </div>
    </main>
@endsection
