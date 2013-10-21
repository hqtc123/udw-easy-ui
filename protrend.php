<?php
/**
 * Created by JetBrains PhpStorm.
 * User: heqing02
 * Date: 13-10-21
 * Time: 上午10:50
 * To change this template use File | Settings | File Templates.
 */
if (isset($_GET["product"])) {
    include_once("header.html");
}
?>
<link rel="stylesheet" type="text/css" href="css/list.css">
<div class="container" style="padding-top: 50px">
    <div id="trend-div" style="height: 500px;width: 800px;">

    </div>
</div>
<?php include_once("footer.html"); ?>
<script type="text/javascript">
    var product = "<?php echo $_GET["product"];?>";
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
                    renderTo: 'trend-div',
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
</script>

</body>
</html>
