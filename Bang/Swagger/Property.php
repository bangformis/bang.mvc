<?php

namespace Bang\Swagger;

/**
 * @author Bang
 */
class Property {

    function __construct($name, $description, $type = 'string', $definition_name = null) {
        $this->name = $name;
        $this->description = $description;
        $this->type = $type;
        $this->definition_name = $definition_name;
    }

    public $name;
    public $description;
    public $type;
    public $definition_name;

    public function Generate() {
        $item = new \stdClass();
        if (null !== $this->definition_name) {
            $item->{"\$ref"} = "#/definitions/{$this->definition_name}";
        } else {
            $item->description = $this->description;
            $item->type = $this->type;
        }

        return $item;
    }

}
