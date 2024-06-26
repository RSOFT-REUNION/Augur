@extends('layouts.backend')

@section('content-template')
    <main role="main" id="backend_content">
        <form method="POST">
            @csrf
            <div class="entry-header flex items-center">
                <div class="flex-1">
                    <h1>Page "Accueil"</h1>
                </div>
                <div class="flex-none inline-flex items-center">
                    <button type="submit" class="btn-filled_secondary"><i class="fa-solid fa-floppy-disk mr-3"></i>Sauvegarder</button>
                </div>
            </div>
            <div class="entry-content">
                <h2>Section "Qui sommes-nous ?"</h2>
                <textarea name="page_content" class="tiny">@if($page) {{ $page->content }} @endif</textarea>
            </div>
        </form>
    </main>
@endsection
