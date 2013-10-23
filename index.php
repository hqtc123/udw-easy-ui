<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>UDW 数据统计分析</title>
    <link rel="stylesheet" type="text/css" href="easyui/themes/metro-blue/easyui.css">
    <link rel="stylesheet" type="text/css" href="easyui/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="easyui/demo/demo.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="easyui/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="js/highcharts.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
</head>
<body>
<div id="header" style="height: 36px;width: 100%">
    <div id="header-inner" style="width: 1000px; height: 36px">
        <div id="titleDiv" style="width: 500px;height: 36px">
            <div id="titleDiv-inner">UDW 数据统计分析</div>
        </div>
        <div id="linksDiv" style="width: 450px;height: 36px">
            <div id="linksDiv-inner">
                <a href="javascript:void(0)" id="contact-link">联系我们</a>
                <a href=" javascript:void(0)">Home</a>
            </div>
        </div>
    </div>
</div>
<div id="container" style="width:1016px;height: 620px">
    <div class="easyui-panel" id="leftPanel" style="width: 189px;height: 660px">
        <div id="menuItem1" style="height: 180px">
            <div class="panel-header accordion-header" style="height: 16px; width: 178px;">
                <div class="panel-title panel-with-icon">数据统计</div>
                <div class="panel-icon icon-reload"></div>
            </div>
            <ul class="toolMenu">
                <li>
                    <a id="choose-summary" class="itemSpan onSelect">UDW总体情况</a>
                </li>
                <li>
                    <a id="choose-task" class="itemSpan">DAG任务流</a>
                </li>
                <li>
                    <a id="choose-trend" class="itemSpan">Input & Output</a>
                </li>
                <li>
                    <a id="choose-total-trend" class="itemSpan">UDW 建设数据量</a>
                </li>
            </ul>
        </div>
        <div id="menuItem2" style="height: 150px">
            <div class="panel-header accordion-header" style="height: 16px; width: 178px;">
                <div class="panel-title panel-with-icon">后续功能</div>
                <div class="panel-icon icon-reload"></div>
            </div>
            <ul class="toolMenu">
                <li>
                    <a id="choose-dag-list" class="itemSpan">敬请期待</a>
                </li>
                <li>
                    <a id="choose-log-list" class="itemSpan">敬请期待</a>
                </li>
                <li>
                    <a id="choose-table-list" class="itemSpan">敬请期待</a>
                </li>
            </ul>
        </div>
        <div id="menuItem3" style="height: 220px">
            <div class="panel-header accordion-header" style="height: 16px; width: 178px;">
                <div class="panel-title panel-with-icon">敬请期待</div>
                <div class="panel-icon icon-reload"></div>
            </div>
        </div>
    </div>
    <div id="rightPanel">
        <div id="summary-div" class="right-child">

            <div id="total-content" class="easyui-panel" title="UDW建设数据量" style="width:720px">
                <table id="hq-total-table">
                    <thead>
                    <td>UDW建设数据量</td>
                    <td>存储资源QUOTA</td>
                    <td>存储资源使用率</td>
                    </thead>

                    <tr>
                        <td></td>
                        <td>35 P</td>
                        <td></td>
                    </tr>
                </table>
                <div id="index-total-graph" style="width:720px;height:320px;">

                </div>
            </div>

            <div id="summary-content" class="easyui-panel" title="UDW总体情况" style="width:720px">
                <table id="hq-summary-table">
                    <tr>
                        <td>DAG:任务数目</td>
                        <td>LOG:日志数目</td>
                        <td>TABLE:表数目</td>
                    </tr>
                    <tr>
                        <td><a id="dag-a" href="dag.php"></a><span>（点击查看任务列表）</span></td>
                        <td><a id="log-a" href="log.php"></a><span>（点击查看日志列表）</span></td>
                        <td><a id="table-a" href="table.php"></a><span>（点击查看生成表列表）</span></td>
                    </tr>
                </table>
            </div>
            <div id="in-trend-content" class="easyui-panel" title="每天总体输入输出" style="width:720px">
                <div id="index-trend-graph" style="width:720px;height:360px;">

                </div>
            </div>
        </div>
        <div id="taskDiv" class="right-child">
            <table id="dg" title="DAG:任务执行列表" class="easyui-datagrid" style="width:818px;height:500px"
                   pagination="true" draggable="false"
                   pageSize="10"
                   rownumbers="true" fitColumns="true" singleSelect="true">
                <thead>
                <tr>
                    <th field="dagname" width="80">任务名</th>
                    <th field="logname" width="80">日志名</th>
                    <th field="log_type" width="60">日志传输方式</th>
                    <th field="log_path" width="160">日志路径</th>
                    <th field="output_table" width="80">表名称</th>
                    <th field="table_type" width="80">表类型</th>
                    <th field="table_path" width="160">表路径</th>
                </tr>
                </thead>
                <tbody id="mainBody">

                </tbody>
            </table>
            <div class="easyui-panel" title="查询" style="width:500px">
                <form id="ff" method="post">
                    <table>
                        <tr>
                            <td>任务名 :</td>
                            <td><input class="easyui-validatebox" type="text" name="dag-name"></input></td>
                        </tr>
                        <tr>
                            <td>日志名 :</td>
                            <td><input class="easyui-validatebox" type="text" name="log-name"></input></td>
                        </tr>

                        <tr>
                            <td>日志传输方式 : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  </td>
                            <td>
                                <select class="easyui-combobox" panelHeight="auto" name="trans-type">
                                    <option value="">不限</option>
                                    <option value="BIGPIPE">BIGPIPE</option>
                                    <option value="LDM">LDM</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>日志路径 :</td>
                            <td><input class="easyui-validatebox" type="text" name="log-path"></input></td>
                        </tr>
                        <tr>
                            <td>表名称 :</td>
                            <td><input class="easyui-validatebox" type="text" name="table-name"></input></td>
                        </tr>
                        <tr>
                            <td>表类型 :</td>
                            <td>
                                <select class="easyui-combobox" panelHeight="auto" name="table-type">
                                    <option value="">不限</option>
                                    <option value="BIGTABLE">BIGTABLE</option>
                                    <option value="SMALLTABLE">SMALLTABLE</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>表路径 :</td>
                            <td><input class="easyui-validatebox" type="text" name="table-path"></input></td>
                        </tr>
                        <tr>
                            <td>
                                <input type="button" value="查询" id="hq-query-button">
                            </td>
                            <td>
                                <input type="button" value="重置" id="hq-reset-button" onclick="resetQueryForm()">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <div id="trend-graph-div" class="right-child">
            <div id="trend-graph" style="width:810px;height:360px;margin: 0 auto">

            </div>
            <div id="hq-bar"></div>
            <table id="product-dg" title="各个产品线输入输出" class="easyui-datagrid"
                   style="width:818px;height:399px;margin-top: 20px;margin-left: 60px"
                   pagination="false" draggable="false"
                   rownumbers="true" fitColumns="true" singleSelect="true"
                   sortName="outputSize" sortOrder="desc">
                <thead>
                <tr>
                    <th field="product" width="20">产品线</th>
                    <th field="inputSize" width="35" sortable="true">输入（T）</th>
                    <th field="inputDate" width="35">输入数据日期</th>
                    <th field="outputSize" width="35" sortable="true">输出（T）</th>
                    <th field="outputDate" width="35">输出数据日期</th>
                    <th field="trend" width="10">趋势</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <div id="total-graph-div" class="right-child">
            <div id="total-graph" style="width:810px;height:400px;margin: 0 auto">

            </div>
        </div>
    </div>
</div>
</div>
<div id="contact-content" class="easyui-dialog" title="联系我们" style="width:660px;">
    <h3>&nbsp;&nbsp;1.&nbsp;&nbsp;<a
            href="http://wiki.babel.baidu.com/twiki/bin/view/Com/Inf/UDW%E8%B5%84%E6%BA%90%E4%BD%BF%E7%94%A8%E7%BB%9F%E8%AE%A1">各产品线的udw-rd接口人信息</a>
    </h3>

    <h3>&nbsp;&nbsp;2.&nbsp;&nbsp;udw用户hi群号：1388125 &nbsp;&nbsp;&nbsp;&nbsp;用户邮件组：<a
            href="mailto:udw-user@baidu.com">udw-user@baidu.com</a>
    </h3>

    <h3>&nbsp;&nbsp;3.&nbsp;&nbsp;<a
            href="http://icafe.baidu.com/space/udw/issue/wall?spaceId=4254&cid=5&vid=0#tip=nofield&lane=&channel=">若有需求请移步icafe</a>
    </h3>
</div>
<?php include_once("footer.html") ?>
<script type="text/javascript">
    function resetQueryForm() {
        $("#ff").form("reset");
    }
</script>
</body>
</html>