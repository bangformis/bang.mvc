<?php

namespace Bang\Lib\Cache;

use Bang\Lib\eDateTime;
use Bang\Lib\TextFile;

/**
 * @author Bang
 */
abstract class FileCache implements ICacheData {

    /**
     * @param type $file_path 檔案於此軟體的Root相對路徑
     * @param type $timeout_seconds 設定為0時代表沒有Timeout(永久快取)
     */
    function __construct($file_path, $timeout_seconds = 60) {
        $this->file_path = new TextFile($file_path);
        $this->timeout_seconds = $timeout_seconds;
    }

    /**
     * @var TextFile 
     */
    private $text_file;
    private $timeout_seconds;

    protected abstract function GetNewData();

    protected function IsExist() {
        $file = $this->text_file;
        $result = $file->IsExist();
        return $result;
    }

    protected function Init() {
        $datetime = new eDateTime();

        $content = new FileCacheData();
        $content->data = $this->GetNewData();
        $content->time = $datetime->ToDateTimeString();

        $this->text_file->CreateIfNotFound();
        $write_content = json_encode($content);
        $this->text_file->Write($write_content);
    }

    protected function Update() {
        $datetime = new eDateTime();

        $content = new FileCacheData();
        $content->data = $this->GetNewData();
        $content->time = $datetime->ToDateTimeString();

        $this->text_file->CreateIfNotFound();
        $write_content = json_encode($content);
        $this->text_file->Write($write_content);
    }

    protected function InitIfNotExist() {
        if (!$this->IsExist()) {
            $this->Init();
        }
    }

    protected function IsTimeout() {
        $timeout_s = intval($this->timeout_seconds);
        if ($timeout_s <= 0) {
            return false;
        }
        $now = new eDateTime();
        $data = $this->GetDataFromFile();
        $timeout_datetime = $data->GetTimeoutDatetime($timeout_s);
        $result = $now->ToDateTimeString() > $timeout_datetime;
        return $result;
    }

    /**
     * @return FileCacheData
     */
    protected function GetDataFromFile() {
        $file_content = $this->text_file->Read();
        $data_array = json_decode($file_content, 1);
        $result = new FileCacheData();
        $result->data = $data_array['data'];
        $result->time = $data_array['time'];
        return $result;
    }

    public function GetFromCache() {
        $this->InitIfNotExist();
        if ($this->IsTimeout()) {
            $this->Update();
        }
        $data = $this->GetDataFromFile();
        return $data;
    }

}

class FileCacheData {

    public $time;
    public $data;

    public function GetTimeoutDatetime($timeout_seconds) {
        $datetime = new eDateTime($this->time);
        $datetime->AddSeconds($timeout_seconds);
        $result = $datetime->ToDateTimeString();
        return $result;
    }

}
