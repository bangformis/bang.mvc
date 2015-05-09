<?php

/**
 * 錯誤訊息紀錄
 * @author Bang
 */
class error_log extends MySqlTable {

    public $Id;
    public $Content;
    public $Filename;
    public $Message;
    public $DateTime;

    public function Delete() {
        $this->DeleteData('`Id`=:Id', array(':Id' => $this->Id));
    }

    public function Insert() {
        $this->InsertData(array('Id' => true, 'DateTime' => true));
    }

    public function Update() {
        $this->UpdateData('`Id`=:Id', array(':Id' => $this->Id));
    }

}
