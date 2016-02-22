<?php

namespace Bang\Swagger;

/**
 * @author Bang
 */
class Info {

    function __construct($title = 'Default API', $description = 'Default API Description', $version = '1.0.0') {
        $this->title = $title;
        $this->description = $description;
        $this->version = $version;
    }

    public $title;
    public $description;
    public $version;

    public function Generate() {
        return $this;
    }

}
