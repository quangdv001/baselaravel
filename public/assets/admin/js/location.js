$(document).ready(function(){
    var selectProvince = $('.province').val();
    var selectDistrict = $('.district').val();
    var selectWard = $('.ward').val();
    console.log(selectProvince, selectDistrict, selectWard);
    province.loadProvince(selectProvince);
    if(selectProvince != ''){
        province.loadDistrict(selectProvince, selectDistrict);
        if(selectDistrict != ''){
            province.loadWard(selectDistrict, selectWard);
        }
    }
    $('.province_id').change(function(){
        var province_id = $(this).val();
        province.loadDistrict(province_id, selectDistrict);
    });
    $('.district_id').change(function(){
        var district_id = $(this).val();
        province.loadWard(district_id, selectWard);
    });
});

var province = {
    preload: function(){
        var html = '<option></option>';
        return html;
    },
    loadProvince: function(selectProvince){
        var url = BASE_URL + '/admin/province/loadProvince/' + selectProvince;
        $('.province_id').html(this.preload);
        $.get(url, function(res){
            if(res.success == 1){
                $('.province_id').append(res.html);
            } else {
                init.notyPopup(res.mess,'error');
            }
        });
    },
    loadDistrict: function(province_id, selectDistrict){
        var url = BASE_URL + '/admin/province/loadDistrict/' + province_id + '/' + selectDistrict;
        $('.district_id').html(this.preload);
        $.get(url, function(res){
            if(res.success == 1){
                $('.district_id').append(res.html);
            } else {
                init.notyPopup(res.mess,'error');
            }
        });
    },
    loadWard: function(district_id, selectWard){
        var url = BASE_URL + '/admin/province/loadWard/' + district_id + '/' + selectWard;
        $('.ward_id').html(this.preload);
        $.get(url, function(res){
            if(res.success == 1){
                $('.ward_id').append(res.html);
            } else {
                init.notyPopup(res.mess,'error');
            }
        });
    },
}