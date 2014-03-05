<?php
/**
 * Created by JetBrains PhpStorm.
 * User: heqing02
 * Date: 14-2-27
 * Time: 下午4:29
 * To change this template use File | Settings | File Templates.
 */
?>
<!--任务流-->
<div id="task-div" class="pd20 left right-child">
    <div class="panel">
        <table id="dag-dg" title="DAG:任务执行列表" class="easyui-datagrid" style="height:500px">
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
        <div class="panel-main panel-gray">
            <form id="ff-task" method="post" class="form pd10">
                <table border="0" cellspacing="0" cellpadding="0" width="100%">
                    <tr>
                        <td width="20%" align="right">任务名 :</td>
                        <td width="80%" align="left">
                            <input class="easyui-validatebox" type="text" name="dag-name"/>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">日志名 :</td>
                        <td><input class="easyui-validatebox" type="text" name="log-name"/></td>
                    </tr>

                    <tr>
                        <td align="right">日志传输方式 :</td>
                        <td>
                            <select class="easyui-combobox" panelHeight="auto" name="trans-type">
                                <option value="">不限</option>
                                <option value="BIGPIPE">BIGPIPE</option>
                                <option value="LDM">LDM</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">日志路径 :</td>
                        <td><input class="easyui-validatebox" type="text" name="log-path"/></td>
                    </tr>
                    <tr>
                        <td align="right">表名称 :</td>
                        <td><input class="easyui-validatebox" type="text" name="table-name"/></td>
                    </tr>
                    <tr>
                        <td align="right">表类型 :</td>
                        <td>
                            <select class="easyui-combobox" panelHeight="auto" name="table-type">
                                <option value="">不限</option>
                                <option value="BIGTABLE">BIGTABLE</option>
                                <option value="SMALLTABLE">SMALLTABLE</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">表路径 :</td>
                        <td><input class="easyui-validatebox" type="text" name="table-path"/></td>
                    </tr>
                    <tr>
                        <td align="right">

                        </td>
                        <td align="left">
                            <a class="btn btn-primary btn-large" id="hq-query-button">查询</a>
                            <a class="btn btn-large" id="hq-reset-button" onclick="resetTaskForm()">重置</a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    function resetTaskForm() {
        $("#ff-task").form("reset");
    }
</script>