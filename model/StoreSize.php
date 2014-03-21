<?php
/**
 * Created by JetBrains PhpStorm.
 * User: heqing02
 * Date: 14-3-10
 * Time: 上午10:52
 * To change this template use File | Settings | File Templates.
 */

class StoreSize {
    private $id;
    private $system;
    private $product;
    private $name;
    private $path;
    private $size;
    private $cluster;
    private $date;

    function __construct($cluster, $date, $name, $path, $product, $size, $system) {
        $this->cluster = $cluster;
        $this->date = $date;
        $this->name = $name;
        $this->path = $path;
        $this->product = $product;
        $this->size = $size;
        $this->system = $system;
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
     * @param mixed $date
     */
    public function setDate($date) {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getDate() {
        return $this->date;
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
     * @param mixed $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path) {
        $this->path = $path;
    }

    /**
     * @return mixed
     */
    public function getPath() {
        return $this->path;
    }

    /**
     * @param mixed $product
     */
    public function setProduct($product) {
        $this->product = $product;
    }

    /**
     * @return mixed
     */
    public function getProduct() {
        return $this->product;
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

    /**
     * @param mixed $system
     */
    public function setSystem($system) {
        $this->system = $system;
    }

    /**
     * @return mixed
     */
    public function getSystem() {
        return $this->system;
    }

    public function toArray() {
        $arr["id"] = $this->id;
        $arr["system"] = $this->system;
        $arr["product"] = $this->product;
        $arr["name"] = $this->name;
        $arr["path"] = $this->path;
        $arr["size"] = $this->size;
        $arr["cluster"] = $this->cluster;
        $arr["date"] = $this->date;
        return $arr;
    }
}