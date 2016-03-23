<?php

namespace Bang\Swagger;

/**
 * @author Bang
 */
class Response {

    function __construct($http_code, $description) {
        $this->http_code = $http_code;
        $this->description = $description;

        $schema = new \stdClass();
        $schema->{"\$ref"} = "#/definitions/TaskResult";
        $this->_schema = $schema;
    }

    public $http_code;
    public $description;
    private $_schema;

    public function SetSchema($definition_name) {
        $this->_schema->{"\$ref"} = "#/definitions/{$definition_name}";
    }
    
    public function Generate(){
        $item = new \stdClass();
        $item->description = $this->description;
        $item->schema = $this->_schema;
        return $item;
    }

}
