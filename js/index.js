function getDataAjax(urlStr) {
    $("#dg").datagrid({
        url: urlStr
    })
}
function drawTotalChart() {
    var chart;
    var dateArr = [];
    var totalArr = [];
    $.ajax({
        url: 'service/trend.php?action=total',
        dataType: "json",
        success: function (point) {
            var obj = eval(point);
            for (var i = 0; i < obj.length; i++) {
                dateArr.push(obj[i].date);
                totalArr.push(parseFloat(obj[i].total));
            }
            for (var j = 0; j < totalArr.length; j++) {
                if (isNaN(totalArr[j])) {
                    totalArr[j] = null;
                }
            }
            chart = new Highcharts.Chart({
                chart: {
                    renderTo: 'total-graph'
                },
                title: {
                    text: 'UDW Total Size Trend',
                    x: -20 //center
                },

                xAxis: {
                    categories: dateArr,
                    labels: {rotation: 30,	align: 'right',	style: { font: 'normal 10px Verdana, sans-serif'}}
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
                        name: 'total',
                        data: totalArr
                    }
                ]
            });
        },
        error: function () {
            alert('error!')
        }
    });
}
function drawTrendChart() {
    var chart;
    var dateArr = [];
    var inputArr = [];
    var outputArr = [];
    $.ajax({
        url: 'service/trend.php?action=in-out',
        dataType: "json",
        success: function (point) {
            var obj = eval(point);
            for (var i = 0; i < obj.length; i++) {
                dateArr.push(obj[i].date.substring(0, 4) + "-" + obj[i].date.substring(4, 6) + "-" + obj[i].date.substring(6, 8));
                inputArr.push(parseFloat(obj[i].input));
                outputArr.push(parseFloat(obj[i].output));
            }
            for (var j = 0; j < inputArr.length; j++) {
                if (isNaN(inputArr[j])) {
                    inputArr[j] = null;
                }
                if (isNaN(outputArr[j])) {
                    outputArr[j] = null;
                }
            }
            chart = new Highcharts.Chart({
                chart: {
                    renderTo: 'trend-graph'
                },
                title: {
                    text: 'Input VS Output Trend',
                    x: -20 //center
                },

                xAxis: {
                    categories: dateArr,
                    labels: {rotation: 30,	align: 'right',	style: { font: 'normal 10px Verdana, sans-serif'}}
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
    $("#trend-graph").hide();
    $(".itemSpan").on("click", function () {
        $(".itemSpan").removeClass("onSelect");
        $(this).addClass("onSelect");
    })

    $("#choose-task").on("click", function () {
        $(".right-child[id!='taskDiv']").fadeOut("slow", function () {
            $("#taskDiv").fadeIn("normal");
        });
    })

    $("#choose-trend").on("click", function () {
        $(".right-child[id!='trend-graph']").fadeOut("slow", function () {
            $("#trend-graph").fadeIn("normal", function () {
                drawTrendChart();
            })
        });
    })
    $("#choose-total-trend").on("click", function () {
        $(".right-child[id!='total-graph']").fadeOut("slow", function () {
            $("#total-graph").fadeIn("normal", function () {
                drawTotalChart();
            })
        });
    })
    $("#hq-query-button").on("click", function () {
        var tagName = $("input[name='tag-name']").val().trim();
        var logName = $("input[name='log-name']").val().trim();
        var tableName = $("input[name='table-name']").val().trim();
        var transType = $("input[name='trans-type']").val().trim();
        var tableType = $("input[name='table-type']").val().trim();
        var tablePath = $("input[name='table-path']").val().trim();
        var suffix = "?";
        suffix += "tag-name=" + tagName;
        suffix += "&log-name=" + logName;
        suffix += "&table-name=" + tableName;
        suffix += "&trans-type=" + transType;
        suffix += "&table-type=" + tableType;
        suffix += "&table-path=" + tablePath;
        getDataAjax("service/query.php" + suffix);
    })
})