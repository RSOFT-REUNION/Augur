@extends('layouts.backend')

@section('content-template')
    <main role="main" id="backend_content">
        <form method="POST" enctype="multipart/form-data">
            @csrf
            <div class="entry-header flex items-center">
                <div class="flex-1">
                    <h1>Conditions générales d'utilisation</h1>
                </div>
                <div class="flex-none inline-flex items-center">
                    <button type="submit" class="btn-filled_secondary"><i class="fa-solid fa-floppy-disk mr-3"></i>Sauvegarder</button>
                </div>
            </div>
            <div class="entry-content">
                <textarea name="conditions" class="tiny">{{ $setting->conditions }}</textarea>
            </div>
        </form>
    </main>
@endsection
