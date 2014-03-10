<?php
/**
 * Created by JetBrains PhpStorm.
 * User: heqing02
 * Date: 13-9-27
 * Time: 上午10:47
 * To change this template use File | Settings | File Templates.
 */
include_once("DBConfig.php");
class Db {
    private static $instance = NULL;

    private function __construct() {

    }

    public static function getInstance() {
        if (self::$instance == NULL) {
            self::$instance = new Db();
        }
        return self::$instance;
    }

    public function connectUdwUi() {
        mysql_connect(DBConfig::HOST . ":" . DBConfig::PORT, DBConfig::USER, DBConfig::PASSWORD);
        mysql_select_db(DBConfig::DB_UDW_UI);
    }

    public function connectStorageResource() {
        mysql_connect(DBConfig::HOST . ":" . DBConfig::PORT, DBConfig::USER, DBConfig::PASSWORD);
        mysql_select_db(DBConfig::DB_STORAGE_RESOURCES);
    }

    public function query($sql) {
        mysql_query("set names UTF8");
        return mysql_query($sql);
    }

    public function close() {
        return mysql_close();
    }
}