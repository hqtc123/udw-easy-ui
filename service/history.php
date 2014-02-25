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
function has_child($cluster) {
    $rs = mysql_query("select count(*) from storage_dir where cluster='" . $cluster . "'");
    $row = mysql_fetch_array($rs);
    return $row[0] > 0 ? true : false;
}

function has_queue_child($cluster) {
    $rs = mysql_query("select count(*) from calculate_queue where cluster='" . $cluster . "'");
    $row = mysql_fetch_array($rs);
    return $row[0] > 0 ? true : false;
}

$historyController = new HistoryController();
if ($action == "storage") {
    if ($task == "tree") {
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 1;
        if ($id == 1) {
            $result = array();
            $rs = $historyController->getAllCluster();
            while ($row = mysql_fetch_array($rs)) {
                $node = array();
                $node["id"] = $row["cluster"];
                $node["text"] = $row["cluster"];
                $node['state'] = has_child($row['cluster']) ? 'closed' : 'open';
                array_push($result, $node);
            }
            echo json_encode($result);
        } else {
            $result = array();
            $rs = mysql_query("select storage_dir from storage_dir where cluster='" . $id . "'");
            while ($row = mysql_fetch_array($rs)) {
                $node["id"] = $row["storage_dir"];
                $node["text"] = $row["storage_dir"];
                $node['state'] = has_child($row['storage_dir']) ? 'closed' : 'open';
                array_push($result, $node);
            }
            echo json_encode($result);
        }
    } elseif ($task == "add_dir") {
        $historyController->getStorageDir()->setDir($_REQUEST["storage_dir"]);
        $historyController->getStorageDir()->setCluster($_REQUEST["cluster"]);
        $rs = $historyController->addStorageDir();
        if ($rs == false) {
            $result["success"] = 0;
            echo json_encode($result);
        } else {
            $result["success"] = 1;
            echo json_encode($result);
        }
    }
} elseif ($action == "calculate") {
    if ($task == "tree") {
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 1;
        if ($id == 1) {
            $result = array();
            $rs = $db->query("select distinct(cluster) from calculate_queue order by cluster");
            while ($row = mysql_fetch_array($rs)) {
                $node = array();
                $node["id"] = $row["cluster"];
                $node["text"] = $row["cluster"];
                $node['state'] = has_queue_child($row['cluster']) ? 'closed' : 'open';
                array_push($result, $node);
            }
            echo json_encode($result);
        } else {
            $result = array();
            $rs = $db->query("select queue from calculate_queue where cluster='" . $id . "'");
            while ($row = mysql_fetch_array($rs)) {
                $node["id"] = $row["queue"];
                $node["text"] = $row["queue"];
                $node['state'] = has_queue_child($row['queue']) ? 'closed' : 'open';
                array_push($result, $node);
            }
            echo json_encode($result);
        }
    } elseif ($task == "add_queue") {
        $rs = $db->query("insert into calculate_queue(queue,cluster) values ('" . $_POST["queue"]
        . "','" . $_POST["cluster"] . " ')");
        if ($rs == false) {
            $result["success"] = 0;
            echo json_encode($result);
        } else {
            $result["success"] = 1;
            echo json_encode($result);
        }
    }
} elseif ($action == "change") {
    $cluster = $_GET["cluster"];
    if (isset($_GET["dir"])) {
        $dir = $_GET["dir"];
        if ($task == "all") {
            $total["tadd"] = 0;
            $total["tdel"] = 0;
            $allRs = $historyController->getAllChangesByDir($dir, $cluster);
            $result = array();
            while ($row = mysql_fetch_array($allRs)) {
                array_push($result, $row);
                $total["tadd"] += $row["tadd"];
                $total["tdel"] += $row["tdel"];
            }
            $total["date"] = "合计";
            array_push($result, $total);
            echo json_encode($result);
        } elseif ($task == "save") {
            $historyController->getStorageHistory()->setStorageDir($dir);
            $historyController->getStorageHistory()->setDate($_REQUEST["date"]);
            $historyController->getStorageHistory()->setAdd($_REQUEST["tadd"] == "" ? 0 : $_REQUEST["tadd"]);
            $historyController->getStorageHistory()->setDel($_REQUEST["tdel"] == "" ? 0 : $_REQUEST["tdel"]);
            $historyController->getStorageHistory()->setBefore($_REQUEST["tbefore"]);
            $historyController->getStorageHistory()->setAfter($_REQUEST["tafter"]);
            $historyController->getStorageHistory()->setRemark($_REQUEST["remark"]);
            $historyController->getStorageHistory()->setCluster($cluster);
            $rs = $historyController->addStorageHistory();
            if ($rs == false) {
                $json["success"] = 0;
                $json["error"] = "添加失败，一些值必须数字";
                echo json_encode($json);
            } else {
                $json["success"] = 1;
                echo json_encode($json);
            }
        } elseif ($task == "delete") {
            $historyController->deleteStorageHistory($_REQUEST["id"]);
        } elseif ($task == "update") {
            $historyController->updateStorageHistory($_REQUEST["id"], $_REQUEST["date"], $_REQUEST["tadd"],
                $_REQUEST["tdel"], $_REQUEST["tbefore"], $_REQUEST["tafter"], $_REQUEST["remark"]);
        }
    } else {
        $queue = $_GET["queue"];
        if ($task == "all") {
            $total["tadd"] = 0;
            $total["tdel"] = 0;
            $allRs = $historyController->getAllChangesByQueue($queue, $cluster);
            $result = array();
            while ($row = mysql_fetch_array($allRs)) {
                $total["tadd"] += $row["tadd"];
                $total["tdel"] += $row["tdel"];
                array_push($result, $row);
            }
            $total["date"] = "合计";
            array_push($result, $total);
            echo json_encode($result);
        } elseif ($task == "save") {
            $historyController->getCalculateHistory()->setQueue($queue);
            $historyController->getCalculateHistory()->setDate($_REQUEST["date"]);
            $historyController->getCalculateHistory()->setAdd($_REQUEST["tadd"] == "" ? 0 : $_REQUEST["tadd"]);
            $historyController->getCalculateHistory()->setDel($_REQUEST["tdel"] == "" ? 0 : $_REQUEST["tdel"]);
            $historyController->getCalculateHistory()->setBefore($_REQUEST["tbefore"]);
            $historyController->getCalculateHistory()->setAfter($_REQUEST["tafter"]);
            $historyController->getCalculateHistory()->setRemark($_REQUEST["remark"]);
            $historyController->getCalculateHistory()->setCluster($cluster);
            $rs = $historyController->addCalculateHistory();
            if ($rs == false) {
                $json["success"] = 0;
                $json["error"] = "添加失败，一些值必须数字";
                echo json_encode($json);
            } else {
                $json["success"] = 1;
                echo json_encode($json);
            }
        } elseif ($task == "delete") {
            $historyController->deleteCalculateHistory($_REQUEST["id"]);
        } elseif ($task == "update") {
            $historyController->updateCalculateHistory($_REQUEST["id"], $_REQUEST["date"], $_REQUEST["tadd"],
                $_REQUEST["tdel"], $_REQUEST["tbefore"], $_REQUEST["tafter"], $_REQUEST["remark"]);
        }
    }
}