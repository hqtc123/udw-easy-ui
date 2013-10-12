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


$rows = array();

$n = 2;
$rows[0]["date"] = "20130924";
$rows[1]["date"] = "20130925";

$n2 = 0;
for ($i = 0; $i < $n; $i++) {
    $result2 = $db->query('select sum(size) from input_size where date=' . $rows[$i]["date"] . ';');
    while ($row = mysql_fetch_array($result2)) {
        $rows[$n2]["input"] = $row[0];
        $rows[$n2]["date"] = $rows[$i]["date"];
        $n2++;
    }
}

$n2 = 0;
for ($j = 0; $j < $n; $j++) {
    $result2 = $db->query('select sum(size) from output_size where date=' . $rows[$j]["date"] . ';');
    while ($row = mysql_fetch_array($result2)) {
        $rows[$n2]["output"] = $row[0];
        $rows[$n2]["date"] = $rows[$j]["date"];
        $n2++;
    }
}
echo json_encode($rows);
$db->close();



