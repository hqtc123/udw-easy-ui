<?php
/**
 * Created by JetBrains PhpStorm.
 * User: heqing02
 * Date: 14-3-10
 * Time: 下午3:26
 * To change this template use File | Settings | File Templates.
 */
require_once("../model/db/Db.php");
class AbstractController {
    var $db;

    function connectUdwUi() {
        $this->db = Db::getInstance();
        $this->db->connectUdwUi();
    }

    function connectStorageResource() {
        $this->db = Db::getInstance();
        $this->db->connectStorageResource();
    }

}