<?php
/**
 * Created by JetBrains PhpStorm.
 * User: heqing02
 * Date: 14-3-10
 * Time: 下午1:45
 * To change this template use File | Settings | File Templates.
 */
require_once("HistoryController.php");
require_once("ResController.php");
require_once("StorageQuotaController.php");
require_once("StoreSizeController.php");
class Dispatcher {
    private static $instance = null;

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Dispatcher();
        }
        return self::$instance;
    }

    public function dispatch($controller, $action, $params) {
        switch ($controller) {
            case "store_size":
                $storeSizeController = new StoreSizeController();
                if ($action == "get_all") {
                    $storeSizeController->actionAll($params);
                }
                break;
            case "storage_quota":
                $storageQuotaController = new StorageQuotaController();
                if ($action == "get_all_new") {
                    $storageQuotaController->actionQuotaAllNew($params);
                }
                if ($action == "get_detail_quota") {
                    $storageQuotaController->actionDetailQuota($params);
                }
            default:
                break;

        }
    }
}