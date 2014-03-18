<?php include_once('phpcas/authentication.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>UDW 数据统计分析</title>
    <link rel="stylesheet" type="text/css" href="easyui/themes/metro-blue/easyui.css">
    <link rel="stylesheet" type="text/css" href="easyui/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="easyui/demo/demo.css">
    <!--    <link rel="stylesheet" type="text/css" href="css/index.css">-->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/hq.css">
    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="easyui/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="js/jquery.edatagrid.js"></script>
    <script type="text/javascript" src="js/datagrid-detailview.js"></script>
    <script type="text/javascript" src="js/highcharts.js"></script>
    <script type="text/javascript" src="js/common.js"></script>
    <script type="text/javascript" src="js/hq-datagrid.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
</head>
<body>
<div class="layout_header">
    <div class="header">
        <div class="h_logo"><a href="javascript:void(0)" title="UDW 数据统计分析"><img src="images/qaup_logo1.png" width="230"
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
<div class="layout_leftnav">
    <div class="inner">
        <div class="nav-vertical">
            <ul class="accordion">
                <li id="one"><a href="#one">数据统计<span></span></a>
                    <ul class="sub-menu">
                        <li><a href="javascript:void(0)" id="choose-summary" class="active item-span">UDW 总体情况</a></li>
                        <li><a href="javascript:void(0)" id="choose-task" class="item-span">DAG 任务流</a></li>
                        <li><a href="javascript:void(0)" id="choose-inout" class="item-span">Input & Output</a></li>
                        <li><a href="javascript:void(0)" id="choose-total" class="item-span">UDW 建设数据量</a></li>
                    </ul>
                </li>
                <li id="two"><a href="#two">资源管理<span></span></a>
                    <ul class="sub-menu">
                        <li><a href="javascript:void(0)" id="choose-estimate" class="item-span">资源预估</a></li>
                        <li><a href="javascript:void(0)" id="choose-apply" class="item-span">资源申请 | 审批</a></li>
                        <li><a href="javascript:void(0)" id="choose-record" class="item-span">资源变更记录</a></li>
                    </ul>
                </li>
                <li id="three"><a href="#three">资源账单<span></span></a>
                    <ul class="sub-menu">
                        <!--                        <li><a href="http://szwg-qatest-dpf006.szwg01.baidu.com:8525/index.php"-->
                        <!--                               id="choose-quality">数据质量</a></li>-->
                        <li><a href="javascript:void(0)" id="choose-storage" class="item-span">存储资源账单</a></li>
                        <li><a href="javascript:void(0)" class="item-span">敬请期待</a></li>
                    </ul>
                </li>
                <li id="four"><a href="#four">敬请期待<span></span></a>
                    <ul class="sub-menu">
                        <!--                        <li><a href="javascript:void(0)" class="item-span">没有内容</a></li>-->
                    </ul>
                </li>
            </ul>
            <script type="text/javascript">
                $(document).ready(function () {
                    // Store variables
                    var accordion_head = $('.accordion > li > a'),
                        accordion_body = $('.accordion li > .sub-menu');
                    // Open the first tab on load
                    accordion_head.first().addClass('active').next().slideDown('normal');
                    // Click function
                    accordion_head.on('click', function (event) {
                        // Disable header links
                        event.preventDefault();
                        // Show and hide the tabs on click
                        if ($(this).attr('class') != 'active') {
                            accordion_body.slideUp('normal');
                            $(this).next().stop(true, true).slideToggle('normal');
                            accordion_head.removeClass('active');
                            $(this).addClass('active');
                        }
                    });
                });
            </script>
        </div>
    </div>
</div>

<div class="layout_rightmain">
    <div class="inner">
        <div class="page-title"><i class="i_icon"></i><span id="page-title-span"> UDW 总体情况</span></div>
        <?php include_once("page-partitions/right_summary.php"); ?>
        <?php include_once("page-partitions/right_task.php"); ?>
        <?php include_once("page-partitions/right_inout.php"); ?>
        <?php include_once("page-partitions/right_total.php"); ?>
        <?php include_once("page-partitions/right_estimate.php"); ?>
        <?php include_once("page-partitions/right_apply.php"); ?>
        <?php include_once("page-partitions/right_record.php"); ?>
        <?php include_once("page-partitions/right_storage.php"); ?>
    </div>
</div>
<!--</div>-->
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
<div id="add-dir-win" class="easyui-window" title="添加存储目录" style="width:300px;height:210px;">
    <form style="padding:10px 20px 10px 40px;">
        <p>目录: <input type="text" id="dir-field"></p>

        <p>集群: <input type="text" id="cluster-field"></p>

        <div style="padding:5px;text-align:center;">
            <a href="javascript:void(0)" id="add-dir-submit" class="easyui-linkbutton" icon="icon-ok">添加</a>
            <a href="javascript:void(0)" id="add-dir-cancel" class="easyui-linkbutton" icon="icon-cancel">取消</a>
        </div>
    </form>
</div>
<div id="add-queue-win" class="easyui-window" title="添加计算队列" style="width:300px;height:210px;">
    <form style="padding:10px 20px 10px 40px;">
        <p>队列: <input type="text" id="queue-field"></p>

        <p>集群: <input type="text" id="cluster2-field"></p>

        <div style="padding:5px;text-align:center;">
            <a href="javascript:void(0)" id="add-queue-submit" class="easyui-linkbutton" icon="icon-ok">添加</a>
            <a href="javascript:void(0)" id="add-queue-cancel" class="easyui-linkbutton" icon="icon-cancel">取消</a>
        </div>
    </form>
</div>
<div style="position:fixed; z-index:100;right:0;bottom:25px;">
    <img src="images/ds.gif">
</div>
<div class="layout_footer">© 2013-2014 DT-OP版权所有</div>
<script type="text/javascript">
    function resetQueryForm() {
        $("#ff").form("reset");
    }

    function saveStorageRow() {
        $('#storage-record-edg').edatagrid('saveRow');
        setTimeout('$("#storage-record-edg").edatagrid("reload");', 500);
    }
    function deleteStorageRow() {
        $('#storage-record-edg').edatagrid('destroyRow');
        setTimeout('$("#storage-record-edg").edatagrid("reload");', 500);
    }
    function saveCalculateRow() {
        $('#calculate-record-edg').edatagrid('saveRow');
        setTimeout('$("#calculate-record-edg").edatagrid("reload");', 500);
    }
    function deleteCalculateRow() {
        $('#calculate-record-edg').edatagrid('destroyRow');
        setTimeout('$("#calculate-record-edg").edatagrid("reload");', 500);
    }
</script>
</body>
</html>