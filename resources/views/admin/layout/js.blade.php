<script src="{{ asset('assets/admin/themes/vendors/js/vendor.bundle.base.js') }}"></script>
<script src="{{ asset('assets/admin/themes/vendors/js/vendor.bundle.addons.js') }}"></script>
<script src="{{ asset('assets/admin/themes/js/off-canvas.js') }}"></script>
<script src="{{ asset('assets/admin/themes/js/misc.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/notyv2/jquery.noty.packaged.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/buttonloader/jquery.buttonLoader.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/preloader/jquery.preloader.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/waitme/waitMe.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/nestable/jquery.nestable.js') }}"></script>
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script> CKEDITOR.replace('editor1', {
        filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
        filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
        filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
        filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
        filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
        filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
    });
    CKEDITOR.replace('editor2', {
        filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
        filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
        filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
        filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
        filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
        filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
    }); 
    </script>
@yield('lib_js')
<script src="{{ asset('assets/admin/js/init.js') }}"></script>
<script src="{{ asset('js/admin.js') }}"></script>
<script src="{{ asset('js/selectize.js') }}"></script>

@yield('custom_js')