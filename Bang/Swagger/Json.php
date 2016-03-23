<?php

namespace Bang\Swagger;

/**
 * 建立Swagger Json功能使用的物件
 * @author Bang
 */
class Json {

    /**
     * 
     * @param \Bang\Swagger\Info $info
     * @param string $host
     * @param string $basePath
     * @param string $schemes
     * @param string $produces
     * @param \Bang\Swagger\Paths $paths
     * @param \Bang\Swagger\Definitions $definitions
     * @param string $swagger
     */
    function __construct(Info $info, $host, $basePath = '/', $schemes = 'http', $produces = 'application/json', Paths $paths = null, Definitions $definitions = null, $swagger = '2.0') {
        $this->swagger = $swagger;
        $this->info = $info;
        $this->host = $host;
        $this->schemes = array($schemes);
        $this->basePath = $basePath;
        $this->produces = array($produces);
        if (null == $paths) {
            $this->paths = new Paths();
        }
        if (null === $definitions) {
            $this->definitions = new Definitions;
        }
    }

    public $swagger;

    /**
     * @var Info
     */
    public $info;
    public $host;

    /**
     * @var array
     */
    public $schemes;
    public $basePath;

    /**
     * @var array
     */
    public $produces;

    /**
     * @var Paths
     */
    public $paths;

    /**
     * @var Definitions 
     */
    public $definitions;

    public function Generate() {
        $item = new \stdClass();
        $item->swagger = $this->swagger;
        $item->info = $this->info->Generate();
        $item->host = $this->host;
        $item->schemes = $this->schemes;
        $item->basePath = $this->basePath;
        $item->produces = $this->produces;
        $item->paths = $this->paths->Generate();
        $item->definitions = $this->definitions->Generate();
        return json_encode($item);
    }

}
