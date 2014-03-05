<?php
/**
 * Created by JetBrains PhpStorm.
 * User: heqing02
 * Date: 14-2-27
 * Time: 下午4:19
 * To change this template use File | Settings | File Templates.
 */
?>
<div class="pd20 left right-child" id="summary-div">
    <div class="panel">
        <div class="panel-header">UDW 建设数据量</div>
        <div class="panel-main">
            <div id="total-content" class="alert alert-welcome">
                <div class="i-data" id="udw-size-data">UDW 建设数据量：<b></b> | 存储资源 Quota：<b></b> | 存储资源使用率：<b></b>
                </div>
            </div>
            <div id="index-total-graph" style="height:300px;">

            </div>
        </div>
    </div>
    <div class="panel mt20">
        <div class="panel-header">UDW 总体情况</div>
        <div class="panel-main">
            <div class="list-table">
                <table id="hq-summary-table" width="100%">
                    <tr>
                        <td><span class="before-span">DAG:任务数目</span><a id="dag-a" href="dag.php"></a><span
                                id="dag-span">（点击查看任务列表）</span></td>
                        <td><span class="before-span">LOG:日志数目</span><a id="log-a" href="log.php"></a><span
                                id="log-span">（点击查看日志列表）</span></td>
                        <td><span class="before-span">TABLE:表数目</span><a id="table-a" href="table.php"></a><span
                                id="table-span">（点击查看生成表列表）</span></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="panel mt20">
        <table id="table-date-dg" title="各表的建设时间" class="easyui-datagrid" style="height:350px;min-width:660px">
            <thead>
            <tr>
                <th field="product" width="160">产品线</th>
                <th field="tableName" width="300">表名</th>
                <th field="period" width="220">建设时间段</th>
                <th field="days" width="100">建设天数</th>
            </tr>
            </thead>
            <tbody id="mainBody">

            </tbody>

            <form id="ff">
                <table id="query-days-table">
                    <tr>
                        <td>产品线 :</td>
                        <td><select class="easyui-combobox select" value="" name="product">
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
                        <td><input class="easyui-validatebox input" type="text" name="table-name2"></td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td>建设天数 :</td>
                        <td><select class="easyui-combobox select" panelHeight="auto" value="" name="days">
                                <option value="days">不限</option>
                                <option value="days1">少于184天</option>
                                <option value="days2">184-365天</option>
                                <option value="days3">366-548</option>
                                <option value="days4">超过548天</option>
                            </select></td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td><input type="button" class="btn btn-primary" value="查询" id="index-query-button"></td>
                    </tr>
                </table>
            </form>
        </table>
    </div>
</div>