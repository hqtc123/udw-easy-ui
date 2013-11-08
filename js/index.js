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
function getProductSizeData() {
    $("#product-size-dg").datagrid({
        url: "service/prosize.php?action=size"
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
                    labels: {rotation: -30, step: 2, align: 'right', style: { font: 'normal 10px Verdana, sans-serif'}}
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
                    formatter: function () {
                        return this.x + ":<br>" + this.y.toFixed(1) + " T";
                    }
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
                    labels: {rotation: -30, step: 2, align: 'right', style: { font: 'normal 10px Verdana, sans-serif'}}
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
                    formatter: function () {
                        return this.x + "<br>" + this.series.name + ":" + this.y.toFixed(1) + " T";
                    }
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
function drawSizePie() {
    var dataArr = new Array();
    $.ajax({
        url: "service/prosize.php?action=pie",
        dataType: "json",
        success: function (data) {
            for (var i = 0; i < data.length; i++) {
                var tmp = new Array();
                tmp[0] = data[i][1];
                tmp[1] = parseFloat(data[i][0]);
                dataArr[i] = tmp;
            }

            new Highcharts.Chart({
                chart: {
                    renderTo: 'hq-pie',
                    backgroundColor: "transparent",
                    plotBorderWidth: 0,
                    plotShadow: false
                },
                title: {
                    text: "各产品线大小比例",
                    verticalAlign: 'bottom',
                    y: 0
                },
                tooltip: {
                    formatter: function () {
                        return '<b>' + this.point.name + '</b>: ' + this.y + ' TB';
                    }
                },
                plotOptions: {
                    pie: {
                        size: '80%',
                        borderWidth: 1,
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            color: '#000',
                            distance: 5,//通过设置这个属性，将每个小饼图的显示名称和每个饼图重叠
                            style: {
                                fontSize: '10px',
                                lineHeight: '10px'
                            },
                            formatter: function () {
                                return '<b>' + this.point.name + '</b>: ' + Highcharts.numberFormat(this.percentage, 2) + ' %';
//                                return  '<span style="color:#00008B;">' + this.point.name + '</span>';
                            }
                        },
                        padding: 20
                    }
                },
                series: [
                    {
                        type: 'pie',
                        name: "size",
                        data: dataArr
                    }
                ]
            });
        }
    })

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
                var logBigNum = res.logBigNum;
                var logLdmNum = logNum - logBigNum;
                var tableNum = res.tableNum;
                var tableBigNum = res.tableBigNum;
                var tableSmallNum = tableNum - tableBigNum;
                var percentage = ((totalSize / 35) * 100).toFixed(1);

                $("#hq-total-table tr:eq(1) td:eq(0)").html(totalSize + "  P");
                $("#hq-total-table tr:eq(1) td:eq(2)").html(percentage + "  %");
                $("#hq-summary-table tr:eq(1) td:eq(0) a").html(dagNum);
                $("#hq-summary-table tr:eq(1) td:eq(1) a").html(logNum);
                $("#hq-summary-table tr:eq(1) td:eq(1) span").html(" (BIGPIPE:" + logBigNum + ",LDM:" + logLdmNum + ")");
                $("#hq-summary-table tr:eq(1) td:eq(2) a").html(tableNum);
                $("#hq-summary-table tr:eq(1) td:eq(2) span").html(" (BIG:" + tableBigNum + ",SMALL:" + tableSmallNum + ")");
            }
        }
    })
    $("#table-date-dg").datagrid({
        url: "service/main.php?action=table-date"
    })
}
$(function () {
    var sizePerDay = 0;
    $("#contact-content").dialog("close");
    $("#contact-link").on("click", function () {
        $('#contact-content').dialog({
            modal: true
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
        drawSizePie();
        getProductSizeData();
        $(".right-child[id!='total-graph-div']").fadeOut("slow", function () {
            $(".right-child[id='total-graph-div']").show();
        });
    })

    $("#choose-res-estimate").on("click", function () {
        $.ajax({
            url: "service/main.php?action=res-estimate",
            success: function (data) {
                sizePerDay = parseFloat(data).toFixed(2);
                $("#per-day-td").html("UDW压缩后平均每天数据量：" + sizePerDay + " T");
            }
        });

        $("#table-estimate-dg").datagrid({
            url: "service/main.php?action=table-estimate"
        })
        $(".right-child[id!='res-estimate']").fadeOut("slow", function () {
            $(".right-child[id='res-estimate']").show();
        });
    })
//总体大小预估计算
    $("#res-estimate-btn").on("click", function () {
        if (sizePerDay == 0) {
            alert("请稍候");
            return
        }
        var days = $("#res-estimate-input").val();
        if (isNaN(days) || days == "") {
            alert("请您输入一个天数，整数型的，别的我还不会算")
            return
        }
        var result = parseFloat(sizePerDay * days).toFixed(2);
        $("#hq-res-estimate-table label").html(result + "  T")
    })
//总体大小增量预估计算
    $("#res-estimate-add-btn").on("click", function () {
        var days = $("#res-estimate-add-input").val();
        if (isNaN(days) || days == "") {
            alert("请您输入一个天数，整数型的，别的我还不会算")
            return
        }
        $("#res-estimate-add-table label").html("计算中……")
        $.ajax({
            url: "service/main.php?action=all-add-estimate",
            dataType: "json",
            type: "POST",
            data: {
                "days": days
            },
            success: function (result) {
                $("#res-estimate-add-table label").html(result + "  T")
            }
        })
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
//首页summary-div的表，建设天数查询
    $("#index-query-button").on("click", function () {
        var tableName = $("input[name='table-name2']").val().trim();
        var product = $("input[name='product']").val().trim();
        var days = $("input[name='days']").val().trim();
        var suffix = "";
        suffix += "&table-name=" + tableName;
        suffix += "&product=" + product;
        suffix += "&days=" + days;
        suffix += "&page=" + 1;
        suffix += "&rows=" + 10;
        $("#table-date-dg").datagrid({
            url: "service/main.php?action=table-date" + suffix
        })
    })
    //每个表增量建设查询
    $("#res-query-button").on("click", function () {
        var tableName = $("input[name='table-name3']").val().trim();
        var product = $("input[name='product2']").val().trim();
        var suffix = "";
        suffix += "&table-name=" + tableName;
        suffix += "&product=" + product;
        suffix += "&page=" + 1;
        suffix += "&rows=" + 10;
        $("#table-estimate-dg").datagrid({
            url: "service/main.php?action=table-estimate" + suffix
        })
    })
})