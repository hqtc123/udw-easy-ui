function getDataAjax(urlStr) {
    $("#dg").datagrid({
        url: urlStr
    })
}

function drawTrendChart() {
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
            for (var j = 0; j < inputArr.length; j++) {
                if (isNaN(inputArr[j])) {
                    inputArr.rem
                }
                if (isNaN(outputArr[j])) {
                    outputArr[j] = null;
                }
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
                        enabled: false
                    },
                    lineWidth: 1,
                    labels: {
                        formatter: function () {
                            return this.value + "TB";
                        },
                        style: {
                            color: "#2f7ed8"
                        }
                    }
                },
                tooltip: {
                    valueSuffix: "TB"
                },
                showEmpty: false,
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
}
$(function () {
    getDataAjax("service/main.php");
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
        drawTrendChart();
        $("#trendGraph").show();
    })
    $("#hq-query-button").on("click", function () {
        var tagName = $("input[name='tag-name']").val().trim();
        var logName = $("input[name='log-name']").val().trim();
        var tableName = $("input[name='table-name']").val().trim();
        var transType = $("input[name='trans-type']").val().trim();
        var tableType = $("input[name='table-type']").val().trim();
        var suffix = "?";
        suffix += "tag-name=" + tagName;
        suffix += "&log-name=" + logName;
        suffix += "&table-name=" + tableName;
        suffix += "&trans-type=" + transType;
        suffix += "&table-type=" + tableType;
        getDataAjax("service/query.php" + suffix);
    })

})