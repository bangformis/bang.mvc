<?php

namespace Bang\Swagger;

/**
 * @author Bang
 */
class DefinitionTaskResult extends Definition {

    function __construct($response_def = null) {
        $def_name = "{$response_def}TaskResult";
        parent::__construct($def_name, 'object');

        $this->Add('IsSuccess', 'API 是否成功執行', 'boolean');

        if (null === $response_def) {
            $this->Add('Value', 'API 回傳結果', 'string');
        } else {
            $this->Add('Value', 'API 回傳結果', null, $response_def);
        }


        $this->Add('Message', 'API 回傳訊息', 'string');
    }

}
