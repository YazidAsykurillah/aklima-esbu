jQuery(document).ready(function($) {

	$.ajax({
        method: 'GET',
        url: '/permohonan/counter',
        dataType: 'json',
        beforeSend:function(){
            
        },
        success: function(response){
            console.log(response);
            let permohonan_0_count  = '('+response.permohonan_0_count+')';
            let permohonan_1_count  = '('+response.permohonan_1_count+')';
            let permohonan_4_count  = '('+response.permohonan_4_count+')';
            let permohonan_5_count  = '('+response.permohonan_5_count+')';
            let permohonan_7_count  = '('+response.permohonan_7_count+')';
            
            $('#permohonan_0_count').html(permohonan_0_count);
            $('#permohonan_1_count').html(permohonan_1_count);
            $('#permohonan_4_count').html(permohonan_4_count);
            $('#permohonan_5_count').html(permohonan_5_count);
            $('#permohonan_7_count').html(permohonan_7_count);
            
        },
        error: function(jqXHR, textStatus, errorThrown){
            let objResponse = jqXHR.responseJSON;
            console.log(objResponse);
        }
    });

    $.ajax({
        method: 'GET',
        url: '/home/identitas-provinsi',
        dataType: 'json',
        beforeSend:function(){
            
        },
        success: function(response){
            console.log(response);
            $('#identitas-provinsi').html(response.nama_provinsi);
            
        },
        error: function(jqXHR, textStatus, errorThrown){
            let objResponse = jqXHR.responseJSON;
            console.log(objResponse);
        }
    });
});