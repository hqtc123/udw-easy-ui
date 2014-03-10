<?php
/**
 * Created by JetBrains PhpStorm.
 * User: heqing02
 * Date: 13-10-24
 * Time: 下午2:57
 * To change this template use File | Settings | File Templates.
 */
require_once("../model/db/Db.php");
$db = Db::getInstance();
$db->connectUdwUi();
if ($_GET["action"] == "pie") {
    $sql = "select distinct date from product_table order by date desc limit 1";
    $dateRs = $db->query($sql);
    $row = mysql_fetch_row($dateRs);
    $date = $row[0];

    $sql = "select sum(size),product from product_table  where date='" . $date . "'  group by product order by sum(size) desc;";
    $rs = $db->query($sql);
    $result = array();
    while ($row = mysql_fetch_row($rs)) {
        array_push($result, $row);
    }
    $newResult = array();
    for ($i = 0; $i < 8; $i++) {
        $newResult[$i] = $result[$i];
    }
    $otherSize = 0;
    for ($i = 8; $i < count($result); $i++) {
        $otherSize += $result[$i][0];
    }
    $arr[0] = $otherSize;
    $arr[1] = "其它";
    array_push($newResult, $arr);
    echo json_encode($newResult);
} elseif ($_GET["action"] == "size") {
    $sql = "select distinct date from product_table order by date desc limit 1";
    $dateRs = $db->query($sql);
    $row = mysql_fetch_row($dateRs);
    $date = $row[0];

    $sql = "select sum(size),product from product_table where date='" . $date . "' group by product order by product desc;";
    $rs = $db->query($sql);
    $result = array();
    while ($row = mysql_fetch_row($rs)) {
        $newRow = array();
        $newRow["trend"] = '<a href="product_size.php?product=' . $row[1] . '" target="_blank">趋势</a>';
        $newRow["product"] = $row[1];
        $newRow["size"] = $row[0];
        $newRow["date"] = $date;
        array_push($result, $newRow);
    }
    $resultArr["rows"] = $result;
    $resultArr["total"] = 32;
    echo json_encode($resultArr);
} elseif ($_GET["action"] == "per") {
    $productName = $_GET["product"];
    $rows = array();
    $dateRs = $db->query('select DISTINCT date FROM product_table  ORDER BY date desc limit 36 ');
    while ($dateRow = mysql_fetch_row($dateRs)) {
        $newRow["date"] = $dateRow[0];
        $outSize = 0;
        $inSize = 0;
        $sizeRs = $db->query('select sum(size) from product_table where product="' . $productName . '" and date="' . $dateRow[0] . '";');
        $sizeRow = mysql_fetch_row($sizeRs);
        $newRow["size"] = $sizeRow[0];
        array_push($rows, $newRow);
    }
    echo json_encode(array_reverse($rows));
}
$db->close();
exit();