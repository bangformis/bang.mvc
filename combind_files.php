<?php

use Bang\Lib\eString;
use Bang\Lib\Path;
use Bang\Lib\TextFile;

require_once 'System.php';

$path = Path::Content('/003/');
$output = "/003/003_all.txt";
$files = scandir($path);

$result_file = new TextFile($output);
$result_file->CreateIfNotFound();

$string = "";
foreach ($files as $file) {
    if (eString::EndsWith($file, 'csv')) {
        $text_file = new TextFile("/003/" . $file);
        $content = $text_file->Read();
        $result_file->Append($content . "\n");
    }
}