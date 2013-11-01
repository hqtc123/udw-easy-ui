<?php
/**
 * Created by JetBrains PhpStorm.
 * User: heqing02
 * Date: 13-9-30
 * Time: 下午5:00
 * To change this template use File | Settings | File Templates.
 */
$size = 0;
date_default_timezone_set("Asia/Shanghai");
$size += "5.16435e-06";
$size += "5.16435e-06";
$size += "5.16435e-06";
$size += "5.16435e-06";
$size += "5.16435e-06";
//$size += floatval("5.16435e-06");
//$size += floatval("5.16435e-06");
//$size += floatval("5.16435e-06");
//$size += floatval("5.16435e-06");
//$size += floatval("4.86337e-06");
$tomorrow     = date('Y-m-d',mktime (0,0,0,date("m"),date("d")-1,date("Y")));
echo $tomorrow;
