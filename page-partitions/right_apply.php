<?php
/**
 * Created by JetBrains PhpStorm.
 * User: heqing02
 * Date: 14-2-27
 * Time: 下午4:39
 * To change this template use File | Settings | File Templates.
 */
?>
<!--资源申请部分-->
<div id="apply-div" class="right-child pd20 left">
    <div class="panel">
        <div class="panel-header">资源申请</div>
        <div class="easyui-tabs" style="height:450px;margin:0 10px">
            <div title="申请存储资源" style="padding:10px 30px">
                <form id="storage-form" method="post">
                    <table>
                        <tr>
                            <input name="type" style="display: none" type="text" value="存储资源"/>
                            <td style="width: 20%; text-align: right">集群 :</td>
                            <td style="width: 80%;text-align: left">
                                <input class="input" type="text" name="cluster"/>
                                <span>
                                    <i class="icon16 icon16-error"></i>
                                     请输入集群
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right">存储目录 :</td>
                            <td style="text-align: left">
                                <input class="input" type="text" name="req_str"/>
                                   <span>
                                    <i class="icon16 icon16-error"></i>
                                     请输入存储目录
                                    </span>
                            </td>
                        </tr>

                        <tr>
                            <td style="text-align: right">存储大小（T） :</td>
                            <td style="text-align: left">
                                <input class="input" type="text" name="req_num"/>
                                 <span>
                                    <i class="icon16 icon16-error"></i>
                                     请输入存储目录
                                 </span>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right">
                                详细说明 :多少份数据、每份数据多大;
                                每份数据需要存储多少天、说明原因。
                            </td>
                            <td style="text-align: left">
                                <textarea name="reason" style="resize: none"></textarea>
                                  <span>
                                    <i class="icon16 icon16-error"></i>
                                     请输入详细说明
                                 </span>
                            </td>
                        </tr>

                        <tr>
                            <td style="text-align: right">申请人邮箱(前缀) :</td>
                            <td style="text-align: left">
                                <input class="input" type="text" name="mail"/>
                                <span>
                                    <i class="icon16 icon16-error"></i>
                                    请输入邮箱前缀
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right">
                            </td>
                            <td style="text-align: left">
                                <a class="btn btn-primary btn-large" id="storage-btn">申请</a>
                                <a class="btn btn-large" onclick="resetStorageForm()">重置</a>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <div title="申请计算资源" style="padding:10px 30px">
                <form id="calculate-form" method="post">
                    <table>
                        <tr>
                            <input name="type" style="display: none" type="text" value="计算资源"/>
                            <td style="width: 20%; text-align: right">集群 :</td>
                            <td style="width: 80%;text-align: left">
                                <input class="input" type="text" name="cluster"/>
                                <span>
                                    <i class="icon16 icon16-error"></i>
                                     请输入集群
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right">计算队列 :</td>
                            <td style="text-align: left">
                                <input class="input" type="text" name="req_str"/>
                                   <span>
                                    <i class="icon16 icon16-error"></i>
                                     请输入计算队列
                                    </span>
                            </td>
                        </tr>

                        <tr>
                            <td style="text-align: right">槽位（个） :</td>
                            <td style="text-align: left">
                                <input class="input" type="text" name="req_num"/>
                                 <span>
                                    <i class="icon16 icon16-error"></i>
                                     请输入槽位个数
                                 </span>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right">
                                详细说明 :多少个任务、每个任务并发多少槽位、任务需要几点完成，说明原因。
                            </td>
                            <td style="text-align: left">
                                <textarea name="reason"
                                          style="resize: none"></textarea>
                                  <span>
                                    <i class="icon16 icon16-error"></i>
                                     请输入详细说明
                                 </span>
                            </td>
                        </tr>

                        <tr>
                            <td style="text-align: right">申请人邮箱(前缀) :</td>
                            <td style="text-align: left">
                                <input class="input" type="text" name="mail"/>
                                <span>
                                    <i class="icon16 icon16-error"></i>
                                    请输入邮箱前缀
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right">
                            </td>
                            <td style="text-align: left">
                                <a class="btn btn-primary btn-large" id="calculate-btn">申请</a>
                                <a class="btn btn-large" onclick="resetCalculateForm()">重置</a>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>

    <div class="panel mt20">
        <table id="apply-dg" title="资源申请列表" class="easyui-datagrid" style="height:388px;">
            <thead>
            <tr>
                <th field="id" width="15">编号</th>
                <th field="type" width="25">类型</th>
                <th field="cluster" width="30">集群</th>
                <th field="req_str" width="40">队列/存储目录</th>
                <th field="req_num" width="20">TB/槽位</th>
                <th field="state" width="25">状态</th>
                <th field="mail" width="25">申请人</th>
                <th field="req_time" width="35">提交时间</th>
                <th field="dealer" width="25">审批人</th>
                <th field="deal_time" width="35">审批时间</th>
                <th field="deal" width="20">操作</th>
                <th field="deal_reason" width="150">审批理由</th>
            </tr>
            </thead>
            <tbody id="mainBody">

            </tbody>
        </table>
        <form id="deal-ff" style="float: left">
            <table style="width: 100%">
                <tr>
                    <td style="width: 36%;text-align: right">状态 :</td>
                    <td>
                        <select class="select-large" panelHeight="auto" value="" name="app-state">
                            <option value="">不限</option>
                            <option value="待审批">待审批</option>
                            <option value="已通过">已通过</option>
                            <option value="已撤回">已撤回</option>
                        </select>
                    </td>
                    <td>申请类型 :</td>
                    <td>
                        <select class="select-large" panelHeight="auto" value="" name="app-type">
                            <option value="">不限</option>
                            <option value="存储资源">存储资源</option>
                            <option value="计算资源">计算资源</option>
                        </select>
                    </td>
                    <td>
                        <a class="btn btn-primary btn-large" id="deal-query-button">查询</a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<script>
    function resetStorageForm() {
        $("#storage-form").form("reset");
        $("#storage-form span").show();
    }
    function resetCalculateForm() {
        $("#calculate-form").form("reset");
        $("#calculate-form span").show();
    }
</script>