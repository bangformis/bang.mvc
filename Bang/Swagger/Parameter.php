<?php

namespace Bang\Swagger;

/**
 * @author Bang
 */
class Parameter {

    function __construct($name, $in, $description, $required, $type, $format) {
        $this->name = $name;
        $this->in = $in;
        $this->description = $description;
        $this->required = $required;
        $this->type = $type;
        $this->format = $format;
    }

    public $name;
    public $in;
    public $description;
    public $required;
    public $type;
    public $format;

    public function Generate() {
        return $this;
    }

}
