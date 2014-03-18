<?php
/**
 * Created by JetBrains PhpStorm.
 * User: heqing02
 * Date: 14-3-10
 * Time: 下午1:59
 * To change this template use File | Settings | File Templates.
 */
require_once("../controller/Dispatcher.php");
$controller = $_REQUEST["c"];
$action = $_REQUEST["a"];
$params = isset($_REQUEST["params"]) ? $_REQUEST["params"] : "";

$dispatcher = Dispatcher::getInstance();
$dispatcher->dispatch($controller, $action, $params);