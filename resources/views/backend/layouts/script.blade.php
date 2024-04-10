<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('backend/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('backend/vendor/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('backend/vendor/tom-select/tom-select.complete.min.js') }}"></script>
<script src="{{ asset('backend/vendor/summernote/summernote.min.js') }}"></script>
<script src="{{ asset('backend/vendor/summernote/lang/summernote-fr-FR.min.js') }}"></script>
<script src="{{ asset('backend/js/custom.js') }}"></script>

<script>
    $(document).ready(function () {
        $('.summernote').summernote({
            lang: 'fr-FR',
            height: 450,
            callbacks:{
                onImageUpload:function(file){
                    $('.summernote').summernote('disable')
                    const frmData = new FormData();
                    frmData.append('_token',"@php echo csrf_token(); @endphp")
                    frmData.append('image',file[0]);
                    $.ajax({
                        url:'/',
                        method:'POST',
                        contentType:false,
                        processData:false,
                        data:frmData,
                        success:function(data){
                            $('.summernote').summernote('insertImage',data)
                            $('.summernote').summernote('enable')
                        }
                    })
                },
            }
        });
    });
</script>
