$(document).ready(function(){
    $('.comment-respond').addClass('form-group');

    $('.comment-respond input').addClass('form-control');

    $('.comment-respond input').each(function(){
        if($(this).attr('type') === "checkbox"){
            $(this).removeClass('form-control').addClass('form-check-input');
        }
    });
    $('label').each(function(){
        if($(this).attr('for') === 'email'){
            $(this).html('Email<span class="required">*</span> <strong>(Your email address will not be published.)</strong> ');
        }
    })
    //$('label').attr('for') === "email"
    $('.comment-respond textarea').addClass('form-control');
})