<?php
/**
 * Created by JetBrains PhpStorm.
 * User: heqing02
 * Date: 14-3-14
 * Time: 下午5:13
 * To change this template use File | Settings | File Templates.
 */
require_once("../model/StorageQuota.php");
require_once("DAOInterface.php");
class StorageQuotaDao implements DAOInterface {
    private $storageQuota;
    private $db;

    function __construct() {
        $this->db = Db::getInstance();
        $this->db->connectResource();
    }

    public function getAll() {
        $result = array();
        $rs = $this->db->query("select * from storage_quota");
        while ($arr = mysql_fetch_array($rs)) {
            $storageQuota = new StorageQuota($arr["cluster"], $arr["compressed_used"], $arr["detect_date"], $arr["dir"], $arr["quota"], $arr["service"]);
            $storageQuota->setId($arr["id"]);
            array_push($result, $storageQuota);
        }
        return $result;
    }

    public function getAllClusters() {
        $result = array();
        $rs = $this->db->query("select distinct cluster from storage_quota");
        while ($arr = mysql_fetch_array($rs)) {
            array_push($result, $arr["cluster"]);
        }
        return $result;
    }

    public function getNewByCluster($cluster) {
        $ret = array();
        $rs = $this->db->query("select * from storage_quota where cluster='" . $cluster . "';");
        while ($arr = mysql_fetch_array($rs)) {
            $storageQuota = new StorageQuota($arr["cluster"], $arr["compressed_used"], $arr["detect_date"], $arr["dir"], $arr["quota"], $arr["service"]);
            $storageQuota->setId($arr["id"]);
            $find = false;
            foreach ($ret as $key => $value) {
                if ($storageQuota->getDir() == $value->getDir()) {
                    $find = true;
                    if ($storageQuota->getId() > $value->getId()) {
                        $ret[$key] = $storageQuota;
                    }
                }
            }
            if (!$find)
                array_push($ret, $storageQuota);
        }
        return $ret;
    }

    public function getAllNew() {
        $ret = array();
        $rs = $this->db->query("select distinct cluster, dir from storage_quota");
        while ($arr = mysql_fetch_array($rs)) {
            $rs2 = $this->db->query("select * from storage_quota where cluster='" . $arr["cluster"] . "' and dir='" . $arr["dir"] . "' order
            by detect_date desc limit 1");
            while ($arr2 = mysql_fetch_array($rs2)) {
                $storageQuota = new StorageQuota($arr2["cluster"], $arr2["compressed_used"], $arr2["detect_date"], $arr2["dir"], $arr2["quota"], $arr2["service"]);
                $storageQuota->setId($arr2["id"]);
                array_push($ret, $storageQuota);
            }
        }
        return $ret;
    }
}