jQuery(function($){
    $('#upload-file').on('click', function(e){
        e.preventDefault();
        console.log('here');
        $('#file-img')[0].click();
    });
});