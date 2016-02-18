<?php

namespace Models\RequestBag;

/**
 * @author Bang
 */
class Test extends ChecksumBase {

    public $email;

    public function Valid() {
        parent::Valid();
        if (!\Checker::IsEmail($this->email)) {
            $this->ThrowException('Wrong Email Format', \ErrorCode::WrongFormat);
        }
    }

    /**
     * @return \Models\RequestBag\Test
     */
    public static function GetFromQuery() {
        $bag = new Test();
        \Request::GetGet($bag);
        return $bag;
    }

}
