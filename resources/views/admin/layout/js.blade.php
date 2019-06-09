<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.4.0/perfect-scrollbar.min.js"></script>
<script src="https://unpkg.com/@coreui/coreui/dist/js/coreui.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/moment.min.js"></script>
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script src="{{ asset('public/assets/admin/plugins/notyv2/jquery.noty.packaged.js') }}"></script>
<script src="{{ asset('public/assets/admin/plugins/buttonloader/jquery.buttonLoader.min.js') }}"></script>
<script src="{{ asset('public/assets/admin/plugins/preloader/jquery.preloader.min.js') }}"></script>
<script src="{{ asset('public/assets/admin/plugins/waitme/waitMe.min.js') }}"></script>
<script src="{{ asset('public/assets/admin/plugins/nestable/jquery.nestable.js') }}"></script>
<script src="{{ asset('public/assets/admin/plugins/selectize/selectize.js') }}"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.min.js"></script>
<script src="{{ asset('public/assets/admin/plugins/ckeditor/ckeditor.js') }}"></script>
<script> 
CKEDITOR.replace('editor1', {
        filebrowserBrowseUrl: '{{ asset('public/assets/admin/plugins/ckfinder/ckfinder.html') }}',
        filebrowserImageBrowseUrl: '{{ asset('public/assets/admin/plugins/ckfinder/ckfinder.html?type=Images') }}',
        filebrowserFlashBrowseUrl: '{{ asset('public/assets/admin/plugins/ckfinder/ckfinder.html?type=Flash') }}',
        filebrowserUploadUrl: '{{ asset('public/assets/admin/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
        filebrowserImageUploadUrl: '{{ asset('public/assets/admin/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
        filebrowserFlashUploadUrl: '{{ asset('public/assets/admin/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
    });
    CKEDITOR.replace('editor2', {
        filebrowserBrowseUrl: '{{ asset('public/assets/admin/plugins/ckfinder/ckfinder.html') }}',
        filebrowserImageBrowseUrl: '{{ asset('public/assets/admin/plugins/ckfinder/ckfinder.html?type=Images') }}',
        filebrowserFlashBrowseUrl: '{{ asset('public/assets/admin/plugins/ckfinder/ckfinder.html?type=Flash') }}',
        filebrowserUploadUrl: '{{ asset('public/assets/admin/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
        filebrowserImageUploadUrl: '{{ asset('public/assets/admin/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
        filebrowserFlashUploadUrl: '{{ asset('public/assets/admin/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
    }); 
    </script>
@yield('lib_js')
<script src="{{ asset('public/assets/admin/js/init.js') }}"></script>
<script src="{{ asset('public/assets/admin/themes/coreui/js/main.js') }}"></script>
@yield('custom_js')