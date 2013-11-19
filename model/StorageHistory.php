<?php
/**
 * Created by JetBrains PhpStorm.
 * User: heqing02
 * Date: 13-11-19
 * Time: 上午10:26
 * To change this template use File | Settings | File Templates.
 */

class StorageHistory {
    private $id;
    private $storageDir;
    private $date;
    private $add;
    private $del;
    private $before;
    private $after;
    private $remark;

    function __construct() {
    }

    /**
     * @param mixed $add
     */
    public function setAdd($add) {
        $this->add = $add;
    }

    /**
     * @return mixed
     */
    public function getAdd() {
        return $this->add;
    }

    /**
     * @param mixed $after
     */
    public function setAfter($after) {
        $this->after = $after;
    }

    /**
     * @return mixed
     */
    public function getAfter() {
        return $this->after;
    }

    /**
     * @param mixed $before
     */
    public function setBefore($before) {
        $this->before = $before;
    }

    /**
     * @return mixed
     */
    public function getBefore() {
        return $this->before;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date) {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getDate() {
        return $this->date;
    }

    /**
     * @param mixed $del
     */
    public function setDel($del) {
        $this->del = $del;
    }

    /**
     * @return mixed
     */
    public function getDel() {
        return $this->del;
    }

    /**
     * @param mixed $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param mixed $remark
     */
    public function setRemark($remark) {
        $this->remark = $remark;
    }

    /**
     * @return mixed
     */
    public function getRemark() {
        return $this->remark;
    }

    /**
     * @param mixed $storageDir
     */
    public function setStorageDir($storageDir) {
        $this->storageDir = $storageDir;
    }

    /**
     * @return mixed
     */
    public function getStorageDir() {
        return $this->storageDir;
    }


}