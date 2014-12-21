<?php

/**
 * 系統操作者(資料庫對應)
 * @author Bang
 */
class Operator extends MySqlTableBase {

    /**
     * @var string 使用者帳號
     */
    public $id;

    /**
     * @var string 密碼
     */
    public $passowrd;

    /**
     * @var string 使用者姓名
     */
    public $name;

    /**
     * 權限數值(9為管理者)
     * @var int 
     */
    public $permission;

    /**
     * 將物件轉換為 Operator
     * @param Operator $obj
     * @return Operator 值接回傳
     */
    public static function ChangeType($obj) {
        return $obj;
    }

}
