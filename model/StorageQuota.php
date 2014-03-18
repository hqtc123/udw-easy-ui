<?php
/**
 * Created by JetBrains PhpStorm.
 * User: heqing02
 * Date: 14-3-14
 * Time: 下午4:43
 * To change this template use File | Settings | File Templates.
 */

class StorageQuota {
    private $id;
    private $cluster;
    private $dir;
    private $service;
    private $quota;
    private $compressed_used;
    private $detect_date;

    function __construct($cluster, $compressed_used, $detect_date, $dir, $quota, $service) {
        $this->cluster = $cluster;
        $this->compressed_used = $compressed_used;
        $this->detect_date = $detect_date;
        $this->dir = $dir;
        $this->quota = $quota;
        $this->service = $service;
    }

    /**
     * @param mixed $cluster
     */
    public function setCluster($cluster) {
        $this->cluster = $cluster;
    }

    /**
     * @param mixed $service
     */
    public function setService($service) {
        $this->service = $service;
    }

    /**
     * @return mixed
     */
    public function getService() {
        return $this->service;
    }

    /**
     * @return mixed
     */
    public function getCluster() {
        return $this->cluster;
    }

    /**
     * @param mixed $compressed_used
     */
    public function setCompressedUsed($compressed_used) {
        $this->compressed_used = $compressed_used;
    }

    /**
     * @return mixed
     */
    public function getCompressedUsed() {
        return $this->compressed_used;
    }

    /**
     * @param mixed $detect_date
     */
    public function setDetectDate($detect_date) {
        $this->detect_date = $detect_date;
    }

    /**
     * @return mixed
     */
    public function getDetectDate() {
        return $this->detect_date;
    }

    /**
     * @param mixed $dir
     */
    public function setDir($dir) {
        $this->dir = $dir;
    }

    /**
     * @return mixed
     */
    public function getDir() {
        return $this->dir;
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
     * @param mixed $quota
     */
    public function setQuota($quota) {
        $this->quota = $quota;
    }

    /**
     * @return mixed
     */
    public function getQuota() {
        return $this->quota;
    }

    public function toArray() {
        $arr["id"] = $this->id;
        $arr["cluster"] = $this->cluster;
        $arr["dir"] = $this->dir;
        $arr["detect_date"] = $this->detect_date;
        $arr["compressed_used"] = $this->compressed_used;
        $arr["quota"] = $this->quota;
        return $arr;
    }
}