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
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="easyui/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="js/jquery.edatagrid.js"></script>
    <script type="text/javascript" src="js/datagrid-detailview.js"></script>
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
                <b>欢迎 ,<?php echo phpCas::getUser(); ?></b>
                <a href="?logout=">退出</a>
                <a href="javascript:void(0)" id="contact-link">联系我们</a>
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
            <li class="onSelect">
                <a id="choose-summary" class="itemSpan">UDW总体情况</a>
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
            <div class="panel-title panel-with-icon">资源管理</div>
            <div class="panel-icon icon-reload"></div>
        </div>
        <ul class="toolMenu">
            <li>
                <a id="choose-res-estimate" class="itemSpan">资源预估</a>
            </li>
            <li>
                <a id="choose-res-apply" class="itemSpan">资源申请 | 审批</a>
            </li>
            <li>
                <a id="choose-res-change" class="itemSpan">资源变更记录</a>
            </li>
        </ul>
    </div>
    <div id="menuItem3" style="height: 220px">
        <div class="panel-header accordion-header" style="height: 16px; width: 178px;">
            <div class="panel-title panel-with-icon">数据质量</div>
            <div class="panel-icon icon-reload"></div>
        </div>
        <ul class="toolMenu">
            <li>
                <a href="http://szwg-qatest-dpf006.szwg01.baidu.com:8525/index.php" class="itemSpan">数据质量</a>
            </li>
            <li>
                <a id="choose-log-list" class="itemSpan">敬请期待</a>
            </li>
            <li>
                <a id="choose-table-list" class="itemSpan">敬请期待</a>
            </li>
        </ul>
    </div>
</div>
<div id="rightPanel">
<!--首页-->
<div id="summary-div" class="right-child">

    <div id="total-content" class="easyui-panel" title="UDW建设数据量" style="width:818px">
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
        <div id="index-total-graph" style="width:760px;height:200px;margin-right: 36px">

        </div>
    </div>

    <div id="summary-content" class="easyui-panel" title="UDW总体情况" style="width:818px">
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
    <div id="in-trend-content" class="easyui-panel" title="每天总体输入输出" style="width:818px">
        <div id="index-trend-graph" style="width:760px;height:300px;margin-right: 36px">

        </div>
    </div>
    <table id="table-date-dg" title="各表的建设时间" class="easyui-datagrid" style="width:818px;height:350px"
           pagination="true" draggable="false"
           pageSize="10"
           rownumbers="true" fitColumns="true" singleSelect="true">
        <thead>
        <tr>
            <th field="product" width="60">产品线</th>
            <th field="tableName" width="200">表名</th>
            <th field="period" width="120">建设时间段</th>
            <th field="days" width="60">建设天数</th>
        </tr>
        </thead>
        <tbody id="mainBody">

        </tbody>

        <form id="ff">
            <table>
                <tr>
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
                    <td>表名 :</td>
                    <td><input class="easyui-validatebox" type="text" name="table-name2"></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>建设天数 :</td>
                    <td><select class="easyui-combobox" panelHeight="auto" value="" name="days">
                            <option value="days">不限</option>
                            <option value="days1">少于184天</option>
                            <option value="days2">184-365天</option>
                            <option value="days3">366-548</option>
                            <option value="days4">超过548天</option>
                        </select></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td><input type="button" value="查询" id="index-query-button"></td>
                </tr>
            </table>
        </form>
    </table>
</div>
<!--任务流-->
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
                    <td><input class="easyui-validatebox" type="text" name="dag-name"/></td>
                </tr>
                <tr>
                    <td>日志名 :</td>
                    <td><input class="easyui-validatebox" type="text" name="log-name"/></td>
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
                    <td><input class="easyui-validatebox" type="text" name="log-path"/></td>
                </tr>
                <tr>
                    <td>表名称 :</td>
                    <td><input class="easyui-validatebox" type="text" name="table-name"/></td>
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
                    <td><input class="easyui-validatebox" type="text" name="table-path"/></td>
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
            <th field="product" width="35">产品线</th>
            <th field="inputSize" width="35" sortable="true">输入（T）</th>
            <th field="inputDate" width="20">输入数据日期</th>
            <th field="outputSize" width="35" sortable="true">输出（T）</th>
            <th field="outputDate" width="20">输出数据日期</th>
            <th field="trend" width="10">趋势</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<div id="total-graph-div" class="right-child">
    <div id="total-graph" style="width:810px;height:300px;margin: 0 auto">

    </div>
    <div id="hq-bar"></div>
    <div id="hq-pie" style="width: 810px;height: 320px"></div>
    <div id="hq-bar"></div>
    <table id="product-size-dg" title="各个产品线大小" class="easyui-datagrid"
           style="width:818px;height:320px;margin-top: 20px;margin-left: 60px"
           pagination="false" draggable="false"
           rownumbers="true" fitColumns="true" singleSelect="true"
        >
        <thead>
        <tr>
            <th field="product" width="35">产品线</th>
            <th field="size" width="35">大小（T）</th>
            <th field="date" width="35">数据日期</th>
            <th field="trend" width="10">趋势</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<!--资源预估-->
