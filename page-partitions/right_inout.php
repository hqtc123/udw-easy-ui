<?php
/**
 * Created by JetBrains PhpStorm.
 * User: heqing02
 * Date: 14-2-27
 * Time: 下午4:33
 * To change this template use File | Settings | File Templates.
 */
?>
<div id="inout-div" class="pd20 left right-child">
    <div class="panel">
        <div class="panel-header">每天总体输入输出趋势（未压缩）</div>
        <div id="inout-graph" style="height:360px;">

        </div>
    </div>
    <div class="panel mt20">
        <table id="product-dg" title="各个产品线输入输出" class="easyui-datagrid"
               style="max-width:1218px;height:399px;width: 100%"
               pagination="false"
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
</div>
