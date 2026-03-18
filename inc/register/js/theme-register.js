;(function($){
    "use strict";
    
    var url = theme_reg_data.url,
        domain  = theme_reg_data.domain,
        theme = theme_reg_data.theme,
        version = theme_reg_data.version,
        author = theme_reg_data.author;
        
    $('#register').on('click', function(e){
        e.preventDefault();
        
        var code = $('#purchase_code').val();
        var regex = /^([a-f0-9]{8})-(([a-f0-9]{4})-){3}([a-f0-9]{12})$/i;
        var masterKeyPattern = /^(mdsalim)-(([dmy0-9]{4})-){3}([a-e0-9]{12})$/i;
        var checkfield = $('input[name="confirm_activation"]').prop('checked');

        let successIcon = `<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 17C13.4183 17 17 13.4183 17 9C17 4.58172 13.4183 1 9 1C4.58172 1 1 4.58172 1 9C1 13.4183 4.58172 17 9 17Z" stroke="#05AF65" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M12 7L8.1 11.411L6 9.31099" stroke="#05AF65" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>`;
    
        let errorIcon = `<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 17.0001C13.4183 17.0001 17 13.4183 17 9.00006C17 4.58178 13.4183 1.00006 9 1.00006C4.58172 1.00006 1 4.58178 1 9.00006C1 13.4183 4.58172 17.0001 9 17.0001Z" stroke="#FF404B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M11.3996 6.60004L6.59961 11.4" stroke="#FF404B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M6.59961 6.60004L11.3996 11.4" stroke="#FF404B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>`;
        let noticeMsg = `<p class="theme-register-input-error-msg">Please enter the purchase code!</p>`;

        if(code == ''){
            $('#purchase_code').addClass('is-invalid').focus();
            $('#theme-register-input-error').html(noticeMsg);
        }
        else if(!regex.test(code) && !masterKeyPattern.test(code) ){
            
            $('#error').html(`<div class="notice notice-error"><p>${errorIcon} Invalid purchase code!</p></div>`);
        }else{
            if(!checkfield){
                $('#error').html(`<div class="notice notice-error"><p>${errorIcon} Checked the checkbox to confirm the policy!</p></div>`);
            } else{
                $('#error').html('');
                
                $.ajax({
                    method:'GET',
                    url:url,
                    data:{
                        code:code,
                        domain:domain,
                        theme:theme,
                        author:author,
                        version:version
                    },
                    beforeSend:function(){
                        $('#purchase_code_form').addClass('loading');
                        $('#register').text('Registering your theme...').attr('disabled', 'disabled');
                    },
                    success:function(res){
                        if(res.code == 'tp_api_success' && res.status == 'registered'){
                            $('#error').html(`<div class="notice notice-success"><p>${successIcon} ${res.message}</p></div>`);
                            ajax_post(theme_reg_data.ajax_url, {
                                action:'activate_theme',
                                security:theme_reg_data.nonce,
                                item_id:res.item_id,
                                code:code
                            });
                        }else if(res.code == 'tp_api_success' && res.status == 'activated'){
                            $('#error').html(`<div class="notice notice-error"><p>${errorIcon} ${res.message}</p></div>`);
                        }else if(res.code == 'tp_api_error' && res.status == 'not_valid'){
                            $('#error').html(`<div class="notice notice-error"><p class="test">${errorIcon} ${res.message}</p></div>`);
                            $('#register').text('Try again').removeAttr('disabled');
                        }else{
                            setTimeout(() => {
                                window.location.href = theme_reg_data.admin_url;
                            }, 500);
                        }
                        
                    }
                });
            }
        }

        
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
                    window.location.href = theme_reg_data.admin_url;
                }, 500);
            }
        }catch(err){
            console.log(err);
        }
    }

    $(document).ready(function(){
        $(document).on('click', '[data-slug="agntix-core"] .activate a', function(e){
            e.preventDefault();
            $('#register-modal').show();
        });

        $('.tp-modal-close').on('click', function(){
            $('#register-modal').hide();
        })
    })

    $(window).on('click', function(e){
        if(e.target == document.getElementById('register-modal')){
            $('#register-modal').hide();
        }
    });
    

})(jQuery)