<div id="res-estimate" class="right-child">
    <div id="res-estimate-panel" class="easyui-panel" title="UDW资源预估" style="width:818px">
        <table id="hq-res-estimate-table">
            <thead>
            <td id="per-day-td">UDW压缩后平均每天数据量：</td>
            <td>输入天数：<input type="text" id="res-estimate-input"><input id="res-estimate-btn" type="button" value="确定">
            </td>
            <td>预估大小：<label>待估</label></td>
            </thead>
        </table>
    </div>

    <div id="res-estimate-add-panel" class="easyui-panel" title="UDW资源增量预估" style="width:818px">
        <table id="res-estimate-add-table">
            <thead>
            <td id="per-day-add-td">计算把所有表建设到指定天数还需要的存储量</td>
            <td>输入天数：<input type="text" id="res-estimate-add-input"><input id="res-estimate-add-btn" type="button"
                                                                           value="确定">
            </td>
            <td>预估增加总量：<label>待估</label></td>
            </thead>
        </table>
    </div>

    <!--每个表预计时间-->
    <table id="table-estimate-dg" title="各表建设资源增量预估" class="easyui-datagrid" style="width:818px;height:500px"
           pagination="true" draggable="false"
           pageSize="20"
           rownumbers="true" fitColumns="true" singleSelect="false">
        <thead>
        <tr>
            <th field="product" width="50">产品线</th>
            <th field="tableName" width="100">表名</th>
            <th field="already_days" width="45">已建天数</th>
            <th field="per_size" width="110">压缩后每天平均大小(T)</th>
            <th field="input" width="150">输入预估天数</th>
            <th field="result" width="60">估计增加量(T)</th>
        </tr>
        </thead>
        <tbody id="mainBody">

        </tbody>

        <form id="res-ff">
            <table>
                <tr>
                    <td>产品线 :</td>
                    <td><select class="easyui-combobox" value="" name="product2">
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
                    <td>表名 :</td>
                    <td><input class="easyui-validatebox" type="text" name="table-name3"/></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td><input type="button" value="查询" id="res-query-button"></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                </tr>
            </table>
        </form>
    </table>
