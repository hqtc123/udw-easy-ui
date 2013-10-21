<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>dag list</title>
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
    <div id="table-div" class="right-child">
        <table id="table-dg" class="easyui-datagrid" title="生成表列表" style="width: 818px;height: 500px"
               pagination="true" draggable="false"
               pageSize="20"
               rownumbers="true" fitColumns="true" singleSelect="true">
            <thead>
            <tr>
                <th field="tablename" width="60">表名</th>
                <th field="tabletype" width="35">表类型</th>
                <th field="tablepath" width="190">表路径</th>
                <th field="product" width="35">产品线</th>
            </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
<?php include_once("footer.html"); ?>
</body>
</html>