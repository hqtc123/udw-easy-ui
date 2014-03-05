<?php
/**
 * Created by JetBrains PhpStorm.
 * User: heqing02
 * Date: 13-11-12
 * Time: 下午12:33
 * To change this template use File | Settings | File Templates.
 */
require_once("../controller/ResController.php");
require_once("../model/ResApply.php");
$action = isset($_GET["action"]) ? $_GET["action"] : "add";
if ($action == "add") {
    $type = $_REQUEST["type"];
    $cluster = $_REQUEST["cluster"];
    $reqStr = $_REQUEST["req_str"];
    $reqNum = $_REQUEST["req_num"];
    $reason = $_REQUEST["reason"];
    $email = $_REQUEST["mail"];

    $resApply = new ResApply($cluster, $reason, $reqNum, $reqStr, $type, $email);
    $resController = new ResController();
    $resController->setResApply($resApply);
    $resController->addResApply();
    $resController->closeDb();
    echo '1';
} elseif ($action == "all") {
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
    $offset = ($page - 1) * $rows;
    $resController = new ResController();
    $result = array();
    $type = isset($_GET["type"]) ? $_GET["type"] : "";
    $state = isset($_GET["state"]) ? $_GET["state"] : "";
    $countRs = $resController->queryCount($type, $state);
    $countRow = mysql_fetch_array($countRs);
    $result["total"] = $countRow[0];

    $rs = $resController->queryAllResApply($type, $state, $offset, $rows);

    $rows = array();
    while ($row = mysql_fetch_array($rs)) {
        $newRow["id"] = $row[0];
        $newRow["type"] = $row[1];
        $newRow["req_num"] = $row[2];
        $newRow["req_str"] = $row[3];
        $newRow["cluster"] = $row[4];
//        $newRow["reason"]=$row[5];
        $newRow["state"] = $row[6];
        $newRow["mail"] = $row[7];
        $newRow["req_time"] = $row[8];
        $newRow["dealer"] = $row[9];
        $newRow["deal_time"] = $row[10];
        if ($newRow["state"] == "待审批") {
            $newRow["deal"] = "<a href=\"deal.php?id=" . $row[0] . "\" target=\"_blank\">审批</a>";
        } else {
            $newRow["deal"] = "<a href=\"deal.php?id=" . $row[0] . "\" target=\"_blank\">查看</a>";
        }
        $newRow["deal_reason"] = $row[11];
        array_push($rows, $newRow);
    }

    $result["rows"] = $rows;
    echo json_encode($result);
} else if ($action == "deal") {
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $resController = new ResController();
        $rs = $resController->queryApplyById($id);
        $row = mysql_fetch_array($rs);
        $newRow["id"] = $row[0];
        $newRow["type"] = $row[1];
        $newRow["req_num"] = $row[2];
        $newRow["req_str"] = $row[3];
        $newRow["cluster"] = $row[4];
        $newRow["reason"] = $row[5];
        $newRow["state"] = $row[6];
        $newRow["mail"] = $row[7];
        $newRow["req_time"] = $row[8];
        $newRow["dealer"] = $row[9];
        $newRow["deal_time"] = $row[10];
        $newRow["deal_reason"] = $row[11];
        echo json_encode($newRow);
    } else {
        $id = $_POST["id"];
        $num = $_POST["num"];
        $dealer = $_POST["dealer"];
        $deal_reason = $_POST["deal_reason"];
        $resController = new ResController();
        $state = $num == 1 ? "已通过" : "已撤回";
        $resController->updateResApply($state, $deal_reason, $dealer, $id);
        $result["success"] = 1;
        echo json_encode($result);
    }
}