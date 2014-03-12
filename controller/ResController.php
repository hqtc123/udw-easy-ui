<?php
/**
 * Created by JetBrains PhpStorm.
 * User: heqing02
 * Date: 13-11-12
 * Time: 上午10:05
 * To change this template use File | Settings | File Templates.
 */
require_once("../model/db/Db.php");
require_once("../model/ResApply.php");
class ResController {
    private $db;
    private $resApply;

    function __construct() {
        $this->db = Db::getInstance();
        $this->db->connectUdwUi();
    }

    /**
     * @param mixed $resApply
     */
    public function setResApply($resApply) {
        $this->resApply = $resApply;
    }

    /**
     * @return mixed
     */
    public function getResApply() {
        return $this->resApply;
    }

    public function addResApply() {
        return $this->db->query($this->resApply->makeInsertSql());
//        return $this->resApply->makeInsertSql();
    }

    public function updateResApply($state, $dealReason, $dealer, $id) {
        $sql = "update res_apply set state='" . $state . "',deal_reason='" . $dealReason . "',dealer='" . $dealer . "',deal_time=now() where id='" . $id . "'";
        $this->db->query($sql);
    }

    public function queryAllResApply($type, $state, $offset, $rows) {
        return $this->db->query("select * from res_apply where type like '%" . $type . "%' and state like '%" . $state . "%' order by id desc limit " . $offset . "," . $rows . ";");
    }

    public function queryApplyById($id) {

        return $this->db->query("select * from res_apply where id ='" . $id . "'");
    }

    public function closeDb() {
        $this->db->close();
    }

    public function queryCount($type, $state) {
        return $this->db->query("select count(*) from res_apply where type like '%" . $type . "%' and state like '%" . $state . "%'");
    }
}