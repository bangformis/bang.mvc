<?php

namespace Models\RequestBag;

use Bang\Lib\Checker;
use Bang\Lib\Request;
use Models\ErrorCode;

/**
 * @author Bang
 */
class Test extends ChecksumBase {

    public $email;

    public function Valid() {
        parent::Valid();
        if (!Checker::IsEmail($this->email)) {
            $this->ThrowException('Wrong Email Format', ErrorCode::WrongFormat);
        }
    }

    /**
     * @return Test
     */
    public static function GetFromQuery() {
        $bag = new Test();
        Request::GetGet($bag);
        return $bag;
    }

}
