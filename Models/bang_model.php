<?php

/**
 * 系統操作者(資料庫對應)
 * @author Bang
 */
class bang_model extends MySqlTable {

    /**
     * @var int 使用者帳號
     */
    public $id;

    /**
     * @var string content
     */
    public $text1;

    /**
     * @var string content
     */
    public $text2;

    /**
     * @var int Timestamp
     */
    public $datetime;

    /**
     * @var int Money
     */
    public $money;

    /**
     * 插入資料
     * @param array $without_keys 傳入不需插入的欄位Key對上Value=TRUE
     * @return int Last Id
     */
    public function Insert() {
        $this->id = parent::InsertData(array(
                    'id' => true,
                    'datetime' => true
        ));
        return $this->id;
    }

    public function Update() {
        parent::UpdateData("`id`=:id", array(":id" => $this->id), array(
            'id' => TRUE,
            'datetime' => TRUE
        ));
    }

    public function Delete() {
        parent::DeleteData("`id`=:id", array(":id" => $this->id));
    }

    /**
     * @param bang_model $obj
     * @return bang_model
     */
    public static function AsType($obj) {
        return $obj;
    }

}
