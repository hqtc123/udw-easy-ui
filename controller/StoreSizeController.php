<?php
/**
 * Created by JetBrains PhpStorm.
 * User: heqing02
 * Date: 14-3-10
 * Time: 上午11:20
 * To change this template use File | Settings | File Templates.
 */
require_once("../model/dao/StoreSizeDao.php");
require_once("../model/StoreSize.php");
class StoreSizeController {
    private $storeSizeDao;

    function __construct() {
        $this->storeSizeDao = new StoreSizeDao();
    }

    public function actionAll($params) {
        $data = array();
        $storeSizeList = $this->storeSizeDao->getAll();
        foreach ($storeSizeList as $storeSize) {
            array_push($data, $storeSize->toArray());
        }
        $ret["success"] = true;
        $ret["data"] = $data;
        echo json_encode($ret);
    }
}