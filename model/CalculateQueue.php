<?php
/**
 * Created by JetBrains PhpStorm.
 * User: heqing02
 * Date: 13-11-21
 * Time: 下午2:39
 * To change this template use File | Settings | File Templates.
 */

class CalculateQueue {
    private $queue;
    private $cluster;

    function __construct() {
    }

    /**
     * @param mixed $cluster
     */
    public function setCluster($cluster) {
        $this->cluster = $cluster;
    }

    /**
     * @return mixed
     */
    public function getCluster() {
        return $this->cluster;
    }

    /**
     * @param mixed $queue
     */
    public function setQueue($queue) {
        $this->queue = $queue;
    }

    /**
     * @return mixed
     */
    public function getQueue() {
        return $this->queue;
    }

}