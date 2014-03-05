<?php
/**
 * Created by JetBrains PhpStorm.
 * User: heqing02
 * Date: 13-11-12
 * Time: 下午5:31
 * To change this template use File | Settings | File Templates.
 */
include_once('header.php');
?>
<link rel="stylesheet" type="text/css" href="css/list.css">
<script type="text/javascript" src="js/deal.js"></script>
<div class="layout_rightmain">
    <div class="inner">
        <label id="hide_id" style="display: none"><?php echo $_GET["id"]; ?></label>

        <div style="padding:10px 30px" id="big-div">
            <form id="detail-form" method="post">
                <table>
                    <tr>
                        <td style="display: none"><input type="text" name="type" value="计算资源"></td>
                        <td>申请资源类型 :</td>
                        <td><label id="type"></label></td>
                    </tr>
                    <tr>
                        <td style="display: none"><input type="text" name="type" value="计算资源"></td>
                        <td>集群 :</td>
                        <td><label id="cluster"></label></td>
                    </tr>
                    <tr>
                        <td id="str_td">队列 :</td>
                        <td><label id="req_str"></label></td>
                    </tr>

                    <tr>
                        <td id="num_td">槽位（个） :</td>
                        <td><label id="req_num"></label></td>
                    </tr>
                    <tr>
                        <td>
                            详细说明 :
                        </td>
                        <td><label id="reason"></label></textarea></td>
                    </tr>

                    <tr>
                        <td>申请人邮箱(前缀) :</td>
                        <td><label id="mail"></label></input></td>
                    </tr>
                    <tr>
                        <td>申请状态 :</td>
                        <td><label id="state"></label></input></td>
                    </tr>
                    <tr>
                        <td>申请时间 :</td>
                        <td><label id="req_time"></label></input></td>
                    </tr>
                    <tr class="deal">
                        <td>
                            <a id="pass-btn" class="btn btn-primary btn-large">审批通过</a>
                        </td>
                        <td>
                            <a id="no-pass-btn" class="btn btn-danger btn-large">审批撤回</a>
                        </td>
                    </tr>
                    <tr class="deal">
                        <td>审批理由 :</td>
                        <td><textarea id="deal_reason_area" style="resize: none;width: 260px"></textarea></td>
                    </tr>
                    <tr class="view">
                        <td>审批人 :</td>
                        <td><label id="dealer"></label></textarea></td>
                    </tr>
                    <tr class="view">
                        <td>审批理由 :</td>
                        <td><label id="deal_reason"></label></textarea></td>
                    </tr>
                    <tr class="view">
                        <td>审批时间 :</td>
                        <td><label id="deal_time"></label></textarea></td>
                    </tr>
                </table>
        </div>
    </div>
</div>
<?php include_once("footer.html"); ?>
</body>
</html>