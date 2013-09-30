<?php
require_once("Db.php");
$db = Db::getInstance();
$db->createCon();
$sql = 'select input.dagname,input.logname,input.log_type,input.log_path,output.output_table,output.table_type,output.table_path from input_config input inner join output_config output on input.dagname=output.dagname;';
$rs = $db->query($sql);
$result = array();

while ($row = mysql_fetch_object($rs)) {
    array_push($result, $row);
}

echo json_encode($result);
$db->close();
	