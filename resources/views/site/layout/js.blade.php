<script src="{{ asset('public/assets/site/themes/assets/libs/jquery/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('public/assets/site/themes/assets/libs/popper/umd/popper.js') }}"></script>
<script src="{{ asset('public/assets/site/themes/assets/libs/bootstrap-material/js/bootstrap-material-design.min.js') }}"></script>
<script src="{{ asset('public/assets/site/themes/assets/libs/owlcarousel2/owl.carousel.min.js') }}"></script>
<script src="{{ asset('public/assets/site/themes/assets/libs/slimScroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/assets/admin/plugins/notyv2/jquery.noty.packaged.js') }}"></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js"> </script>
<script src="{{ asset('public/assets/admin/plugins/buttonloader/jquery.buttonLoader.min.js') }}"></script>
<script src="{{ asset('public/assets/admin/plugins/waitme/waitMe.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<script src="{{ asset('public/assets/site/themes/js/main.js') }}"></script>
<script>
    var groups = {};
            $('.galleryItem').each(function() {
            var id = parseInt($(this).attr('data-group'), 10);

            if(!groups[id]) {
                groups[id] = [];
            } 
            
            groups[id].push( this );
            });
            console.log(groups);
    
            $.each(groups, function() {
            
                $(this).magnificPopup({
                    type: 'image',
                    closeOnContentClick: true,
                    closeBtnInside: false,
                    gallery: { enabled:true }
                })
            
            });
</script>
@yield('lib_js')
<script src="{{ asset('public/assets/site/js/init.js') }}"></script>
@yield('custom_js')