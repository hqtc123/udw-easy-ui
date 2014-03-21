<?php
/**
 * Created by JetBrains PhpStorm.
 * User: heqing02
 * Date: 14-3-20
 * Time: 下午7:33
 * To change this template use File | Settings | File Templates.
 */
require_once("../model/StoreSize.php");
require_once("DAOInterface.php");
class StoreSizeDao implements DAOInterface {
    private $db;

    function __construct() {
        $this->db = Db::getInstance();
        $this->db->connectResource();
    }

    public function getAll() {
        $result = array();
        $rs = $this->db->query("select * from store_size");
        while ($arr = mysql_fetch_array($rs)) {
            $storeSize = new StoreSize($arr["cluster"], $arr["date"], $arr["name"], $arr["path"], $arr["product"], $arr["size"], $arr["system"]);
            $storeSize->setId($arr["id"]);
            array_push($result, $storeSize);
        }
        return $result;
    }
}