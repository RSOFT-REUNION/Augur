<div>
    @if(Session::has('success'))
        <div class="popup-alert">
            <div class="bg-green-100 text-green-800 px-4 py-2">
                <p><i class="fa-solid fa-circle-check mr-3"></i>{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if(Session::has('error'))
        <div class="popup-alert">
            <div class="bg-red-100 text-red-800 px-4 py-2">
                <p><i class="fa-solid fa-triangle-exclamation mr-3"></i>{{ session('error') }}</p>
            </div>
        </div>
    @endif

    <script>
        var popupElement = document.querySelector('.popup-alert')
        var delai = 5000;
        function masquerPopup() {
            popupElement.style.display = 'none';
        }
        setTimeout(masquerPopup, delai);
    </script>
</div>


