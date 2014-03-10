<?php
require_once("Db.php");
$db = Db::getInstance();
$db->connectUdwUi();
$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$offset = ($page - 1) * $rows;

if (!isset($_GET["action"])) {
    $dagName = $_GET["dag-name"];
    $logName = $_GET["log-name"];
    $tableName = $_GET["table-name"];
    $transType = $_GET["trans-type"];
    $tableType = $_GET["table-type"];
    $tablePath = $_GET["table-path"];
    $logPath = $_GET["log-path"];

    $whereSuffix = ' where input.dagname like "%' . $dagName . '%" and input.logname like "%' . $logName . '%" and
  input.log_path like "%' . $logPath . '%" and
  output.output_table like "%' . $tableName . '%" and output.table_path like "%' . $tablePath . '%" and input.log_type like "%' . $transType . '%" and output.table_type like "%' . $tableType . '%" ';


    $sql = "select count(*) from input_config input inner join output_config output on input.dagname=output.dagname";

    $rs = $db->query($sql . $whereSuffix);

    $row = mysql_fetch_row($rs);
    $result["total"] = $row[0];


    $sql = 'select input.dagname,input.logname,input.log_type,input.log_path,output.output_table,output.table_type,output.table_path' .
        ' from input_config input inner join output_config output on input.dagname=output.dagname' . $whereSuffix . ' limit ' . $offset . ',' . $rows;

    $rs = $db->query($sql);
    $resultRows = array();

    while ($row = mysql_fetch_object($rs)) {
        array_push($resultRows, $row);
    }

    $result["rows"] = $resultRows;
    echo json_encode($result);
} elseif ($_GET["action"] == "log") {
    $logName = $_GET["log-name"];
    $product = $_GET["product"];

    $sql = "select COUNT(DISTINCT log_path) FROM input_config;";
    $rs = $db->query($sql);
    $row = mysql_fetch_row($rs);
    $result["total"] = $row[0];

    $sql = 'select DISTINCT log_path FROM input_config';

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
    $resultRow2 = array();
    for ($i = 0; $i < count($resultRows); $i++) {
        if (preg_match('*' . $logName . '*', $resultRows[$i]["logname"]) && preg_match('*' . $product . '*', $resultRows[$i]["product"])) {
            array_push($resultRow2, $resultRows[$i]);
        }
    }
    $result["total"] = count($resultRow2);
    $result["rows"] = array_slice($resultRow2, $offset, $rows);
    echo json_encode($result);
} elseif ($_GET["action"] == "table") {
    $tableName = $_GET["table-name"];
    $product = $_GET["product"];

    $sql = "select COUNT(DISTINCT table_path) FROM output_config;";
    $rs = $db->query($sql);
    $row = mysql_fetch_row($rs);
    $result["total"] = $row[0];

    $sql = 'select DISTINCT table_path FROM output_config;';

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

    $resultRow2 = array();
    for ($i = 0; $i < count($resultRows); $i++) {
        if (preg_match('*' . $tableName . '*', $resultRows[$i]["tablename"]) && preg_match('*' . $product . '*', $resultRows[$i]["product"])) {
            array_push($resultRow2, $resultRows[$i]);
        }
    }
    $result["total"] = count($resultRow2);
    $result["rows"] = array_slice($resultRow2, $offset, $rows);
    echo json_encode($result);
} elseif ($_GET["action"] == "dag") {
    $dagName = $_GET["dag-name"];
    $product = $_GET["product"];

    $sql = 'select DISTINCT dagname FROM input_config;';

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

    $resultRow2 = array();
    for ($i = 0; $i < count($resultRows); $i++) {
        if (preg_match('*' . $dagName . '*', $resultRows[$i]["dagname"]) && preg_match('*' . $product . '*', $resultRows[$i]["product"])) {
            array_push($resultRow2, $resultRows[$i]);
        }
    }
    $result["total"] = count($resultRow2);
    $result["rows"] = array_slice($resultRow2, $offset, $rows);
    echo json_encode($result);
}
$db->close();
	