<?php
include_once("../model/db/Db.php");
$db = Db::getInstance();
$db->connectUdwUi();
date_default_timezone_set("Asia/Shanghai");
$req = isset($_GET["req"]) ? $_GET["req"] : "table";

if ($req == "table") {
    $result = array();
    $rows = array();
    $tableRs = $db->query("SELECT  * from datacloud_config;");
    $newRow = array();
    $total = 0;
    while ($row = mysql_fetch_row($tableRs)) {
        $newRow["name"] = $row[0];
        $sizeRs = $db->query("SELECT product,size FROM `product_table` WHERE table_name='" . $row[0] . "' order by date desc limit 1;");
        $sizeRow = mysql_fetch_row($sizeRs);
        $newRow["product"] = $sizeRow[0];
        $newRow["dataSize"] = floatval($row[2]);

        $newRow["firstPath"] = $row[1];
        $noahRs = $db->query("SELECT * FROM product_noahpath WHERE product='" . $newRow["product"] . "'");
        $noahRow = mysql_fetch_array($noahRs);
        $newRow["nodePath"] = $noahRow[1];
        $newRow["createTime"] = date('Y-m-d', mktime(0, 0, 0, date("m"), date("d") - 1, date("Y")));
        if ($newRow["firstPath"] == null) {
            continue;
        }
        $total += $newRow["dataSize"];
        array_push($rows, $newRow);
    }
    $sbRow["name"] = "udw-mart";
    $sbRow["product"] = "udw-mart";
    $sbRow["dataSize"] = 6000;
    $sbRow["firstPath"] = "/app/ns/udw/release/app";
    $sbRow["nodePath"] = "BAIDU_INF_ARCH_udw";
    $sbRow["createTime"] = date('Y-m-d', mktime(0, 0, 0, date("m"), date("d") - 1, date("Y")));
    array_push($rows, $sbRow);
    $sbRow["name"] = "udw-test";
    $sbRow["product"] = "udw-test";
    $sbRow["dataSize"] = 1200;
    $sbRow["firstPath"] = "/app/ns/udw/release/app";
    $sbRow["firstPath"] = "BAIDU_INF_ARCH_udw";
    $sbRow["createTime"] = date('Y-m-d', mktime(0, 0, 0, date("m"), date("d") - 1, date("Y")));
    array_push($rows, $sbRow);

    $result["success"] = true;
    $result["message"] = true;
//    $result["total"] = $total;
    $result["data"] = $rows;

    echo json_encode($result);
} elseif ($req == "product") {
    $result = array();
    $rows = array();
    $productRs = $db->query("select distinct product from product_table where date>=(select max(date) from product_table)");
    $newRow = array();
    $total = 0;
    while ($productRow = mysql_fetch_row($productRs)) {
        $newRow["user"] = $productRow[0];
        $dateRs = $db->query("SELECT date FROM product_table WHERE product='" . $productRow[0] . "' order by date desc limit 1;");
        $dateRow = mysql_fetch_row($dateRs);
        $sizeRs = $db->query("select sum(size) from product_table where date='" . $dateRow[0] . "' and product ='" . $productRow[0] . "' ");
        $sizeRow = mysql_fetch_row($sizeRs);
        $newRow["size"] = floatval($sizeRow[0]);
        $total += $newRow["size"];
        $noahRs = $db->query("SELECT * FROM product_noahpath WHERE product='" . $newRow["user"] . "'");
        $noahRow = mysql_fetch_array($noahRs);
        $newRow["product"] = $noahRow[1];
        $newRow["time"] = date('Y-m-d', mktime(0, 0, 0, date("m"), date("d") - 1, date("Y")));
        $newRow["cluster"] = "szwg-ecomon";
        array_push($rows, $newRow);
    }

    /**
     * 写死两个
     */
    $sbRow["user"] = "udw-mart";
    $sbRow["size"] = 6000;
    $sbRow["product"] = "BAIDU_INF_ARCH_udw";
    $sbRow["time"] = date('Y-m-d', mktime(0, 0, 0, date("m"), date("d") - 1, date("Y")));
    $sbRow["cluster"] = "szwg-ecomon";
    array_push($rows, $sbRow);
    $sbRow["user"] = "udw-test";
    $sbRow["size"] = 1200;
    $sbRow["cluster"] = "szwg-stoff";
    array_push($rows, $sbRow);

    $result["success"] = true;
    $result["message"] = true;
//    $result["total"] = $total + 7200;
    $result["data"] = $rows;
    echo json_encode($result);
} elseif ($req == "table_api") {
    $result = array();
    $rows = array();
    $tableRs = $db->query("SELECT distinct table_name from product_table;");
    $newRow = array();
    while ($tableRow = mysql_fetch_row($tableRs)) {
        $productRs = $db->query("SELECT product FROM product_table WHERE table_name='" . $tableRow[0] . "' limit 1");
        $productRow = mysql_fetch_array($productRs);
        $noahRs = $db->query("SELECT noahpath FROM product_noahpath WHERE product='" . $productRow[0] . "' limit 1");
        $noahRow = mysql_fetch_row($noahRs);
        $newRow["productPath"] = $noahRow[0];
        $newRow["subCategory"] = "USER_DATA";
        $newRow["clusterName"] = "szwg-ecomon";
        $newRow["dataName"] = $tableRow[0];
        $sizeRs = $db->query("select size,start_date,end_date from product_table where table_name='" . $tableRow[0] . "' order by end_date desc limit 1");
        $sizeRow = mysql_fetch_row($sizeRs);
        $newRow["dataSize"] = floatval($sizeRow[0]);
        $pathRs = $db->query("SELECT table_path FROM output_config WHERE output_table='" . $newRow["dataName"] . "'");
        $pathRow = mysql_fetch_array($pathRs);
        $newRow["sourcePath"] = $pathRow[0];

        if ($newRow["sourcePath"] == null) continue;

        $newRow["storageType"] = "COMPUTING_CLUSTER";
        $newRow["downloadType"] = "LOCAL";
        $newRow["transportMethod"] = "HADOOP";
//        $newRow["updateTime"] = $sizeRow[2];
        $newRow["updateTime"] = substr($sizeRow[2], 0, 4) . "-" . substr($sizeRow[2], 4, 2) . "-" . substr($sizeRow[2], 6, 2);
        $newRow["createTime"] = substr($sizeRow[1], 0, 4) . "-" . substr($sizeRow[1], 4, 2) . "-" . substr($sizeRow[1], 6, 2);
        array_push($rows, $newRow);
    }
    $result["success"] = true;
    $result["message"] = "ok";
    $result["data"] = $rows;
    echo json_encode($result);
} elseif ($req == "new-path") {
    $result = array();
//    $file = fopen("path.txt", "w");
    $newRow = array();
    $rs = $db->query("SELECT output_table,table_path FROM output_config group by output_table");
    while ($row = mysql_fetch_array($rs)) {
        $newRow["name"] = $row[0];
        $newRow["path"] = $row[1];
        $rs2 = $db->query("select path from table_comp_size where table_name like '%" . $row[0] . "%' limit 1");
        $row2 = mysql_fetch_array($rs2);
        $newRow["comp_path"] = $row2[0];
        if (strpos($newRow["name"], "event.") > 0) {
            $pathArr = explode("/", $newRow["path"]);
            $suffix = $pathArr[count($pathArr) - 1];
            if ($newRow["comp_path"] == null) {
                $smallRs = $db->query("select product from product_bigtable where tablename='" . $newRow["name"] . "' limit 1");
                $smallRow = mysql_fetch_array($smallRs);
                if ($smallRow == null) {
                    echo $newRow["path"]."<br>";
                    continue;
                } //没有产品线
                $newRow["comp_path"] = "/app/dt/udw/warehouse_compressed/" . $smallRow[0] . "/udw_event/" . $suffix . "/";
            }
            $pathArr = explode("/", $newRow["comp_path"]);
            $newRow["new_path"] = "/app/dt/udw/warehouse/" . $pathArr[5] . "/udw_event/" . $suffix;
        } else {
            if ($newRow["comp_path"] == null) {
                $smallRs = $db->query("select product from product_smalltable where tablename='" . $newRow["name"] . "' limit 1");
                $smallRow = mysql_fetch_array($smallRs);
                if ($smallRow == null) {
                    echo $newRow["path"]."<br>";
                    continue;
                } //没有产品线
                $newRow["comp_path"] = "/app/dt/udw/warehouse_compressed/" . $smallRow[0] . "/" . $newRow["name"] . "/";
            }
            $pathArr = explode("/", $newRow["comp_path"]);
            $newRow["new_path"] = "/app/dt/udw/warehouse/" . $pathArr[5] . "/" . $pathArr[6];
        }

//        echo fwrite($file, $newRow["path"] . "  " . $newRow["comp_path"] . "  " . $newRow["new_path"] . "\r\n");

        array_push($result, $newRow);
    }
//    fclose($file);
//    echo json_encode($result);
}