</div>
<!--资源申请部分-->
<div id="res-apply" class="right-child" style="height: 900px">
    <div class="easyui-panel" title="资源申请" style="width:818px">
        <div class="easyui-tabs" style="width:600px;height:388px;margin-left: 100px">
            <div title="申请存储资源" style="padding:10px 30px">
                <form id="storage-form" method="post">
                    <table>
                        <tr>
                            <td style="display: none"><input type="text" name="type" value="存储资源"></td>
                            <td>集群 :</td>
                            <td><input class="easyui-validatebox" type="text" name="cluster"
                                       data-options="required:true"/></td>
                        </tr>
                        <tr>
                            <td>存储目录 :</td>
                            <td><input class="easyui-validatebox" type="text" name="req_str"
                                       data-options="required:true"/></td>
                        </tr>

                        <tr>
                            <td>存储大小（T） :</td>
                            <td><input class="easyui-numberbox" type="text" name="req_num"
                                       data-options="required:true"/></td>
                        </tr>
                        <tr>
                            <td>
                                详细说明 :多少份数据、每份数据多大;
                                每份数据需要存储多少天、说明原因。
                            </td>
                            <td><textarea class="easyui-validatebox" required="true" name="reason"
                                          style="height: 88px;width: 208px;resize: none"></textarea></td>
                        </tr>

                        <tr>
                            <td>申请人邮箱(前缀) :</td>
                            <td><input class="easyui-validatebox" type="text" name="mail"
                                       data-options="required:true"/></td>
                        </tr>
                        <tr>
                            <td>
                                <input type="submit" value="申请" id="storage-btn">
                            </td>
                            <td>
                                <input type="button" value="重置" id="storage-reset-btn" onclick="resetStorageForm()">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <div title="申请计算资源" style="padding:10px 30px">
                <form id="calculate-form" method="post">
                    <table>
                        <tr>
                            <td style="display: none"><input type="text" name="type" value="计算资源"></td>
                            <td>集群 :</td>
                            <td><input class="easyui-validatebox" type="text" name="cluster"
                                       data-options="required:true"/></td>
                        </tr>
                        <tr>
                            <td>队列 :</td>
                            <td><input class="easyui-validatebox" type="text" name="req_str"
                                       data-options="required:true"/></td>
                        </tr>

                        <tr>
                            <td>槽位（个） :</td>
                            <td><input class="easyui-numberbox" type="text" name="req_num"
                                       data-options="required:true"/></td>
                        </tr>
                        <tr>
                            <td>
                                详细说明 :多少个任务、每个任务并发多少槽位、任务需要几点完成，说明原因。
                            </td>
                            <td><textarea class="easyui-validatebox" required="true" name="reason"
                                          style="height: 88px;width: 208px;resize: none"
                                    ></textarea></td>
                        </tr>

                        <tr>
                            <td>申请人邮箱(前缀) :</td>
                            <td><input class="easyui-validatebox" type="text" name="mail"
                                       data-options="required:true"/></td>
                        </tr>
                        <tr>
                            <td>
                                <input type="submit" value="申请" id="calculate-btn">
                            </td>
                            <td>
                                <input type="button" value="重置" id="calculate-reset-btn" onclick="resetCalculateForm()">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>

    <table id="apply-dg" title="资源申请列表" class="easyui-datagrid" style="width:818px;height:388px;"
           pagination="true" draggable="false"
           pageSize="10"
           rownumbers="false" fitColumns="true" singleSelect="true">
        <thead>
        <tr>
            <th field="id" width="15">编号</th>
            <th field="type" width="20">类型</th>
            <th field="cluster" width="30">集群</th>
            <th field="req_str" width="50">队列/存储目录</th>
            <th field="req_num" width="20">TB/槽位</th>
            <th field="state" width="25">状态</th>
            <th field="mail" width="35">申请人</th>
            <th field="req_time" width="35">提交时间</th>
            <th field="dealer" width="35">审批人</th>
            <th field="deal_time" width="35">审批时间</th>
            <th field="deal" width="20">操作</th>
            <th field="deal_reason" width="30">审批理由</th>
        </tr>
        </thead>
        <tbody id="mainBody">

        </tbody>
    </table>
    <form id="deal-ff" style="float: left">
        <table>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>状态 :</td>
                <td><select class="easyui-combobox" panelHeight="auto" value="" name="app-state">
                        <option value="">不限</option>
                        <option value="待审批">待审批</option>
                        <option value="已通过">已通过</option>
                        <option value="已撤回">已撤回</option>
                    </select></td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>申请类型 :</td>
                <td><select class="easyui-combobox" panelHeight="auto" value="" name="app-type">
                        <option value="">不限</option>
                        <option value="存储资源">存储资源</option>
                        <option value="计算资源">计算资源</option>
                    </select></td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td><input type="button" value="查询" id="deal-query-button"></td>
            </tr>
        </table>
    </form>
</div>
<!--资源变更记录-->
<div id="res-change" class="right-child">
    <div class="easyui-panel" title="存储资源变更记录" style="width:818px;height:366px;padding:10px;">
        <div class="easyui-layout" data-options="fit:true">
            <div data-options="region:'west',split:true" style="width:150px;padding:10px">
                <ul id="storage-left-tt" class="easyui-tree"></ul>
                <input id="add-dir-btn" type="button" value="添加目录">
            </div>
            <div data-options="region:'center'" style="padding:10px">
                <table id="storage-record-edg" fitColumns="true" title="存储资源变更记录"
                       singleSelect="true" toolbar="#edit-toolbar"
                       style="width: 600px;height: 286px">
                </table>
            </div>
        </div>
    </div>

    <div id="edit-toolbar" style="display: none">
        <a id="add-change" href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add"
           plain="true" onclick="javascript:$('#storage-record-edg').edatagrid('addRow')">New</a>
        <a id="remove-change" href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove"
           plain="true" onclick="javascript:$('#storage-record-edg').edatagrid('destroyRow')">Delete</a>
        <a id="save-change" href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-save"
           plain="true" onclick="javascript:$('#storage-record-edg').edatagrid('saveRow')">Save</a>
        <a id="cancel-change" href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-undo"
           plain="true" onclick="javascript:$('#storage-record-edg').edatagrid('cancelRow')">Cancel</a>
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
<div style="position:fixed; z-index:100;right:0;bottom:25px;">
    <img src="image/ds.gif">
</div>
<?php include_once("footer.html") ?>
<script type="text/javascript">
    function resetQueryForm() {
        $("#ff").form("reset");
    }
    function resetStorageForm() {
        $("#storage-form").form("reset");
    }
    function resetCalculateForm() {
        $("#calculate-form").form("reset");
    }
</script>
</body>
</html>