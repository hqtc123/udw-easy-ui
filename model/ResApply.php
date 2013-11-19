<?php
/**
 * Created by JetBrains PhpStorm.
 * User: heqing02
 * Date: 13-11-11
 * Time: 下午4:25
 * To change this template use File | Settings | File Templates.
 */

class ResApply {
    private $id;
    private $type;
    private $reqNum;
    private $reqStr;
    private $cluster;
    private $reason;
    private $state;
    private $mail;
    private $dealer;
    private $reqTime;
    private $dealTime;

    function __construct($cluster, $reason, $reqNum, $reqStr, $type, $mail) {
        $this->cluster = $cluster;
        $this->reason = $reason;
        $this->reqNum = $reqNum;
        $this->reqStr = $reqStr;
        $this->state = "待审批";
        $this->type = $type;
        $this->mail = $mail;
        $this->dealer = "-";
    }

    /**
     * @param mixed $dealTime
     */
    public function setDealTime($dealTime) {
        $this->dealTime = $dealTime;
    }

    /**
     * @return mixed
     */
    public function getDealTime() {
        return $this->dealTime;
    }

    /**
     * @param string $dealer
     */
    public function setDealer($dealer) {
        $this->dealer = $dealer;
    }

    /**
     * @return string
     */
    public function getDealer() {
        return $this->dealer;
    }

    /**
     * @param mixed $reqTime
     */
    public function setReqTime($reqTime) {
        $this->reqTime = $reqTime;
    }

    /**
     * @return mixed
     */
    public function getReqTime() {
        return $this->reqTime;
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

    /**
     * @param mixed $mail
     */
    public function setMail($mail) {
        $this->mail = $mail;
    }

    /**
     * @return mixed
     */
    public function getMail() {
        return $this->mail;
    }


    public function makeInsertSql() {
        return "insert into res_apply (type, req_num,req_str,cluster,reason,state,mail,req_time,dealer) values ('" . $this->type
        . "','" . $this->reqNum . "','" . $this->reqStr . "','" . $this->cluster . "','" . $this->reason
        . "','" . $this->state . "','" . $this->mail . "',now(),'" . $this->dealer . "')";
    }

}