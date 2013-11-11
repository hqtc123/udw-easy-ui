<?php
/**
 * Created by JetBrains PhpStorm.
 * User: heqing02
 * Date: 13-11-11
 * Time: 下午4:25
 * To change this template use File | Settings | File Templates.
 */

class Request {
    private $id;
    private $type;
    private $reqNum;
    private $reqStr;
    private $cluster;
    private $reason;
    private $state;

    function __construct($id, $cluster, $reason, $reqNum, $reqStr, $state, $type) {
        $this->cluster = $cluster;
        $this->id = $id;
        $this->reason = $reason;
        $this->reqNum = $reqNum;
        $this->reqStr = $reqStr;
        $this->state = $state;
        $this->type = $type;
    }

    /**
     * @param mixed $reason
     */
    public function setReason($reason) {
        $this->reason = $reason;
    }

    /**
     * @return mixed
     */
    public function getReason() {
        return $this->reason;
    }

    /**
     * @param mixed $state
     */
    public function setState($state) {
        $this->state = $state;
    }

    /**
     * @return mixed
     */
    public function getState() {
        return $this->state;
    }

    /**
     * @param mixed $cluster
     */
    public function setCluster($cluster) {
        $this->cluster = $cluster;
    }

    /**
     * @return mixed
     */
    public function getCluster() {
        return $this->cluster;
    }

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param mixed $reqNum
     */
    public function setReqNum($reqNum) {
        $this->reqNum = $reqNum;
    }

    /**
     * @return mixed
     */
    public function getReqNum() {
        return $this->reqNum;
    }

    /**
     * @param mixed $reqStr
     */
    public function setReqStr($reqStr) {
        $this->reqStr = $reqStr;
    }

    /**
     * @return mixed
     */
    public function getReqStr() {
        return $this->reqStr;
    }

    /**
     * @param mixed $type
     */
    public function setType($type) {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getType() {
        return $this->type;
    }


    public function makeInsertSql() {
        return "insert into request (type, req_num,req_str,cluster,reason,state) values ('" . $this->type
        . "','" . $this->reqNum . "','" . $this->reqStr . "','" . $this->cluster . "','" . $this->reason
        . "','" . $this->state . "')";
    }

    public function makeUpdateSql() {
        return "update request set type='" . $this->type . "', req_num='" . $this->reqNum . "',req_str='" . $this->reqStr
        . "',cluster,reason,state) where ('" . $this->type
        . "','" . $this->reqNum . "','" . $this->reqStr . "','" . $this->cluster . "','" . $this->reason
        . "','" . $this->state . "')";
    }
}