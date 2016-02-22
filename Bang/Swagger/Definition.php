<?php

namespace Bang\Swagger;

/**
 * @author Bang
 */
class Definition {

    function __construct($class_name, $type = 'object') {
        $this->class_name = $class_name;
        $this->type = $type;
        $this->_properties = array();
    }

    public $class_name;
    public $type;
    private $_properties;

    public function AddProperty(Property $property) {
        $this->_properties[] = $property;
    }

    public function Add($name, $desc, $type = 'string', $definition_name = null) {
        $this->_properties[] = new Property($name, $desc, $type, $definition_name);
    }

    public function Generate() {
        $item = new \stdClass();
        $item->type = $this->type;
        $properties_item = new \stdClass();
        foreach ($this->_properties as $property) {
            $properties_item->{$property->name} = $property->Generate();
        }
        $item->properties = $properties_item;
        return $item;
    }

}
