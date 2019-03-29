<script src="{{ asset('assets/admin/themes/vendors/js/vendor.bundle.base.js') }}"></script>
<script src="{{ asset('assets/admin/themes/vendors/js/vendor.bundle.addons.js') }}"></script>
<script src="{{ asset('assets/admin/themes/js/off-canvas.js') }}"></script>
<script src="{{ asset('assets/admin/themes/js/misc.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/notyv2/jquery.noty.packaged.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/buttonloader/jquery.buttonLoader.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/preloader/jquery.preloader.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/waitme/waitMe.min.js') }}"></script>

<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
@yield('lib_js')
<script src="{{ asset('assets/admin/js/init.js') }}"></script>
{{-- <script src="{{ asset('js/admin.js') }}"></script> --}}

@yield('custom_js')