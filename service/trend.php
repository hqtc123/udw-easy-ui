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

$result = $db->query('select DISTINCT date FROM input_size UNION select DISTINCT date FROM output_size ORDER BY date');

$rows = array();

$n = 0;
while ($row = mysql_fetch_array($result)) {
    $rows[$n]["date"] = $row[0];
    $n++;
}

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
for ($i = 0; $i < $n; $i++) {
    $result2 = $db->query('select sum(size) from output_size where date=' . $rows[$i]["date"] . ';');
    while ($row = mysql_fetch_array($result2)) {
        $rows[$n2]["output"] = $row[0];
        $rows[$n2]["date"] = $rows[$i]["date"];
        $n2++;
    }
}
echo json_encode($rows);

$db->close();



