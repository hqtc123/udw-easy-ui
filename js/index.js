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
function drawTotalChart(id) {
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
                    renderTo: id,
                    backgroundColor: "transparent"
                },
                title: {
                    text: 'UDW 建设数据量趋势',
                    y: 10,
                    verticalAlign: "bottom",
                    style: {
                        paddingBottom: "5px"
                    }
                },

                xAxis: {
                    categories: dateArr,
                    labels: {rotation: -30, align: 'right', style: { font: 'normal 10px Verdana, sans-serif'}}
                },
                legend: {
                    enabled: false
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
function drawTrendChart(id) {
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
                    renderTo: id,
                    backgroundColor: "transparent"
                },
                title: {
                    text: '每天总体输入输出趋势',
                    verticalAlign: "bottom",
                    y: 10
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
                legend: {
                    enabled: false
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
                var totalSize = (res.totalSize / 1024).toFixed(2);
                var dagNum = res.dagNum;
                var logNum = res.logNum;
                var tableNum = res.tableNum;
                var percentage = ((totalSize / 35) * 100).toFixed(1);

                $("#hq-total-table tr:eq(1) td:eq(0)").html(totalSize + "  P");
                $("#hq-total-table tr:eq(1) td:eq(2)").html(percentage + "  %");
                $("#hq-summary-table tr:eq(1) td:eq(0) a").html(dagNum);
                $("#hq-summary-table tr:eq(1) td:eq(1) a").html(logNum);
                $("#hq-summary-table tr:eq(1) td:eq(2) a").html(tableNum);
            }
        }
    })
}
$(function () {
    $("#contact-content").dialog("close");
    $("#contact-link").on("click", function () {
        $('#contact-content').dialog({
            modal: true,
        });
        $("#contact-content").dialog("open");
    });
    drawTotalChart("index-total-graph");
    drawTrendChart("index-trend-graph");
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
        drawTrendChart("trend-graph");
        getProductData();
        $(".right-child[id!='trend-graph-div']").fadeOut("slow", function () {
            $(".right-child[id='trend-graph-div']").show();
        });
    })
    $("#choose-total-trend").on("click", function () {
        drawTotalChart("total-graph");
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