<?php include_once('phpcas/authentication.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>UDW 数据统计分析</title>
    <link rel="stylesheet" type="text/css" href="easyui/themes/metro-blue/easyui.css">
    <link rel="stylesheet" type="text/css" href="easyui/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="easyui/demo/demo.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="easyui/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="js/highcharts.js"></script>
</head>
<body>
<div class="layout_header">
    <div class="header">
        <div class="h_logo"><a href="index.php" title="UDW 数据统计分析"><img src="images/qaup_logo1.png" width="230"
                                                                                 height="40"
                                                                                 alt=""/></a></div>
        <div class="h_nav"><span class="hi"><img src="images/head_default.jpg"
                                                 alt="id"/> 欢迎你，<?php echo phpCas::getUser(); ?></span>
            <span class="link"><a href="javascript:void(0)" id="contact-link"><i class="icon16 icon16-setting"></i> 联系我们</a>
                <a href="?logout="><i class="icon16 icon16-power"></i> 注销</a>
            </span>
        </div>
        <div class="clear"></div>
    </div>
</div>