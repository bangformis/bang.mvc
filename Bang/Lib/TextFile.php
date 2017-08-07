<?php

namespace Bang\Lib;

/**
 * @author Bang
 */
class TextFile {

    public function __construct($path) {
        $this->Path = Path::Content($path);
    }

    private $Path;

    public function Read() {
        $path = ($this->Path);
        if (is_file($path)) {
            $file = fopen($path, "r");
            $content = fread($file, filesize($path));
            fclose($file);
            return $content;
        } else {
            throw new \Exception('File not found!', 404);
        }
    }

    public function Write($content) {
        $path = ($this->Path);
        $file = fopen($path, "w");
        fwrite($file, $content);
        fclose($file);
    }

    public function Append($content) {
        $path = ($this->Path);
        $file = fopen($path, "a");
        fwrite($file, $content);
        fclose($file);
    }

    public function GetFileSize() {
        $size = filesize($this->Path);
        return $size;
    }

    public function GetFileSizeKB() {
        $size = $this->GetFileSize();
        return doubleval($size) / 1024.0;
    }

    public function GetFileSizeMB() {
        $size = $this->GetFileSizeKB();
        return $size / 1024.0;
    }

    public function GetFileSizeGB() {
        $size = $this->GetFileSizeMB();
        return $size / 1024.0;
    }

    public function CreateIfNotFound($default_content = '', $mode = 755) {
        $path = ($this->Path);
        if (!file_exists($path)) {
            $this->Write($default_content);
            $this->ChangeMode($mode);
        }
    }

    /**
     * 修改權限
     * @param string $mode EX:755
     */
    public function ChangeMode($mode = 755) {
        $oct_mode = octdec($mode);
        $path = ($this->Path);
        return chmod($path, $oct_mode);
    }

}
