<?php
/**
 * Created by JetBrains PhpStorm.
 * User: heqing02
 * Date: 13-10-23
 * Time: 下午4:22
 * To change this template use File | Settings | File Templates.
 */
include_once("Db.php");
$db = Db::getInstance();
$db->createCon();

//$sql = 'select * from product_smalltable';

//$sql = 'select * from product_bigtable';
//$rs = $db->query($sql);
//
//while ($row = mysql_fetch_row($rs)) {
//
//    $sql = "insert into product_table values ('" . $row[0] . "','" . $row[1] . "','BIGTABLE','','')";
//    echo $sql . "<br>";
//    $db->query($sql);
//}
//
//
//$sql = 'select * from product_smalltable';
//$rs = $db->query($sql);
//
//while ($row = mysql_fetch_row($rs)) {
//    $sql = "insert into product_table values ('" . $row[0] . "','" . $row[1] . "','SMALLTABLE','','')";
//    echo $sql . "<br>";
//    $db->query($sql);
//}