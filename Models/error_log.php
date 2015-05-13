<?php

/**
 * 錯誤訊息紀錄
 * @author Bang
 */
class error_log extends MySqlTable {

    public $Id;
    public $Content;
    public $Filename;
    public $Line;
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

    public static function AddToDatabase(error_log $error_log) {
        return $error_log->Insert();
    }

    public static function CreateInstance($Content, $Filename ,$Line, $Message) {
        $log = new error_log();
        $log->Line = $Line;
        $log->Content = $Content;
        $log->Filename = $Filename;
        $log->Message = $Message;
        return $log;
    }

}
