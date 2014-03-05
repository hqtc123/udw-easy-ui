<?php
/**
 * Created by JetBrains PhpStorm.
 * User: heqing02
 * Date: 14-2-27
 * Time: 下午4:37
 * To change this template use File | Settings | File Templates.
 */
?>
<!--资源预估-->
<div id="estimate-div" class="right-child pd20 left">
    <div id="res-estimate-panel" class="panel">
        <div class="panel-header">UDW 资源预估</div>
        <table id="hq-res-estimate-table" style="width:100%">
            <thead>
            <tr>
                <td id="per-day-td" style="width:66%">UDW压缩后平均每天数据量：
                    (<b>经过ohio、RAID后的大小是100TB/天</b>)
                </td>
            </tr>
            <tr>
                <td>输入天数：<input type="text" class="input-small" id="res-estimate-input">
                    <a id="res-estimate-btn" class="btn btn-primary btn-small">确定</a>
                </td>
                <td>预估大小：<label>待估</label></td>
            </tr>
            </thead>
        </table>
    </div>

    <div id="res-estimate-add-panel" class="panel mt20">
        <div class="panel-header">UDW 增量预估</div>
        <table id="res-estimate-add-table" style="width: 100%">
            <thead>
            <tr>
                <td id="per-day-add-td" style="width:66%">计算把所有表建设到指定天数还需要的存储量</td>
            </tr>
            <tr>
                <td>输入天数：<input type="text" id="res-estimate-add-input">
                    <a id="res-estimate-add-btn" class="btn btn-primary btn-small">确定<a>
                </td>
                <td>预估增加总量：<label>待估</label></td>
            </tr>
            </thead>
        </table>
    </div>

    <!--每个表预计时间-->
    <div class="panel mt20">
        <table id="table-estimate-dg" title="各表建设资源增量预估" class="easyui-datagrid" style="height:380px">
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
        </table>
        <div class="panel-main panel-gray">
            <form id="res-ff" class="form pd10">
                <table border="0" cellspacing="0" cellpadding="0" width="100%">
                    <tr>
                        <td style="width: 25%" align="right">产品线 :</td>
                        <td><select class="select-large" name="product2">
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
                        <td>表名 :</td>
                        <td><input class="input-large" type="text" name="table-name3"/></td>
                        <td><a class="btn btn-primary btn-large" id="res-query-button">Query</a></td>
                    </tr>
                </table>
            </form>
        </div>

    </div>
</div>