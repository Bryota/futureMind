$('.range').on('input',function(e){
   $(this).next('.range_value').html($(this).val())
})