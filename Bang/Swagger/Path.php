<?php

namespace Bang\Swagger;

/**
 * @author Bang
 */
class Path {

    function __construct($relative_url, $method, $summary, $description, Parameters $parameters, Responses $responses) {

        $this->summary = $summary;
        $this->description = $description;


        $this->relative_url = $relative_url;
        $this->method = $method;
        $this->parameters = $parameters;
        $this->responses = $responses;
        $this->tags = array();
        if (null == $this->parameters) {
            $this->parameters = new Parameters();
        }
        if (null == $this->responses) {
            $this->responses = new Responses();
        }
    }

    public function AddTag($tag_name) {
        $this->tags[] = $tag_name;
    }

    public $relative_url;
    public $method;
    public $summary;
    public $description;

    /**
     * @var Parameters
     */
    public $parameters;

    /**
     * @var array
     */
    public $tags;

    /**
     * @var Responses
     */
    public $responses;

    public function Generate() {
        $item = new \stdClass();
        $method = $this->method;
        $method_item = new \stdClass();

        $method_item->summary = $this->summary;
        $method_item->description = $this->description;
        $method_item->parameters = $this->parameters->Generate();
        $method_item->responses = $this->responses->Generate();

        if (count($this->tags) > 0) {
            $method_item->tags = $this->tags;
        }

        $item->{$method} = $method_item;
        return $item;
    }

}
