<?php
/**
 * Created by JetBrains PhpStorm.
 * User: heqing02
 * Date: 13-10-25
 * Time: 下午12:40
 * To change this template use File | Settings | File Templates.
 */
if (isset($_GET["product"])) {
    include_once("header.php");
}
?>
<link rel="stylesheet" type="text/css" href="css/list.css">
<div class="layout_rightmain">
    <div class="inner">
        <div id="trend-div" style="height: 500px;width: 800px;">

        </div>
    </div>
</div>
<?php include_once("footer.html"); ?>
<script type="text/javascript">
    var product = "<?php echo $_GET["product"];?>";
    var chart;
    var dateArr = [];
    var sizeArr = [];


    chart = new Highcharts.Chart({
        loading: {
            labelStyle: {
                top: '45%'
            },
            style: {
                backgroundColor: 'transparent'
            }
        },
        chart: {
            renderTo: 'trend-div',
            backgroundColor: "transparent"
        },
        title: {
            text: product + ' 产品线大小趋势',
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
        series: []
    });
    chart.showLoading();
    $.ajax({
        url: 'service/prosize.php?product=' + product + '&action=per',
        dataType: "json",
        success: function (point) {
            var obj = eval(point);
            for (var i = 0; i < obj.length; i++) {
                dateArr.push(obj[i].date.substring(0, 4) + "-" + obj[i].date.substring(4, 6) + "-" + obj[i].date.substring(6, 8));
                sizeArr.push(parseFloat(obj[i].size));
            }
            chart.hideLoading();
            chart.addSeries({
                name: 'Size',
                data: sizeArr
            })
        },
        error: function () {
            alert('error!')
        }
    });
</script>

</body>
</html>
