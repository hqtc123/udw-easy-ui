<?php
/**
 * Created by JetBrains PhpStorm.
 * User: heqing02
 * Date: 13-9-29
 * Time: 下午5:51
 * To change this template use File | Settings | File Templates.
 */
require_once("Db.php");
$db = Db::getInstance();
$db->createCon();

$result = $db->query('select input_size,output_size,date from testtrend');

$rows = array();

$n = 0;

while ($row = mysql_fetch_array($result)) {
    $rows[$n] = array("date" => $row[2], "output" => $row[1], "input" => $row[0]);
    $n++;
}
echo json_encode($rows);

$db->close();



