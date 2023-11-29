@if($message = \Illuminate\Support\Facades\Session::get('error'))
    <div class="flash_message flash-success">
        <p><i class="fa-solid fa-circle-check mr-3"></i>{{ $message }}</p>
    </div>
@endif

@if($message = \Illuminate\Support\Facades\Session::get('error'))
    <div class="flash_message flash-error">
        <p><i class="fa-solid fa-circle-exclamation mr-3"></i>{{ $message }}</p>
    </div>
@endif

@if($message = \Illuminate\Support\Facades\Session::get('info'))
    <div class="flash_message flash-info">
        <p><i class="fa-solid fa-circle-info mr-3"></i>{{ $message }}</p>
    </div>
@endif
