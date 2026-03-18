;(function($){
    "use strict";
    var url = theme_data.url,
        code = theme_data.code,
        domain  = theme_data.domain;
        
    $('#deactivate').on('click', async function(e){
        e.preventDefault();
        $.ajax({
            method:'POST',
            url:url,
            data:{
                code:code,
                domain:domain
            },
            beforeSend:function(){
                $('#deactivate').text('Deactivatig...').attr('disabled', 'disabled');
            },
            success:function(res){
                if(res.code == 'tp_api_success' && res.status == 'deactivated'){
                    $('#deactivate').closest('wrap').append(`<div class="notice notice-success"><p>${res.message}</p></div>`);
                    ajax_post(theme_data.ajax_url, {
                        action:'deactivate_theme',
                        security:theme_data.nonce
                    });
                }
                if(res.code == 'tp_api_error' && res.status == 'not_found'){
                    $('#deactivate').closest('wrap').append(`<div class="notice notice-error"><p>${res.message}</p></div>`);
                    setTimeout(() => {
                        window.location.href = theme_data.admin_url;
                    }, 500);
                }
                
            },
            complete:function(){
                $('#deactivate').text('Deactivated').removeAttr('disabled');
            }
        });
    });
    

    var ajax_post = async function(url, data){
        try{
            const response = await $.ajax({
                method:'POST',
                url:url,
                data:data
            });

            if(response.success){
                setTimeout(() => {
                    window.location.href = theme_data.admin_url;
                }, 500);
            }
        }catch(err){
            console.log(err);
        }
    }

})(jQuery)