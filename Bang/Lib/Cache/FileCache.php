<?php

namespace Bang\Lib\Cache;

use Bang\Lib\TextFile;

/**
 * @author Bang
 */
class FileCache implements ICacheData {

    function __construct($file_path, $timeout_seconds = 60) {
        $this->file_path = new TextFile($file_path);
        $this->timeout_seconds = $timeout_seconds;
    }

    /**
     * @var TextFile 
     */
    private $text_file;
    private $timeout_seconds;

    public function IsExist() {
        $file = $this->text_file;

        if ($file->CreateIfNotFound($default_content)) {
            
        }
    }

}

class FileCacheData {

    public $time;
    public $data;

}
