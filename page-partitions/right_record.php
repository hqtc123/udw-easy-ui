<?php
/**
 * Created by JetBrains PhpStorm.
 * User: heqing02
 * Date: 14-2-27
 * Time: 下午4:40
 * To change this template use File | Settings | File Templates.
 */
?>
<!--资源变更记录-->
<div id="record-div" class="right-child pd20 left">
    <!--    //存储资源变更记录-->
    <div class="easyui-panel" title="存储资源变更记录" style="width:1018px;height:456px;padding:10px;margin-bottom: 20px">
        <div class="easyui-layout" data-options="fit:true">
            <div title="集群-存储目录" data-options="region:'west',split:true" style="width:250px;padding:10px">
                <ul id="storage-left-tt" class="easyui-tree"></ul>
                <a id="add-dir-btn" class="btn btn-primary">添加目录</a>
            </div>
            <div data-options="region:'center'" style="padding:10px">
                <table id="storage-record-edg" fitColumns="true" title="存储资源变更记录"
                       singleSelect="true" toolbar="#edit-toolbar" rownumbers="true"
                       style="width: 786px;height: 366px">
                </table>
            </div>
        </div>
    </div>
    <div id="edit-toolbar" style="display: none">
        <a id="add-change" href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add"
           plain="true" onclick="javascript:$('#storage-record-edg').edatagrid('addRow',0)">New</a>
        <a id="remove-change" href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove"
           plain="true" onclick="deleteStorageRow()">Delete</a>
        <a id="save-change" href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-save"
           plain="true" onclick="saveStorageRow()">Save</a>
        <a id="cancel-change" href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-undo"
           plain="true" onclick="javascript:$('#storage-record-edg').edatagrid('cancelRow')">Cancel</a>
    </div>

    <!--    计算资源变更记录-->
    <div class="easyui-panel" title="计算资源变更记录" style="width:1018px;height:456px;padding:10px;">
        <div class="easyui-layout" data-options="fit:true">
            <div title="集群-队列" data-options="region:'west',split:true" style="width:250px;padding:10px">
                <ul id="calculate-left-tt" class="easyui-tree"></ul>
                <a id="add-queue-btn" class="btn btn-primary">添加队列</a>
            </div>
            <div data-options="region:'center'" style="padding:10px">
                <table id="calculate-record-edg" fitColumns="true" title="计算资源变更记录"
                       singleSelect="true" toolbar="#edit-toolbar-cal" rownumbers="true"
                       style="width: 786px;height: 366px">
                </table>
            </div>
        </div>
    </div>
    <div id="edit-toolbar-cal" style="display: none">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add"
           plain="true" onclick="javascript:$('#calculate-record-edg').edatagrid('addRow',0)">New</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove"
           plain="true" onclick="deleteCalculateRow()">Delete</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-save"
           plain="true" onclick="saveCalculateRow()">Save</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-undo"
           plain="true" onclick="javascript:$('#storage-calculate-edg').edatagrid('cancelRow')">Cancel</a>
    </div>

</div>