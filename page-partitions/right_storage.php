<?php
/**
 * Created by JetBrains PhpStorm.
 * User: heqing02
 * Date: 14-3-17
 * Time: 下午1:58
 * To change this template use File | Settings | File Templates.
 */
?>
<div id="storage-div" class="pd20 left right-child">
    <div class="panel">
        <div class="list-table">
            <table id="storage-bill-table" style="width: 100%;" cellspacing="0" cellpadding="0" border="0">
                <thead>
                <tr>
                    <th>机房</th>
                    <th>集群</th>
                    <th>Quota (T)</th>
                    <th>used</th>
                    <th>使用比例</th>
                    <th>剩余</th>
                    <th>LOG</th>
                    <th>LOG36</th>
                    <th>LSP</th>
                    <th>UDW-Event</th>
                    <th>Data-Mart</th>
                    <th>Query Engine</th>
                    <th>数据应用（ERISED+UPDM+DORIS）</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
    <div class="panel mt20">
        <div class="panel-header">分目录详情</div>
        <div class="list-table">
            <table id="storage-detail-table" style="width: 100%;" cellspacing="0" cellpadding="0" border="0">
                <thead>
                <tr>
                    <th>集群</th>
                    <th>目录</th>
                    <th>Quota</th>
                    <th>used（压缩后）</th>
                    <th>使用比例</th>
                    <th>剩余</th>
                    <th>采集时间</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>