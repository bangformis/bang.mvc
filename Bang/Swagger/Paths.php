<?php

namespace Bang\Swagger;

/**
 * @author Bang
 */
class Paths {

    private $_paths;

    function __construct() {
        $this->_paths = array();
    }

    public function Add(Path $path) {
        $this->_paths[] = $path;
    }

    public function Generate(){
        $item = new \stdClass();
        foreach ($this->_paths as $path) {
            $item->{$path->relative_url} = $path->Generate();
        }
        return $item;
    }
}
