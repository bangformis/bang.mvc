<?php

namespace Bang\Swagger;

/**
 * @author Bang
 */
class Parameters {

    function __construct() {
        $this->_params = array();
    }

    private $_params;

    public function Add(Parameter $param) {
        $this->_params[] = $param;
    }

    public function Generate() {
        $items = array();
        foreach ($this->_params as $param) {
            $items[] = $param->Generate();
        }
        return $items;
    }

}
