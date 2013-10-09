$(function () {
    var chart;
    var dateArr = [];
    var inputArr = [];
    var outputArr = [];
    $.ajax({
        url: 'service/trend.php',
        dataType: "json",
        async: false,
        success: function (point) {
            var obj = eval(point);
            for (var i = 0; i < obj.length; i++) {
                dateArr.push(obj[i].date.substring(0, 4) + "-" + obj[i].date.substring(4, 6) + "-" + obj[i].date.substring(6, 8));
                inputArr.push(parseFloat(obj[i].input));
                outputArr.push(parseFloat(obj[i].output));
            }
            chart = new Highcharts.Chart({
                chart: {
                    renderTo: 'trendGraph'
                },
                title: {
                    text: 'Input VS Output Trend',
                    x: -20 //center
                },

                xAxis: {
                    categories: dateArr
                },
                yAxis: {
                    title: {
                        text: 'something'
                    }
                },
                series: [
                    {
                        name: 'Input',
                        data: inputArr
                    },
                    {
                        name: 'Output',
                        data: outputArr
                    }
                ]
            });
        },
        error: function () {
            alert('error!')
        }
    });

    $("#taskDiv").show();
    $("#trendGraph").hide();
    $(".itemSpan").on("click", function () {
        $(".itemSpan").removeClass("onSelect");
        $(this).addClass("onSelect");
    })

    $("#chooseTask").on("click", function () {
        $("#trendGraph").hide();
        $("#taskDiv").show();
    })

    $("#chooseTrend").on("click", function () {
        $("#taskDiv").hide();
        $("#trendGraph").show();
    })
})