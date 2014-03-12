<?php
/**
 * Created by JetBrains PhpStorm.
 * User: heqing02
 * Date: 14-3-10
 * Time: 下午3:09
 * To change this template use File | Settings | File Templates.
 */
require_once("AbstractController.php");
class InOutController extends AbstractController {
    function __construct() {
        parent::connectUdwUi();
    }

    public function actionTrend() {
        $result = $this->db->query('select DISTINCT date FROM input_size UNION select DISTINCT date FROM output_size ORDER BY date desc limit 60');
        $rows = array();
        $n = 0;
        while ($row = mysql_fetch_array($result)) {
            if ($row[0] == "" || $row[0] == null) {
                continue;
            }
            $rows[$n]["date"] = $row[0];
            $n++;
        }

        $n2 = 0;
        for ($i = 0; $i < $n; $i++) {
            $result2 = $this->db->query('select sum(size) from input_size where date="' . $rows[$i]["date"] . '";');
            while ($row = mysql_fetch_array($result2)) {
                $rows[$n2]["input"] = $row[0];
                $rows[$n2]["date"] = $rows[$i]["date"];
                $n2++;
            }
        }

        $n2 = 0;
        for ($j = 0; $j < $n; $j++) {
            $result2 = $db->query('select sum(size) from output_size where date="' . $rows[$j]["date"] . '";');
            while ($row = mysql_fetch_array($result2)) {
                if ($row[0] == "" || $row[0] == null) {
                    $n2++;
                    continue;
                }
//            //temp hide
//            if ($rows[$j]["date"] == "20131121" || $rows[$j]["date"] == "20131122" || $rows[$j]["date"] == "20131123")
//                continue;

                $rows[$n2]["output"] = $row[0];
                $rows[$n2]["date"] = $rows[$j]["date"];
                $n2++;
            }
        }
        echo json_encode(array_reverse($rows));
    }

    public function actionAllProducts() {

    }
}