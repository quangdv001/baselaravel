const BASE_URL = window.location.origin;

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$.noty.defaults = {
    layout: 'bottomRight',
    theme: 'metroui', // or relax
    type: 'information', // success, error, warning, information, notification
    text: '', // [string|html] can be HTML or STRING

    dismissQueue: true, // [boolean] If you want to use queue feature set this true
    force: false, // [boolean] adds notification to the beginning of queue when set to true
    maxVisible: 5, // [integer] you can set max visible notification count for dismissQueue true option,

    template: '<div class="noty_message"><span class="noty_text"></span><div class="noty_close"></div></div>',

    timeout: 3000, // [integer|boolean] delay for closing event in milliseconds. Set false for sticky notifications
    progressBar: false, // [boolean] - displays a progress bar

    animation: {
        open: {height: 'toggle'}, // or Animate.css class names like: 'animated bounceInLeft'
        close: {height: 'toggle'}, // or Animate.css class names like: 'animated bounceOutLeft'
        easing: 'swing',
        speed: 500 // opening & closing animation speed
    },
    closeWith: ['click'], // ['click', 'button', 'hover', 'backdrop'] // backdrop click will close all notifications

    modal: false, // [boolean] if true adds an overlay
    killer: false, // [boolean] if true closes all notifications and shows itself

    callback: {
        onShow: function () {
        },
        afterShow: function () {
        },
        onClose: function () {
        },
        afterClose: function () {
        },
        onCloseClick: function () {
        },
    },

    buttons: false // [boolean|array] an array of buttons, for creating confirmation dialogs.
};

$(document).ready(function () {

    // disable button after click
    // $('.has-spinner').click(function () {
    //     var btn = $(this);
    //     $(btn).buttonLoader('start');
    //     setTimeout(function () {
    //         $(btn).buttonLoader('stop');
    //     }, 3000);
    // });

    //preloader
    // setTimeout(function () {
    //     init.hideLoader();
    // }, 1000);
    
    $('.forms-sample').submit(function () {
        $('.has-spinner').buttonLoader('start');
    });

    // data table
    $('.myTable').DataTable();

    // show alert after redirect
    var success_message = $('.success_message').val();
    var error_message = $('.error_message').val();
    if (success_message) {
        setTimeout(function () {
            init.notyPopup(success_message, 'success');
        }, 1500);
    }
    if (error_message) {
        setTimeout(function () {
            init.notyPopup(error_message, 'error');
        }, 1500);
    }

    //FILE
    $(document).on('click', '.btn-rm-img', function () {
        var li = $(this).parent().parent();
        var id = $(this).data('id');
        var url = BASE_URL + '/admin/file/removeFile/' + id;
        if (confirm('Bạn có chắc muốn xóa file?')) {
            $.post(url, function (res) {
                if (res.success == 1) {
                    li.remove();
                    init.notyPopup('Xóa thành công.', 'success');
                } else {
                    init.notyPopup('Xóa thất bại!', 'error');
                }
            });
        }
    });

    $(document).on('hidden.bs.modal', "#fileModal" , function(){
        $(this).remove();
    });
});

var init = {
    notyPopup: function (text, type) {
        var icon = '';
        if (type === 'success') {
            type = 'information';
            icon = '<i class="fa fas fa-check"></i>';
        }
        if (type === 'error') {
            icon = '<i class="fa fas fa-times"></i>';
        }
        var txt = icon + " " + text;
        var n = noty({
            text: txt,
            type: type // success, error, warning, information, notification
        });
    },
    showLoader: function (obj) {
        $(obj).waitMe({
            effect: 'bounce',
            text: '',
            bg: 'rgba(255,255,255,0.7)',
            color:'#000'
        })

    },
    hideLoader: function (obj) {
        $(obj).waitMe('hide');
    },
    handleFile: function(file){
        var file_data = file[0];
        //lấy ra kiểu file
        var type = file_data.type;
        console.log(type);
        //Xét kiểu file được upload
        var match = ["image/gif", "image/png", "image/jpg", "image/jpeg", "application/x-zip-compressed"];
        //kiểm tra kiểu file
        if (type == match[0] || type == match[1] || type == match[2] || type == match[3] || type == match[4]) {
            //khởi tạo đối tượng form data
            var form_data = new FormData();
            //thêm files vào trong form data
            form_data.append('file', file_data);
            //sử dụng ajax post
            $.ajax({
                url: BASE_URL + '/admin/file/uploadFile', // gửi đến file upload.php 
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function (res) {
                    if (res.success == 1) {
                        $('.list-img').append(res.html);
                        init.notyPopup('Upload thành công.', 'success');
                    } else {
                        init.notyPopup('Upload thất bại!', 'error');
                    }
                }
            });
        } else {
            init.notyPopup('Sai định dạng file!', 'error');
        }
        return false;
    },
    openFileModal: function(callback, multi = false){
        var url = BASE_URL + '/admin/file/openFileModal';
        $.get(url, function(res){
            if(res.success == 1){
                $('body').append(res.html);
                $("#fileModal").modal();
                var data = {};
                $(document).off('click', '.img-item').on('click', '.img-item', function(){
                    if(multi == false){
                        $('.img-item').removeClass('active');
                        $(this).addClass('active');
                        
                        data.url = $(this).data('url');
                        data.id = $(this).data('id');
                        data.path = $(this).data('path');
                    } else {
                        if($(this).hasClass('active')){
                            $(this).removeClass('active');
                        } else {
                            $(this).addClass('active');
                        }
                        data = [];
                        $(".img-item").each(function(){
                            if($(this).hasClass('active')){
                                data.push($(this).data('url'));
                            }
                        });
                    }
                })
                
                $(document).off('click', '.btn-choose-file').on('click', '.btn-choose-file', function(){
                    callback(data);
                    $("#fileModal").modal("hide");
                });
            } else {
                init.notyPopup('Có lỗi xảy ra!', 'error');
            }
        });
    },
    makeSlug: function(title){
        var slug;
 
        //Đổi chữ hoa thành chữ thường
        slug = title.toLowerCase();
    
        //Đổi ký tự có dấu thành không dấu
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
        //Xóa các ký tự đặt biệt
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        //Đổi khoảng trắng thành ký tự gạch ngang
        slug = slug.replace(/ /gi, "-");
        //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
        //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');
        //Xóa các ký tự gạch ngang ở đầu và cuối
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
        return slug;
    },
};