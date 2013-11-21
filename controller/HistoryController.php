<?php
/**
 * Created by JetBrains PhpStorm.
 * User: heqing02
 * Date: 13-11-19
 * Time: 上午10:39
 * To change this template use File | Settings | File Templates.
 */
require_once("../model/StorageDir.php");
require_once("../model/StorageHistory.php");
class HistoryController {
    private $storageDir;
    private $storageHistory;
    private $db;

    function __construct() {
        $this->db = Db::getInstance();
        $this->db->createCon();
        $this->storageDir = new StorageDir();
        $this->storageHistory = new StorageHistory();
    }

    /**
     * @return \StorageHistory
     */
    public function getStorageHistory() {
        return $this->storageHistory;
    }

    /**
     * @return \StorageDir
     */
    public function getStorageDir() {
        return $this->storageDir;
    }

    public function addStorageDir() {
        return $this->db->query("insert into storage_dir(storage_dir,cluster) values
        ('" . $this->storageDir->getDir() . "','"
        . $this->getStorageDir()->getCluster() . "')");
    }

    public function addStorageHistory() {
        return $this->db->query("insert into storage_history(storage_dir,date,tadd,tdel,tbefore,tafter,remark) values
        ('" . $this->storageHistory->getStorageDir() . "','" . $this->getStorageHistory()->getDate() . "',"
        . $this->getStorageHistory()->getAdd() . "," . $this->getStorageHistory()->getDel() . "," . $this->getStorageHistory()->getBefore()
        . "," . $this->getStorageHistory()->getAfter() . ",'" . $this->getStorageHistory()->getRemark() . "')");
    }

    public function getSizeByDir($dir) {
        return $this->db->query("select size from storage_dir where storage_dir='" . $dir . "'");
    }

    public function updateSize($dir, $size) {
        return $this->db->query("update  storage_dir set size=" . $size . " where storage_dir='" . $dir . "'");
    }

    public function getAllDirs() {
        return $this->db->query("select * from storage_dir order by storage_dir");
    }

    public function getItemByDir($dir) {
        return $this->db->query("select * from storage_history where storage_dir='" . $dir . "' order by id desc");
    }

    public function deleteDir($dir) {
        return $this->db->query("delete from storage_dir where storage_dir='" . $dir . "'");
    }

    public function updateDir($oldDir, $newDir, $cluster) {
        return $this->db->query("update storage_dir set storage_dir='" . $newDir . "',cluster='" . $cluster . "' where storage_dir='" . $oldDir . "'");
    }

    public function getAllChangesByDir($dir) {
        return $this->db->query("select * from storage_history where storage_dir='" . $dir . "' order by id desc");
    }

    public function deleteStorageHistory($id) {
        return $this->db->query("delete from storage_history where id=" . $id . ";");
    }

    public function updateStorageHistory($id, $date, $tadd, $tdel, $tbefore, $tafter, $remark) {
        return $this->db->query("update storage_history set date='" . $date . "',tadd=" . $tadd . ",tdel=" . $tdel
        . ",tbefore=" . $tbefore . ",tafter=" . $tafter . ",remark='" . $remark . "' where id=" . $id . ";");
    }

    public function getAllCluster() {
        return $this->db->query("select distinct(cluster) from storage_dir");
    }
}