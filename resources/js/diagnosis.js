$('.diagnosis_future_btn').on('click',function(){
    $(this).closest('.question_wrap').removeClass('show')
    $(this).closest('.question_wrap').addClass('hidden')
    id = $(this).attr("href")
    $(id).addClass('show')
    $(id).removeClass('hidden')
})

let  developmentvalue= 0;
let  socialvalue= 0;
let  stablevalue= 0;
let  teammatevalue= 0;
let  futurevalue= 0;
$('.diagnosis_future_btn').each(function(){
    $(this).on('click',function(){
        if($(this).data('developmentvalue') !== undefined){
            let development = $(this).data('developmentvalue')
            developmentvalue = developmentvalue + development
            $('#developmentvalue').val(developmentvalue)
        }
        if($(this).data('socialvalue') !== undefined){
            let social = $(this).data('socialvalue')
            socialvalue = socialvalue + social
            $('#socialvalue').val(socialvalue)
        }
        if($(this).data('stablevalue') !== undefined){
            let stable = $(this).data('stablevalue')
            stablevalue = stablevalue + stable
            $('#stablevalue').val(stablevalue)
        }
        if($(this).data('teammatevalue') !== undefined){
            let teammate = $(this).data('teammatevalue')
            teammatevalue = teammatevalue + teammate
            $('#teammatevalue').val(teammatevalue)
        }
        if($(this).data('futurevalue') !== undefined){
            let future = $(this).data('futurevalue')
            futurevalue = futurevalue + future
            $('#futurevalue').val(futurevalue)
        }
    })
})

$('.diagnosis_self_btn').on('click',function(){
    $(this).closest('.question_wrap').removeClass('show')
    $(this).closest('.question_wrap').addClass('hidden')
    id = $(this).attr("href")
    $(id).addClass('show')
    $(id).removeClass('hidden')
})

$('.diagnosis_self_btn').each(function(){
    $(this).on('click',function(){
        if($(this).data('developmentvalue') !== undefined){
            let development = $(this).data('developmentvalue')
            developmentvalue = developmentvalue + development
            $('#developmentvalue').val(developmentvalue)
        }
        if($(this).data('socialvalue') !== undefined){
            let social = $(this).data('socialvalue')
            socialvalue = socialvalue + social
            $('#socialvalue').val(socialvalue)
        }
        if($(this).data('stablevalue') !== undefined){
            let stable = $(this).data('stablevalue')
            stablevalue = stablevalue + stable
            $('#stablevalue').val(stablevalue)
        }
        if($(this).data('teammatevalue') !== undefined){
            let teammate = $(this).data('teammatevalue')
            teammatevalue = teammatevalue + teammate
            $('#teammatevalue').val(teammatevalue)
        }
        if($(this).data('futurevalue') !== undefined){
            let future = $(this).data('futurevalue')
            futurevalue = futurevalue + future
            $('#futurevalue').val(futurevalue)
        }
    })
})
$('.diagnosis_company_btn').on('click',function(){
    $(this).closest('.question_wrap').removeClass('show')
    $(this).closest('.question_wrap').addClass('hidden')
    id = $(this).attr("href")
    $(id).addClass('show')
    $(id).removeClass('hidden')
})

let  companydevelopmentvalue= 0;
let  companysocialvalue= 0;
let  companystablevalue= 0;
let  companyteammatevalue= 0;
let  companyfuturevalue= 0;
$('.diagnosis_company_btn').each(function(){
    $(this).on('click',function(){
        if($(this).data('companydevelopmentvalue') !== undefined){
            let companydevelopment = $(this).data('companydevelopmentvalue')
            companydevelopmentvalue = companydevelopmentvalue + companydevelopment
            $('#developmentvalue').val(companydevelopmentvalue)
        }
        if($(this).data('companysocialvalue') !== undefined){
            let companysocial = $(this).data('companysocialvalue')
            companysocialvalue = companysocialvalue + companysocial
            $('#socialvalue').val(companysocialvalue)
        }
        if($(this).data('companystablevalue') !== undefined){
            let companystable = $(this).data('companystablevalue')
            companystablevalue = companystablevalue + companystable
            $('#stablevalue').val(companystablevalue)
        }
        if($(this).data('companyteammatevalue') !== undefined){
            let companyteammate = $(this).data('companyteammatevalue')
            companyteammatevalue = companyteammatevalue + companyteammate
            $('#teammatevalue').val(companyteammatevalue)
        }
        if($(this).data('companyfuturevalue') !== undefined){
            let companyfuture = $(this).data('companyfuturevalue')
            companyfuturevalue = companyfuturevalue + companyfuture
            $('#futurevalue').val(companyfuturevalue)
        }
    })
    })






