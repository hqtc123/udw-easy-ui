<?php
/**
 * Created by JetBrains PhpStorm.
 * User: heqing02
 * Date: 14-3-17
 * Time: 上午10:42
 * To change this template use File | Settings | File Templates.
 */
require_once("../model/dao/StorageQuotaDao.php");
require_once("../model/StorageQuota.php");
class StorageQuotaController {
    private $storageQuotaDao;

    function __construct() {
        $this->storageQuotaDao = new StorageQuotaDao();
    }

    public function actionQuotaAllNew($params) {
        $ret = array();
        $clusterList = $this->storageQuotaDao->getAllClusters();
        foreach ($clusterList as $cluster) {
            $newArr = array();
            $newArr["cluster"] = $cluster;
            $newStorageQuotaList = $this->storageQuotaDao->getNewByCluster($cluster);
            if ($cluster == "szwg-ston" || $cluster == "szwg-ecomon" || $cluster == "szwg-log") {
                $newArr["house"] = "SZWG-A";
            } elseif ($cluster == "szwg-stoff") {
                $newArr["house"] = "SZWG-B";
            } elseif ($cluster == "nj01-yulong" || $cluster == "nj01-nanling") {
                $newArr["house"] = "南京";
            } elseif ($cluster == "nmg01-mulan" || $cluster == "nmg01-khan") {
                $newArr["house"] = "内蒙古";
            }
            $newArr["quota"] = 0;
            $newArr["compressed_used"] = 0;
            $newArr["scale"] = 0;
            $newArr["rest"] = 0;
            $newArr["log"] = 0;
            $newArr["log36"] = 0;
            $newArr["lsp"] = 0;
            $newArr["event"] = 0;
            $newArr["mart"] = 0;
            $newArr["qe"] = 0;
            $newArr["data_use"] = 0;
            foreach ($newStorageQuotaList as $storageQuota) {
                $service = $storageQuota->getService();
                if ($service == "UBS") {
                    $newArr["quota"] -= $storageQuota->getQuota();
                    $newArr["compressed_used"] -= $storageQuota->getCompressedUsed();
                } else {
                    $newArr["quota"] += $storageQuota->getQuota();
                    $newArr["compressed_used"] += $storageQuota->getCompressedUsed();
                }
                if ($service == "UDW")
                    $newArr["event"] += $storageQuota->getCompressedUsed();
                if ($service == "INSIGHT")
                    $newArr["mart"] += $storageQuota->getCompressedUsed();
                if ($service == "LOG36")
                    $newArr["log36"] += $storageQuota->getCompressedUsed();
                if ($service == "LSP")
                    $newArr["lsp"] += $storageQuota->getCompressedUsed();
                if ($service == "LDM" || $service == "PB" || $service == "BIGPIPE" || $service == "LOGGING" || $service == "MINOS")
                    $newArr["log"] += $storageQuota->getCompressedUsed();
                if ($service == "ERISED" || $service == "UPDM" || $service == "DORIS")
                    $newArr["data_use"] += $storageQuota->getCompressedUsed();
            }
            $newArr["scale"] = $newArr["compressed_used"] / $newArr["quota"];
            $newArr["rest"] = $newArr["quota"] - $newArr["compressed_used"];
            array_push($ret, $newArr);
        }
        $result["data"] = $ret;

        $newArr["quota"] = 0;
        $newArr["compressed_used"] = 0;
        $newArr["log"] = 0;
        $newArr["log36"] = 0;
        $newArr["lsp"] = 0;
        $newArr["event"] = 0;
        $newArr["mart"] = 0;
        $newArr["qe"] = 0;
        $newArr["data_use"] = 0;
        foreach ($ret as $value) {
            $newArr["quota"] += $value["quota"];
            $newArr["compressed_used"] += $value["compressed_used"];
            $newArr["log"] += $value["log"];
            $newArr["log36"] += $value["log36"];
            $newArr["lsp"] += $value["lsp"];
            $newArr["event"] += $value["event"];
            $newArr["mart"] += $value["mart"];
            $newArr["qe"] += $value["qe"];
            $newArr["data_use"] += $value["data_use"];
        }
        $newArr["scale"] = $newArr["compressed_used"] / $newArr["quota"];
        $newArr["rest"] = $newArr["quota"] - $newArr["compressed_used"];
        $result["total"] = $newArr;
        echo json_encode($result);
    }

    public function actionDetailQuota($params) {
        $ret = array();
        $date = $this->storageQuotaDao->getNewDate();
        $storageQuotaList = $this->storageQuotaDao->getAllByDate($date);
        foreach ($storageQuotaList as $storageQuota) {
            array_push($ret, $storageQuota->toArray());
        }
        echo json_encode($ret);
    }
}