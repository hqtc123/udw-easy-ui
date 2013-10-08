<?php
require_once("Db.php");
$db = Db::getInstance();
$db->createCon();

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$offset = ($page - 1) * $rows;

$sql = "select count(*) from input_config input inner join output_config output on input.dagname=output.dagname";
$rs = $db->query($sql);
$row = mysql_fetch_row($rs);
$result["total"] = $row[0];


$sql = 'select input.dagname,input.logname,input.log_type,input.log_path,output.output_table,output.table_type,output.table_path'.
 ' from input_config input inner join output_config output on input.dagname=output.dagname limit '. $offset.','.$rows.';';

$rs = $db->query($sql);
$resultRows = array();

while ($row = mysql_fetch_object($rs)) {
    array_push($resultRows, $row);
}

$result["rows"] = $resultRows;
echo json_encode($result);
$db->close();
	