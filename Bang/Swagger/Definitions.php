<?php

namespace Bang\Swagger;

/**
 * @author Bang
 */
class Definitions {

    function __construct() {
        $this->_definitions = array();
    }

    private $_definitions;

    public function Add(Definition $def) {
        $this->_definitions[] = $def;
    }

    public function Generate() {
        $item = new \stdClass();
        foreach ($this->_definitions as $def) {
            $item->{$def->class_name} = $def->Generate();
        }
        return $item;
    }

}
