<?php include_once('phpcas/authentication.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>UDW 数据统计分析</title>
    <link rel="stylesheet" type="text/css" href="easyui/themes/metro-blue/easyui.css">
    <link rel="stylesheet" type="text/css" href="easyui/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="easyui/demo/demo.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="easyui/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="js/highcharts.js"></script>
</head>
<body>
<div id="header" style="height: 36px;width: 100%">
    <div id="header-inner" style="width: 1000px; height: 36px">
        <div id="titleDiv" style="width: 500px;height: 36px">
            <div id="titleDiv-inner">UDW 数据统计分析</div>
        </div>
        <div id="linksDiv" style="width: 450px;height: 36px">
            <div id="linksDiv-inner">
                <span>欢迎 ,<b id="account"><?php echo phpCas::getUser(); ?></b></span>
                <a href="?logout=">退出</a>
                <a href="index.php">首页</a>
            </div>
        </div>
    </div>
</div>