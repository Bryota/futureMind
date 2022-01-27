const { nodeName } = require("jquery");
window.onload = function() {
    let chart = document.getElementById('resultChart');
    let chartFutureValue = []
    let chartSelfValue = []
    chartFutureValue.push($('#js_future_developmentValue').data('futuredevelopmentvalue'));
    chartFutureValue.push($('#js_future_socialValue').data('futuresocialvalue'));
    chartFutureValue.push($('#js_future_stableValue').data('futurestablevalue'));
    chartFutureValue.push($('#js_future_teammateValue').data('futureteammatevalue'));
    chartFutureValue.push($('#js_future_futureValue').data('futurefuturevalue'));
    chartSelfValue.push($('#js_self_developmentValue').data('selfdevelopmentvalue'));
    chartSelfValue.push($('#js_self_socialValue').data('selfsocialvalue'));
    chartSelfValue.push($('#js_self_stableValue').data('selfstablevalue'));
    chartSelfValue.push($('#js_self_teammateValue').data('selfteammatevalue'));
    chartSelfValue.push($('#js_self_futureValue').data('selffuturevalue'));
    window.myBar = new Chart(chart,{
    type:'radar',
    data:{
        labels:["成長意欲","社会貢献","安定","仲間","将来性"],
        datasets:[{
            label:'自己分析',
            data:[chartSelfValue[0],chartSelfValue[1],chartSelfValue[2],chartSelfValue[3],chartSelfValue[4]],
            backgroundColor:'RGBA(255,255,255,0)',
            borderColor:'RGB(212,204,237)',
            borderWidth:2,
            pointBorderWidth:1,
            pointBackgroundColor:'#000'
        },{
            label:'理想分析',
            data:[chartFutureValue[0],chartFutureValue[1],chartFutureValue[2],chartFutureValue[3],chartFutureValue[4]],
            backgroundColor:'RGBA(255,255,255,0)',
            borderColor:'RGB(48,227,223)',
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
