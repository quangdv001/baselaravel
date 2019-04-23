<script src="{{ asset('assets/admin/themes/vendors/js/vendor.bundle.base.js') }}"></script>
<script src="{{ asset('assets/admin/themes/vendors/js/vendor.bundle.addons.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="{{ asset('assets/admin/themes/js/off-canvas.js') }}"></script>
<script src="{{ asset('assets/admin/themes/js/misc.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/notyv2/jquery.noty.packaged.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/buttonloader/jquery.buttonLoader.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/preloader/jquery.preloader.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/waitme/waitMe.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/nestable/jquery.nestable.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/selectize/selectize.js') }}"></script>
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/eonasdan-bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script src="{{ asset('assets/admin/plugins/ckeditor/ckeditor.js') }}"></script>
<script> CKEDITOR.replace('editor1', {
        filebrowserBrowseUrl: '{{ asset('assets/admin/plugins/ckfinder/ckfinder.html') }}',
        filebrowserImageBrowseUrl: '{{ asset('assets/admin/plugins/ckfinder/ckfinder.html?type=Images') }}',
        filebrowserFlashBrowseUrl: '{{ asset('assets/admin/plugins/ckfinder/ckfinder.html?type=Flash') }}',
        filebrowserUploadUrl: '{{ asset('assets/admin/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
        filebrowserImageUploadUrl: '{{ asset('assets/admin/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
        filebrowserFlashUploadUrl: '{{ asset('assets/admin/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
    });
    CKEDITOR.replace('editor2', {
        filebrowserBrowseUrl: '{{ asset('assets/admin/plugins/ckfinder/ckfinder.html') }}',
        filebrowserImageBrowseUrl: '{{ asset('assets/admin/plugins/ckfinder/ckfinder.html?type=Images') }}',
        filebrowserFlashBrowseUrl: '{{ asset('assets/admin/plugins/ckfinder/ckfinder.html?type=Flash') }}',
        filebrowserUploadUrl: '{{ asset('assets/admin/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
        filebrowserImageUploadUrl: '{{ asset('assets/admin/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
        filebrowserFlashUploadUrl: '{{ asset('assets/admin/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
    }); 
    </script>
@yield('lib_js')
<script src="{{ asset('assets/admin/js/init.js') }}"></script>
<script src="{{ asset('js/admin.js') }}"></script>
@yield('custom_js')