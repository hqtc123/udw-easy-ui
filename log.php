<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>log list</title>
    <link rel="stylesheet" type="text/css" href="easyui/themes/metro-blue/easyui.css">
    <link rel="stylesheet" type="text/css" href="easyui/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="easyui/demo/demo.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/list.css">
    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="easyui/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="js/highcharts.js"></script>
    <script type="text/javascript" src="js/list.js"></script>
</head>
<body>
<div id="header" style="height: 36px;width: 100%">
    <div id="header-inner" style="width: 1000px; height: 36px">
        <div id="titleDiv" style="width: 500px;height: 36px">
            <div id="titleDiv-inner">UDW Web Interface</div>
        </div>
        <div id="linksDiv" style="width: 450px;height: 36px">
            <div id="linksDiv-inner">
                <a href="index.php">Home</a>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div id="dag-div" class="right-child">
        <table id="log-dg" class="easyui-datagrid" title="日志列表" style="width: 818px;height: 500px"
               pagination="true" draggable="false"
               pageSize="20"
               rownumbers="true" fitColumns="true" singleSelect="true">
            <thead>
            <tr>
                <th field="logname" width="70">日志名</th>
                <th field="logtype" width="35">传输方式</th>
                <th field="logpath" width="180">日志路径</th>
                <th field="product" width="35">产品线</th>
            </tr>
            </thead>
            <tbody></tbody>
        </table>

        <div class="easyui-panel" title="查询" style="width:818px">
            <form id="ff" method="post">
                <table>
                    <tr>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td>日志名 :</td>
                        <td><input class="easyui-validatebox" type="text" name="log-name"></input></td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td>产品线 :</td>
                        <td><select class="easyui-combobox" value="" name="product">
                                <option value="">不限</option>
                                <option value="map">map</option>
                                <option value="baike">baike</option>
                                <option value="ps">ps</option>
                                <option value="clb">clb</option>
                                <option value="NOVA">NOVA</option>
                                <option value="wenku">wenku</option>
                                <option value="hao123">hao123</option>
                                <option value="pcs">pcs</option>
                                <option value="tieba">tieba</option>
                                <option value="image">image</option>
                                <option value="iknow">iknow</option>
                                <option value="news">news</option>
                                <option value="weibo">weibo</option>
                                <option value="appsearch">appsearch</option>
                                <option value="wise">wise</option>
                                <option value="baiduapp">baiduapp</option>
                                <option value="chunlei">chunlei</option>
                                <option value="uap">uap</option>
                                <option value="bd_input">bd_input</option>
                                <option value="netdisk">netdisk</option>
                                <option value="pcbrowser">pcbrowser</option>
                                <option value="pcime">pcime</option>
                                <option value="fengchao">fengchao</option>
                                <option value="globalps">globalps</option>
                                <option value="browser">browser</option>
                                <option value="music">music</option>
                                <option value="ns">ns</option>
                                <option value="CLOUD">CLOUD</option>
                                <option value="share">share</option>
                                <option value="sobar">sobar</option>
                            </select></td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td><input type="button" value="查询" id="hq-log-button"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php include_once("footer.html"); ?>
</body>
</html>