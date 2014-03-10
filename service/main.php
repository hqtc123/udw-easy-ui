<?php
require_once("../model/db/Db.php");
$db = Db::getInstance();
$db->connectUdwUi();
date_default_timezone_set("Asia/Shanghai");
$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$offset = ($page - 1) * $rows;
if ($_GET["action"] == "task") {
    $sql = "select count(*) from input_config input inner join output_config output on input.dagname=output.dagname";
    $rs = $db->query($sql);
    $row = mysql_fetch_row($rs);
    $result["success"] = true;
    $result["message"] = "OK";
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

    $result["success"] = true;
    $result["message"] = "OK";

    $rs = $db->query('select sum(size) from udw_size where date="' . $date . '";');
    $row = mysql_fetch_row($rs);
    $result["totalSize"] = $row[0];

    $rs = $db->query('select count(distinct dagname) from input_config;');
    $row = mysql_fetch_row($rs);
    $result["dagNum"] = $row[0];

    $rs = $db->query('select count(distinct log_path) from input_config;');
    $row = mysql_fetch_row($rs);
    $result["logNum"] = $row[0];
    $rs = $db->query('select count(distinct log_path) from input_config where log_type="BIGPIPE";');
    $row = mysql_fetch_row($rs);
    $result["logBigNum"] = $row[0];

    $rs = $db->query('select count(distinct table_path) from output_config;');
    $row = mysql_fetch_row($rs);
    $result["tableNum"] = $row[0];
    $rs = $db->query('select count(distinct table_path) from output_config where table_type="BIGTABLE";');
    $row = mysql_fetch_row($rs);
    $result["tableBigNum"] = $row[0];

    echo json_encode($result);
} elseif ($_GET["action"] == "dag") {
    $sql = "select COUNT(DISTINCT dagname) FROM input_config;";
    $rs = $db->query($sql);
    $row = mysql_fetch_row($rs);
    $result["success"] = true;
    $result["message"] = "OK";
    $result["total"] = $row[0];

    $sql = 'select DISTINCT dagname FROM input_config limit ' . $offset . ',' . $rows . ';';

    $rs = $db->query($sql);
    $resultRows = array();

    while ($row = mysql_fetch_array($rs)) {
        $newRow["product"] = "";
        $newRow["dagname"] = $row[0];
        $tableRs = $db->query('select output_table FROM output_config WHERE dagname="' . $row[0] . '";');
        while ($tableRow = mysql_fetch_array($tableRs)) {
            $table = $tableRow[0];
            $productRs = $db->query('select product FROM product_bigtable WHERE tablename="' . $table . '" UNION select product FROM product_smalltable WHERE tablename="' . $table . '";');
            $productRow = mysql_fetch_array($productRs);
            if ($productRow[0] != null)
                $newRow["product"] = $productRow[0];
        }
        array_push($resultRows, $newRow);
    }
    $result["rows"] = $resultRows;
    echo json_encode($result);
} elseif ($_GET["action"] == "log") {
    $sql = "select COUNT(DISTINCT log_path) FROM input_config;";
    $rs = $db->query($sql);
    $row = mysql_fetch_row($rs);
    $result["success"] = true;
    $result["message"] = "OK";
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
    $result["success"] = true;
    $result["message"] = "OK";
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
} elseif ($_GET["action"] == "table-date") {
    $days = isset($_GET["days"]) ? $_GET["days"] : "days";
    $product = isset($_GET["product"]) ? $_GET["product"] : "";
    $tableName = isset($_GET["table-name"]) ? $_GET["table-name"] : "";

    $sql = 'select distinct table_name from product_table;';
    $rs = $db->query($sql);
    $resultRows = array();

    $newRow = array();
    while ($row = mysql_fetch_array($rs)) {
        $newRow["tableName"] = $row[0];
        $newRs = $db->query("select * from product_table where table_name='" . $row[0] . "' order by date desc limit 1");
        $row2 = mysql_fetch_array($newRs);
        $newRow["product"] = $row2[1];
        $startDate = substr($row2[3], 0, 4) . "-" . substr($row2[3], 4, 2) . "-" . substr($row2[3], 6, 2);
        $endDate = substr($row2[4], 0, 4) . "-" . substr($row2[4], 4, 2) . "-" . substr($row2[4], 6, 2);
        $newRow["period"] = $row2[3] . "—" . $row2[4];
        $newRow["days"] = abs((strtotime($endDate) - strtotime($startDate)) / 3600 / 24);
        array_push($resultRows, $newRow);
    }
    $result1 = array();
    $result2 = array();
    $result3 = array();
    if ($days == "days") {
        $result1 = $resultRows;
    } elseif ($days == "days1") {
        for ($i = 0; $i < count($resultRows); $i++) {
            if ($resultRows[$i]["days"] < 184) {
                array_push($result1, $resultRows[$i]);
            }
        }
    } elseif ($days == "days2") {
        for ($i = 0; $i < count($resultRows); $i++) {
            if ($resultRows[$i]["days"] >= 184 && $resultRows[$i]["days"] <= 365) {
                array_push($result1, $resultRows[$i]);
            }
        }
    } elseif ($days == "days3") {
        for ($i = 0; $i < count($resultRows); $i++) {
            if ($resultRows[$i]["days"] > 365 && $resultRows[$i]["days"] <= 548) {
                array_push($result1, $resultRows[$i]);
            }
        }
    } else {
        for ($i = 0; $i < count($resultRows); $i++) {
            if ($resultRows[$i]["days"] > 548) {
                array_push($result1, $resultRows[$i]);
            }
        }
    }

    for ($i = 0; $i < count($result1); $i++) {
        if ($result1[$i]["product"] == null || $result1[$i]["product"] == "" || $result1[$i]["days"] == 0 || $result1[$i]["product"] == "globalps") {
            continue;
        }
        if (preg_match("%" . $product . "%", $result1[$i]["product"])) {
            array_push($result2, $result1[$i]);
        }
    }
    for ($i = 0; $i < count($result2); $i++) {
        if (preg_match("%" . $tableName . "%", $result2[$i]["tableName"])) {
            array_push($result3, $result2[$i]);
        }
    }
    $result["total"] = count($result3);
    $result["success"] = true;
    $result["message"] = "OK";
    $result["rows"] = array_slice($result3, $offset, $rows);
    echo json_encode($result);
} elseif ($_GET["action"] == "res-estimate") {
    $result = array();
    $perSize = 0;
    $rs = $db->query("select * from table_comp_size ");
    while ($row = mysql_fetch_array($rs)) {
        $perSize += $row[1] / $row[2];
    }
    echo $perSize;
} elseif ($_GET["action"] == "all-add-estimate") {
    $days = $_POST["days"];
    $sql = 'select distinct output_table from output_config;';
    $rs = $db->query($sql);
    $result = 0;
    while ($row = mysql_fetch_array($rs)) {
        $newRs = $db->query("select * from product_table where table_name='" . $row[0] . "' order by date desc limit 1");
        $row2 = mysql_fetch_array($newRs);
        $compRs = $db->query("select * from table_comp_size where table_name='" . $row[0] . "'");
        $rsRow = mysql_fetch_array($compRs);
        $perSize = 0;
        if ($rsRow[2] != null && $rsRow[2] != 0)
            $perSize = $rsRow[1] / $rsRow[2];
        $startDate = substr($row2[3], 0, 4) . "-" . substr($row2[3], 4, 2) . "-" . substr($row2[3], 6, 2);
        $endDate = substr($row2[4], 0, 4) . "-" . substr($row2[4], 4, 2) . "-" . substr($row2[4], 6, 2);
        $alreadyDays = abs((strtotime($endDate) - strtotime($startDate)) / 3600 / 24);
        if ($alreadyDays < $days && $perSize > 0) {
            $result += $perSize * ($days - $alreadyDays);
        }
    }
    echo $result;
} elseif ($_GET["action"] == "table-estimate") {
    $product = isset($_GET["product"]) ? $_GET["product"] : "";
    $tableName = isset($_GET["table-name"]) ? $_GET["table-name"] : "";

    $sql = 'select distinct output_table from output_config;';
    $rs = $db->query($sql);
    $resultRows = array();

    $toInject = 'var days=parseInt($(this).prev().val());
                var aDays=$(this).parent().parent().prev().prev().children("div").html();
                if(days>aDays){
                    var nowSize=$(this).parent().parent().next().children("div").html();
                    if(nowSize.trim()=="待计算"||nowSize.trim()=="输入合适天数"){
                        nowSize=0;
                    }
                    var perSize=parseFloat($(this).parent().parent().prev().children("div").html());
                    var size=perSize*(days-aDays);
                    $(this).parent().parent().next().children("div").html(size);
                    var totalR=$("span#total-result").html();
                    if(typeof(totalR)!="undefined"){
                        totalR-=nowSize;
                        totalR+=size;
                        $("span#total-result").html(totalR);
                    }
                }
                 else{
                    alert("一般认为，你输入的天数应该是数字（小数将取整），而且大于表的已建天数。")
                    $(this).parent().parent().next().children("div").html("输入合适天数")
                 }';
    $newRow = array();
    while ($row = mysql_fetch_array($rs)) {
        $newRow["tableName"] = $row[0];
        $newRs = $db->query("select * from product_table where table_name='" . $row[0] . "' order by date desc limit 1");
        $row2 = mysql_fetch_array($newRs);
        $newRow["product"] = $row2[1];
        $compRs = $db->query("select * from table_comp_size where table_name='" . $newRow["tableName"] . "'");
        $rsRow = mysql_fetch_array($compRs);
        if ($rsRow[2] != null && $rsRow[2] != 0)
            $newRow["per_size"] = $rsRow[1] / $rsRow[2];
        $startDate = substr($row2[3], 0, 4) . "-" . substr($row2[3], 4, 2) . "-" . substr($row2[3], 6, 2);
        $endDate = substr($row2[4], 0, 4) . "-" . substr($row2[4], 4, 2) . "-" . substr($row2[4], 6, 2);
        $newRow["already_days"] = abs((strtotime($endDate) - strtotime($startDate)) / 3600 / 24);
        $newRow["input"] = "输入天数：<input type='text' class='input-small' style='width: 80px'><a onclick='" . $toInject . "' class='estimate-btn btn btn-primary btn-small'>确定</a>";
        $newRow["result"] = "待计算";
        array_push($resultRows, $newRow);
    }
    $result2 = array();
    $result3 = array();

    for ($i = 0; $i < count($resultRows); $i++) {
        if ($resultRows[$i]["product"] == null || $resultRows[$i]["product"] == "" || $resultRows[$i]["already_days"] == 0) {
            continue;
        }
        if ($product == "") {
            $result2 = $resultRows;
        } elseif ($product == $resultRows[$i]["product"]) {
            array_push($result2, $resultRows[$i]);
        }
    }
    for ($i = 0; $i < count($result2); $i++) {
        if (preg_match("%" . $tableName . "%", $result2[$i]["tableName"])) {
            array_push($result3, $result2[$i]);
        }
    }
    $result["total"] = count($result3);
    $pert = 0;
    for ($i = 0; $i < $result["total"]; $i++) {
        $pert += $result3[$i]["per_size"];
    }
    $pertRow["per_size"] = $pert;
    $pertRow["tableName"] = "总和：";
    $pertRow["result"] = "<span id='total-result'>0</span>";
    array_push($result3, $pertRow);
    $result["rows"] = array_slice($result3, $offset, $rows);
    echo json_encode($result);
}
$db->close();
exit();