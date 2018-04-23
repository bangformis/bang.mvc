<?php

namespace Bang\Tools;

use Bang\Lib\eString;
use Bang\Lib\ORM;

/**
 * @author Bang
 */
class ObjectSyntaxGenerator {

    public $obj;

    function __construct($obj) {
        $this->obj = $obj;
    }

    public function EchoHasProperties($new_line = "<br />") {
        $names = ORM::GetPropertiesName($this->obj);
        $result = "";
        foreach ($names as $name) {
            $pascal_name = self::ConnectMarkToPascalNaming($name);
            $result .= "public function Has{$pascal_name}() {{$new_line}
                            \Bang\Lib\eString::IsNotNullOrSpace(\$this->{$name});{$new_line}
                        }{$new_line}{$new_line}";
        }
        return $result;
    }

    public static function ConnectMarkToPascalNaming($name) {
        $result = "";
        $words = eString::Split($name, '_');

        foreach ($words as $word) {
            $chars = str_split($word);
            $max_index = count($chars) - 1;
            for ($i = 0; $i <= $max_index; $i++) {
                $char = $chars[$i];
                if ($i === 0) {
                    $char = strtoupper($char);
                }
                $result .= $char;
            }
        }
        return $result;
    }

    public function HasObj() {
        eString::IsNotNullOrSpace($this->obj);
    }

}
