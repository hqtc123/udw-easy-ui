<?php
/**
 * Created by JetBrains PhpStorm.
 * User: heqing02
 * Date: 13-11-19
 * Time: 上午10:24
 * To change this template use File | Settings | File Templates.
 */
require_once("Db.php");
require_once("../controller/HistoryController.php");
$db = Db::getInstance();
$db->createCon();

$action = $_GET["action"];
$task = $_GET["task"];

$historyController = new HistoryController();
if ($action == "storage") {
    if ($task == "add_dir") {
        $dir = $_POST["dir"];
        $size = $_POST["size"];
        $historyController->getStorageDir()->setDir($dir);
        $historyController->getStorageDir()->setSize($size);
        $historyController->getStorageDir()->setCluster($_POST["cluster"]);
        $rs = $historyController->addStorageDir();
        if ($rs == false) {
            $json["success"] = 0;
            echo json_encode($json);
        } else {
            $json["success"] = 1;
            echo json_encode($json);
        }
    } else {
        $add = $_POST["add"] == "" ? 0 : $_POST["add"];
        $del = $_POST["del"] == "" ? 0 : $_POST["del"];
        $sizeRs = $historyController->getSizeByDir($_POST["dir"]);
        $sizeRow = mysql_fetch_array($sizeRs);
        if ($sizeRow["size"] == null) {
            $result["success"] = 0;
            $result["error"] = "此目录没有找到。";
            echo json_encode($result);
            return;
        }
        $historyController->getStorageHistory()->setStorageDir($_POST["dir"]);
        $historyController->getStorageHistory()->setDate($_POST["date"]);
        $historyController->getStorageHistory()->setAdd($add);
        $historyController->getStorageHistory()->setDel($del);
        $historyController->getStorageHistory()->setBefore($_POST["before"]);
        $historyController->getStorageHistory()->setAfter($_POST["after"]);
        $historyController->getStorageHistory()->setRemark($_POST["remark"]);

        $rs = $historyController->addStorageHistory();
        if ($rs == false) {
            $json["success"] = 0;
            $json["error"] = "添加失败，一些值必须数字";
            echo json_encode($json);
        } else {
            $historyController->updateSize($_POST["dir"], $_POST["after"]);
            $json["success"] = 1;
            echo json_encode($json);
        }
//        $historyController->getStorageHistory()->setBefore($sizeRow["size"]);
//        $after = $historyController->getStorageHistory()->getBefore() + $add - $del;
//        $historyController->getStorageHistory()->setAfter($after);
    }
}