<?php
/**
 * Created by JetBrains PhpStorm.
 * User: heqing02
 * Date: 13-10-18
 * Time: 下午2:11
 * To change this template use File | Settings | File Templates.
 */
require_once("Db.php");
$db = Db::getInstance();
$db->createCon();
$productName = $_GET["product"];
/**
 * 各个产品线输入输出的表格
 */
if ($productName == "all") {
    $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'outputSize';
    //产品线总数目，暂时写死30
    $result["total"] = 30;
    $dateRs = $db->query('select DISTINCT date FROM output_size  ORDER BY date desc limit 1');
    $dateRow = mysql_fetch_row($dateRs);
    $date = $dateRow[0];

    $productRs = $db->query("select DISTINCT product FROM product_bigtable UNION select  DISTINCT product FROM product_smalltable;");
    $rows = array();
    $newRow = array();
    while ($row = mysql_fetch_row($productRs)) {
        $newRow["product"] = $row[0];
        $tableRs = $db->query('SELECT DISTINCT tablename FROM product_bigtable where product ="' . $row[0] . '"
     UNION SELECT DISTINCT tablename FROM product_smalltable where product ="' . $row[0] . '";');
        $outSize = 0;
        $inSize = 0;
        while ($tableRow = mysql_fetch_row($tableRs)) {
            $pathRs = $pathRs = $db->query('SELECT table_path FROM output_config WHERE output_table="' . $tableRow[0] . '"');
            $pathRow = mysql_fetch_row($pathRs);
            $sizeRs = $db->query('select size FROM output_size where date="' . $date . '" and
             storage_path like "%' . $pathRow[0] . '/%"');
            if ($sizeRow = mysql_fetch_row($sizeRs)) {
                if ($sizeRow[0] != null && $sizeRow[0] != "") {
                    $outSize += $sizeRow[0];
                }
            }
            $tableSize = 0;
            $dagRs = $db->query('SELECT DISTINCT dagname FROM output_config WHERE output_table="' . $tableRow[0] . '"');
            while ($dagRow = mysql_fetch_row($dagRs)) {
                $dagSize = 0;
                $pathRs = $db->query('SELECT DISTINCT log_path FROM input_config WHERE dagname="' . $dagRow[0] . '"');
                $size = 0;
                while ($pathRow = mysql_fetch_row($pathRs)) {
                    $sizeRs = $db->query('SELECT size FROM input_size WHERE storage_path LIKE "%' . $pathRow[0] . '/20%" and date="' . $date . '";');
                    $sizeRow = mysql_fetch_row($sizeRs);
                    if ($sizeRow[0] != null && $sizeRow[0] != "") {
                        $dagSize += $sizeRow[0];
                    }
                }
                $tableSize += $dagSize;
            }
            $inSize += $tableSize;
        }
        $newRow["outputSize"] = $outSize;
        $newRow["inputSize"] = $inSize;
        $newRow["outputDate"] = $date;
        $newRow["inputDate"] = $date;
        $newRow["trend"] = '<a class="cnm-class" href="protrend.php?product=' . $newRow["product"] . '" target="_blank">趋势</a>';
        if ($newRow["inputSize"] != 0 && $newRow["outputSize"] != 0)
            array_push($rows, $newRow);
    }
    if ($sort == "inputSize") {
        for ($i = 0; $i < count($rows) - 1; $i++) {
            for ($j = $i + 1; $j < count($rows); $j++) {
                if ($rows[$i]["inputSize"] < $rows[$j]["inputSize"]) {
                    $tmp = $rows[$i];
                    $rows[$i] = $rows[$j];
                    $rows[$j] = $tmp;
                }
            }
        }
    } else {
        for ($i = 0; $i < count($rows) - 1; $i++) {
            for ($j = $i + 1; $j < count($rows); $j++) {
                if ($rows[$i]["outputSize"] < $rows[$j]["outputSize"]) {
                    $tmp = $rows[$i];
                    $rows[$i] = $rows[$j];
                    $rows[$j] = $tmp;
                }
            }
        }
    }
    echo json_encode($rows);
} /**
 * 每个产品线输入输出的趋势折线图
 */
else {
    $rows = array();
    $dateRs = $db->query('select DISTINCT date FROM output_size  ORDER BY date');
    while ($dateRow = mysql_fetch_row($dateRs)) {
        $newRow["date"] = $dateRow[0];
        $outSize = 0;
        $inSize = 0;
        $tableRs = $db->query('SELECT DISTINCT tablename FROM product_bigtable where product ="' . $productName . '"
     UNION SELECT DISTINCT tablename FROM product_smalltable where product ="' . $productName . '";');
        while ($tableRow = mysql_fetch_row($tableRs)) {
            $pathRs = $pathRs = $db->query('SELECT table_path FROM output_config WHERE output_table="' . $tableRow[0] . '"');
            $pathRow = mysql_fetch_row($pathRs);
            $sizeRs = $db->query('select size FROM output_size where date="' . $dateRow[0] . '" and
             storage_path like "%' . $pathRow[0] . '/%"');
            if ($sizeRow = mysql_fetch_row($sizeRs)) {
                if ($sizeRow[0] != null && $sizeRow[0] != "") {
                    $outSize += $sizeRow[0];
                }
            }

            $dagRs = $db->query('SELECT DISTINCT dagname FROM output_config WHERE output_table="' . $tableRow[0] . '"');
            while ($dagRow = mysql_fetch_row($dagRs)) {
                $dagSize = 0;
                $pathRs = $db->query('SELECT DISTINCT log_path FROM input_config WHERE dagname="' . $dagRow[0] . '"');
                $size = 0;
                $date = "";
                while ($pathRow = mysql_fetch_row($pathRs)) {
                    $sizeRs = $db->query('SELECT size FROM input_size WHERE date="' . $dateRow[0] . '" and storage_path LIKE "%' . $pathRow[0] . '/20%";');
                    $sizeRow = mysql_fetch_row($sizeRs);
                    $dagSize += $sizeRow[0];
                    if ($date != null && $date != "") {
                        $newRow["inputDate"] = $date;
                    }
                }
                $inSize += $dagSize;
            }
        }
        $newRow["output"] = $outSize;
        $newRow["input"] = $inSize;
        array_push($rows, $newRow);
    }
    echo json_encode($rows);
}