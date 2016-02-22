<?php

namespace Bang\Swagger;

/**
 * @author Bang
 */
class Responses {

    function __construct() {
        $this->_responses = array();
    }

    private $_responses;

    public function Add(Response $response) {
        $this->_responses[] = $response;
    }

    public function Generate() {
        $item = new \stdClass();
        foreach ($this->_responses as $response) {
            $item->{$response->http_code} = $response->Generate();
        }
        return $item;
    }

}
