<?php
/**
 * Created by JetBrains PhpStorm.
 * User: heqing02
 * Date: 13-11-19
 * Time: 上午10:26
 * To change this template use File | Settings | File Templates.
 */

class StorageDir {
    private $dir;
    private $size;
    private $cluster;

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

    function __construct() {
    }


    /**
     * @param mixed $dir
     */
    public function setDir($dir) {
        $this->dir = $dir;
    }

    /**
     * @return mixed
     */
    public function getDir() {
        return $this->dir;
    }

    /**
     * @param mixed $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param mixed $size
     */
    public function setSize($size) {
        $this->size = $size;
    }

    /**
     * @return mixed
     */
    public function getSize() {
        return $this->size;
    }

}