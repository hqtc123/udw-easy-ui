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
if ($_GET["product"] == "all") {
    $productRs = $db->query("select DISTINCT product FROM product_bigtable UNION select  DISTINCT product FROM product_smalltable;");
    $result["total"] = 30;
    $rows = array();
    $newRow = array();
    while ($row = mysql_fetch_row($productRs)) {
        $newRow["product"] = $row[0];
        $tableRs = $db->query('SELECT DISTINCT tablename FROM product_bigtable where product ="' . $row[0] . '"
     UNION SELECT DISTINCT tablename FROM product_smalltable where product ="' . $row[0] . '";');
        $outSize = 0;
        $inSize = 0;
        while ($tableRow = mysql_fetch_row($tableRs)) {
            $pathRs = $db->query('SELECT distinct table_path FROM output_config WHERE output_table="' . $tableRow[0] . '"');
            $tableSize = 0;
            $date = "";
            while ($pathRow = mysql_fetch_row($pathRs)) {
                if ($sizeRs = $db->query('SELECT size,date FROM output_size WHERE storage_path LIKE "%' . $pathRow[0] . '%" ORDER BY date DESC LIMIT 1;')) {
                    $sizeRow = mysql_fetch_row($sizeRs);
                    if ($sizeRow[0] == null) {
                        continue;
                    }
                    $tableSize += floatval($sizeRow[0]);
                    $date = $sizeRow[1];
                    if ($date != null && $date != "") {
                        $newRow["outputDate"] = $date;
                    }
                }
            }
            $outSize += $tableSize;


            $tableSize = 0;
            $dagRs = $db->query('SELECT DISTINCT dagname FROM output_config WHERE output_table="' . $tableRow[0] . '"');
            while ($dagRow = mysql_fetch_row($dagRs)) {
                $dagSize = 0;
                $pathRs = $db->query('SELECT DISTINCT log_path FROM input_config WHERE dagname="' . $dagRow[0] . '"');
                $size = 0;
                $date = "";
                while ($pathRow = mysql_fetch_row($pathRs)) {
                    $sizeRs = $db->query('SELECT size,date FROM input_size WHERE storage_path LIKE "%' . $pathRow[0] . '%" ORDER BY date DESC LIMIT 1;');
                    $sizeRow = mysql_fetch_row($sizeRs);
                    $dagSize += $sizeRow[0];
                    $date = $sizeRow[1];
                    if ($date != null && $date != "") {
                        $newRow["inputDate"] = $date;
                    }
                }
                $tableSize += $dagSize;
            }
            $inSize += $tableSize;
        }
        $newRow["outputSize"] = $outSize;
        $newRow["inputSize"] = $inSize;
        $newRow["trend"] = '<a href="protrend.php?product=' . $newRow["product"] . '">趋势</a>';
        array_push($rows, $newRow);
//
    }

    $result["rows"] = $rows;
    echo json_encode($result);
}