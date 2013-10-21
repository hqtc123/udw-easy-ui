<?php
require_once("Db.php");
$db = Db::getInstance();
$db->createCon();

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

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$offset = ($page - 1) * $rows;

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
$db->close();
	