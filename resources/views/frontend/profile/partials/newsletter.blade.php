@if($user->newsletter == true)
    <div class="alert alert-success fade show"><i class="fa-solid fa-check"></i> Votre etez inscrit a notre newsletter</div>
@else
    <div class="alert alert-warning fade show"><i class="fa-solid fa-triangle-exclamation"></i> Votre n'etez pas inscrit a notre newsletter</div>
@endif
