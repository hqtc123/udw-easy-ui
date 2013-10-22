function getDataAjax(urlStr) {
    $("#dg").datagrid({
        url: urlStr
    })
}
function getProductData() {
    $("#product-dg").datagrid({
        url: "service/product.php?product=all"
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
                    renderTo: 'total-graph',
                    backgroundColor: "transparent"
                },
                title: {
                    text: 'UDW Total Size Trend',
                    x: -20 //center
                },

                xAxis: {
                    categories: dateArr,
                    labels: {rotation: -30, align: 'right', style: { font: 'normal 10px Verdana, sans-serif'}}
                },
                yAxis: {
                    title: {
                        enabled: false
                    },
                    lineWidth: 1,
                    labels: {
                        formatter: function () {
                            return this.value + " T";
                        },
                        style: {
                            color: "#2f7ed8"
                        }
                    }
                },
                tooltip: {
                    valueSuffix: " T"
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
                    renderTo: 'trend-graph',
                    backgroundColor: "transparent"
                },
                title: {
                    text: '总体输入输出趋势',
                    x: -20 //center
                },

                xAxis: {
                    categories: dateArr,
                    labels: {rotation: -30, align: 'right', style: { font: 'normal 10px Verdana, sans-serif'}}
                },
                yAxis: {
                    title: {
                        enabled: false
                    },
                    lineWidth: 1,
                    labels: {
                        formatter: function () {
                            return this.value + " T";
                        },
                        style: {
                            color: "#2f7ed8"
                        }
                    }
                },
                tooltip: {
                    valueSuffix: " T"
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
function createSummary() {
    $.ajax({
        url: "service/main.php?action=summary",
        dataType: "json",
        success: function (res) {
            if (res.success == 1) {
                var totalSize = (res.totalSize / 1024).toFixed(5);
                var dagNum = res.dagNum;
                var logNum = res.logNum;
                var tableNum = res.tableNum;

                $("#hq-total-table tr:eq(0) td:eq(1)").html(totalSize + "  P");
                $("#hq-summary-table tr:eq(0) td:eq(1) a").html(dagNum);
                $("#hq-summary-table tr:eq(1) td:eq(1) a").html(logNum);
                $("#hq-summary-table tr:eq(2) td:eq(1) a").html(tableNum);
            }
        }
    })
}
$(function () {
    $(".right-child").hide();
    $("#summary-div").show();
    $(".itemSpan").on("click", function () {
        $(".itemSpan").removeClass("onSelect");
        $(this).addClass("onSelect");
    })
    createSummary();
    $("#choose-summary").on("click", function () {
        createSummary();
        $(".right-child[id!='summary-div']").fadeOut("slow", function () {
            $("#summary-div").show();
        });
    })

    $("#choose-task").on("click", function () {
        $(".right-child[id!='taskDiv']").fadeOut("slow", function () {
            $("#taskDiv").show();
            getDataAjax("service/main.php?action=task");
        });
    })

    $("#choose-trend").on("click", function () {
        drawTrendChart();
        getProductData();
        $(".right-child[id!='trend-graph-div']").fadeOut("slow", function () {
            $(".right-child[id='trend-graph-div']").show();
        });
    })
    $("#choose-total-trend").on("click", function () {
        drawTotalChart();
        $(".right-child[id!='total-graph-div']").fadeOut("slow", function () {
            $(".right-child[id='total-graph-div']").show();
        });
    })
    $("#hq-query-button").on("click", function () {

        var dagName = $("input[name='dag-name']").val().trim();
        var logName = $("input[name='log-name']").val().trim();
        var tableName = $("input[name='table-name']").val().trim();
        var transType = $("input[name='trans-type']").val().trim();
        var tableType = $("input[name='table-type']").val().trim();
        var tablePath = $("input[name='table-path']").val().trim();
        var logPath = $("input[name='log-path']").val().trim();
        var suffix = "?";
        suffix += "dag-name=" + dagName;
        suffix += "&log-name=" + logName;
        suffix += "&table-name=" + tableName;
        suffix += "&trans-type=" + transType;
        suffix += "&table-type=" + tableType;
        suffix += "&table-path=" + tablePath;
        suffix += "&log-path=" + logPath;
        getDataAjax("service/query.php" + suffix);
    })
})