$('.hum_btn').on('click',function(){
    $('.hum_wrap').hide().fadeIn();
    $('.hum_btn').hide();
    $('.hum_close').show();
});

$('.hum_close').on('click',function(){
    $('.hum_wrap').fadeOut();
    $('.hum_btn').show();
    $('.hum_close').hide();
})
