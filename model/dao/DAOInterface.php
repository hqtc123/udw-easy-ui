<?php
/**
 * Created by JetBrains PhpStorm.
 * User: heqing02
 * Date: 14-3-14
 * Time: 下午5:34
 * To change this template use File | Settings | File Templates.
 */
require_once("../model/db/Db.php");
interface DAOInterface {
    public function getAll();
}