<?php
/**
 * Created by JetBrains PhpStorm.
 * User: heqing02
 * Date: 13-9-27
 * Time: 上午10:47
 * To change this template use File | Settings | File Templates.
 */

class Db {
    var $dbHost = "localhost";
    var $dbUser = "root";
    var $dbPassword = "123456";
    var $dbName = "udw_ui";

    /**
     * @param string $dbHost
     */
    public function setDbHost($dbHost) {
        $this->dbHost = $dbHost;
    }

    /**
     * @param string $dbName
     */
    public function setDbName($dbName) {
        $this->dbName = $dbName;
    }

    /**
     * @param string $dbPassword
     */
    public function setDbPassword($dbPassword) {
        $this->dbPassword = $dbPassword;
    }

    /**
     * @param string $dbUser
     */
    public function setDbUser($dbUser) {
        $this->dbUser = $dbUser;
    }

    private static $instance = NULL;

    private function __construct() {

    }

    public static function getInstance() {
        if (self::$instance == NULL) {
            self::$instance = new Db();
        }
        return self::$instance;
    }

    public function createCon() {
        mysql_connect($this->dbHost, $this->dbUser, $this->dbPassword);
        mysql_select_db($this->dbName);
    }

    public function query($sql) {
        mysql_query("set names UTF8");
        return mysql_query($sql);
    }

    public function close() {
        return mysql_close();
    }
}