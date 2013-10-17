<?php
require_once("Db.php");
$db = Db::getInstance();
$db->createCon();
$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$offset = ($page - 1) * $rows;
if ($_GET["action"] == "task") {
    $sql = "select count(*) from input_config input inner join output_config output on input.dagname=output.dagname";
    $rs = $db->query($sql);
    $row = mysql_fetch_row($rs);
    $result["total"] = $row[0];


    $sql = 'select input.dagname,input.logname,input.log_type,input.log_path,output.output_table,output.table_type,output.table_path' .
        ' from input_config input inner join output_config output on input.dagname=output.dagname limit ' . $offset . ',' . $rows . ';';

    $rs = $db->query($sql);
    $resultRows = array();

    while ($row = mysql_fetch_object($rs)) {
        array_push($resultRows, $row);
    }
    $result["rows"] = $resultRows;
    echo json_encode($result);
} elseif ($_GET["action"] == "summary") {
    $rs = $db->query("select distinct date from udw_size order by date desc limit 1;");
    $row = mysql_fetch_row($rs);
    $date = $row[0];

    $rs = $db->query('select sum(size) from udw_size where date="' . $date . '";');
    $row = mysql_fetch_row($rs);
    $result["totalSize"] = $row[0];

    $rs = $db->query('select count(distinct dagname) from input_config;');
    $row = mysql_fetch_row($rs);
    $result["dagNum"] = $row[0];

    $rs = $db->query('select count(distinct log_path) from input_config;');
    $row = mysql_fetch_row($rs);
    $result["logNum"] = $row[0];

    $rs = $db->query('select count(distinct table_path) from output_config;');
    $row = mysql_fetch_row($rs);
    $result["tableNum"] = $row[0];

    $result["success"] = 1;
    echo json_encode($result);
} elseif ($_GET["action"] == "dag") {
    $sql = "select COUNT(DISTINCT dagname) FROM input_config;";
    $rs = $db->query($sql);
    $row = mysql_fetch_row($rs);
    $result["total"] = $row[0];

    $sql = 'select DISTINCT dagname FROM input_config limit ' . $offset . ',' . $rows . ';';

    $rs = $db->query($sql);
    $resultRows = array();

    while ($row = mysql_fetch_array($rs)) {
        $newRow["dagname"] = $row[0];
        $tableRs = $db->query('select output_table FROM output_config WHERE dagname="' . $row[0] . '"  LIMIT 1;');
        $tableRow = mysql_fetch_array($tableRs);
        $table = $tableRow[0];
        $productRs = $db->query('select product FROM product_bigtable WHERE tablename="' . $table . '" UNION select product FROM product_smalltable WHERE tablename="' . $table . '";');
        $productRow = mysql_fetch_array($productRs);
        $newRow["product"] = $productRow[0];
        array_push($resultRows, $newRow);
    }
    $result["rows"] = $resultRows;
    echo json_encode($result);
} elseif ($_GET["action"] == "log") {
    $sql = "select COUNT(DISTINCT log_path) FROM input_config;";
    $rs = $db->query($sql);
    $row = mysql_fetch_row($rs);
    $result["total"] = $row[0];

    $sql = 'select DISTINCT log_path FROM input_config limit ' . $offset . ',' . $rows . ';';

    $rs = $db->query($sql);
    $resultRows = array();

    while ($row = mysql_fetch_array($rs)) {
        $dagRs = $db->query('select dagname,logname,log_type,log_path FROM input_config WHERE log_path="' . $row[0] . '"  LIMIT 1;');
        $dagRow = mysql_fetch_array($dagRs);
        $newRow["logname"] = $dagRow[1];
        $newRow["logtype"] = $dagRow[2];
        $newRow["logpath"] = $dagRow[3];
        $tableRs = $db->query('select output_table FROM output_config WHERE dagname="' . $dagRow[0] . '"  LIMIT 1;');
        $tableRow = mysql_fetch_array($tableRs);
        $table = $tableRow[0];
        $productRs = $db->query('select product FROM product_bigtable WHERE tablename="' . $table . '" UNION select product FROM product_smalltable WHERE tablename="' . $table . '";');
        $productRow = mysql_fetch_array($productRs);
        $newRow["product"] = $productRow[0];
        array_push($resultRows, $newRow);
    }
    $result["rows"] = $resultRows;
    echo json_encode($result);
} elseif ($_GET["action"] == "table") {
    $sql = "select COUNT(DISTINCT table_path) FROM output_config;";
    $rs = $db->query($sql);
    $row = mysql_fetch_row($rs);
    $result["total"] = $row[0];

    $sql = 'select DISTINCT table_path FROM output_config limit ' . $offset . ',' . $rows . ';';

    $rs = $db->query($sql);
    $resultRows = array();

    while ($row = mysql_fetch_array($rs)) {
        $tableRs = $db->query('select output_table,table_type,table_path FROM output_config WHERE table_path="' . $row[0] . '"  LIMIT 1;');
        $tableRow = mysql_fetch_array($tableRs);
        $newRow["tablename"] = $tableRow[0];
        $newRow["tabletype"] = $tableRow[1];
        $newRow["tablepath"] = $tableRow[2];
        $productRs = $db->query('select product FROM product_bigtable WHERE tablename="' . $tableRow[0] . '" UNION select product FROM product_smalltable WHERE tablename="' . $tableRow[0] . '";');
        $productRow = mysql_fetch_array($productRs);
        $newRow["product"] = $productRow[0];
        array_push($resultRows, $newRow);
    }
    $result["rows"] = $resultRows;
    echo json_encode($result);
}
$db->close();
	