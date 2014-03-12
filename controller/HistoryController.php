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
require_once("../model/CalculateQueue.php");
require_once("../model/CalculateHistory.php");
require_once("../model/db/Db.php");
class HistoryController {
    private $calculateQueue;
    private $calculateHistory;
    private $storageDir;
    private $storageHistory;
    private $db;

    function __construct() {
        $this->db = Db::getInstance();
        $this->db->connectUdwUi();
        $this->storageDir = new StorageDir();
        $this->storageHistory = new StorageHistory();
        $this->calculateQueue = new CalculateQueue();
        $this->calculateHistory = new CalculateHistory();
    }

    /**
     * @param \CalculateHistory $calculateHistory
     */
    public function setCalculateHistory($calculateHistory) {
        $this->calculateHistory = $calculateHistory;
    }

    /**
     * @return \CalculateHistory
     */
    public function getCalculateHistory() {
        return $this->calculateHistory;
    }

    /**
     * @param \CalculateQueue $calculateQueue
     */
    public function setCalculateQueue($calculateQueue) {
        $this->calculateQueue = $calculateQueue;
    }

    /**
     * @return \CalculateQueue
     */
    public function getCalculateQueue() {
        return $this->calculateQueue;
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
        return $this->db->query("insert into storage_history(storage_dir,date,tadd,tdel,tbefore,tafter,remark,cluster) values
        ('" . $this->storageHistory->getStorageDir() . "','" . $this->getStorageHistory()->getDate() . "',"
        . $this->getStorageHistory()->getAdd() . "," . $this->getStorageHistory()->getDel() . "," . $this->getStorageHistory()->getBefore()
        . "," . $this->getStorageHistory()->getAfter() . ",'" . $this->getStorageHistory()->getRemark() . "','" . $this->storageHistory->getCluster() . "')");
    }

    public function getAllDirs() {
        return $this->db->query("select * from storage_dir order by storage_dir");
    }

    public function getItemByDir($dir) {
        return $this->db->query("select * from storage_history where storage_dir='" . $dir . "' order by id desc");
    }

    public function getAllChangesByDir($dir, $cluster) {
        return $this->db->query("select * from storage_history where storage_dir='" . $dir . "' and cluster='" . $cluster . "' order by date desc");
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

    public function getAllChangesByQueue($queue, $cluster) {
        return $this->db->query("select * from calculate_history where queue='" . $queue . "' and cluster='" . $cluster . "' order by date desc");
    }

    public function addCalculateHistory() {
        echo "insert into calculate_history(queue,date,tadd,tdel,tbefore,tafter,remark,cluster) values
        ('" . $this->calculateHistory->getQueue() . "','" . $this->calculateHistory->getDate() . "',"
            . $this->calculateHistory->getAdd() . "," . $this->calculateHistory->getDel() . "," . $this->calculateHistory->getBefore()
            . "," . $this->calculateHistory->getAfter() . ",'" . $this->calculateHistory->getRemark() . "','" . $this->calculateHistory->getCluster() . "')";
        return $this->db->query("insert into calculate_history(queue,date,tadd,tdel,tbefore,tafter,remark,cluster) values
        ('" . $this->calculateHistory->getQueue() . "','" . $this->calculateHistory->getDate() . "',"
        . $this->calculateHistory->getAdd() . "," . $this->calculateHistory->getDel() . "," . $this->calculateHistory->getBefore()
        . "," . $this->calculateHistory->getAfter() . ",'" . $this->calculateHistory->getRemark() . "','" . $this->calculateHistory->getCluster() . "')");
    }

    public function deleteCalculateHistory($id) {
        return $this->db->query("delete from calculate_history where id=" . $id . ";");
    }

    public function updateCalculateHistory($id, $date, $tadd, $tdel, $tbefore, $tafter, $remark) {
        return $this->db->query("update calculate_history set date='" . $date . "',tadd=" . $tadd . ",tdel=" . $tdel
        . ",tbefore=" . $tbefore . ",tafter=" . $tafter . ",remark='" . $remark . "' where id=" . $id . ";");
    }
}