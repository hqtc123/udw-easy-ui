<?php
/**
 * Created by JetBrains PhpStorm.
 * User: heqing02
 * Date: 14-2-28
 * Time: 下午1:55
 * To change this template use File | Settings | File Templates.
 */
?>
<div id="total-div" class="pd20 left right-child">
    <div class="panel">
        <div class="panel-header">UDW数据建设量</div>
        <div id="total-graph" style="width:100%;height:300px;margin: 0 auto">

        </div>
    </div>
    <div class="panel mt20">
        <div class="panel-header">各产品线大小比例</div>
        <div id="hq-pie" style="width: 100%;height: 380px"></div>
    </div>
    <div class="panel mt20">
        <table id="product-size-dg" title="各个产品线大小" class="easyui-datagrid"
               style="height:360px;"
               pagination="false">
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
</div>