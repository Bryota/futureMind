
window.onload = function() {
    let ctx2 = document.getElementById('companyChart');
    let chartCompanyValue = []
    chartCompanyValue.push($('#js_company_developmentValue').data('companydevelopmentvalue'));
    chartCompanyValue.push($('#js_company_socialValue').data('companysocialvalue'));
    chartCompanyValue.push($('#js_company_stableValue').data('companystablevalue'));
    chartCompanyValue.push($('#js_company_teammateValue').data('companyteammatevalue'));
    chartCompanyValue.push($('#js_company_futureValue').data('companyfuturevalue'));
    window.myBar = new Chart(ctx2,{
    type:'radar',
    data:{
        labels:["成長意欲","社会貢献","安定","仲間","将来性"],
        datasets:[{
            label:'企業診断',
            data:[chartCompanyValue[0],chartCompanyValue[1],chartCompanyValue[2],chartCompanyValue[3],chartCompanyValue[4]],
            backgroundColor:'RGBA(255,255,255,0)',
            borderColor:'RGB(253,255,131)',
            borderWidth:2,
            pointBorderWidth:1,
            pointBackgroundColor:'#000'
        }]
    },
    options:{
        title:{
            display:false,
        },
        scale:{
            ticks:{
                suggestedMin:0,
                suggestedMax:5,
                stepSize:1,
            }
        }
    }
})
}

