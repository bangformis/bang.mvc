<?php

/**
 * 錯誤訊息紀錄
 * @author Bang
 */
class error_log {

    public $Id;
    public $Content;
    public $Filename;
    public $Line;
    public $Message;
    public $DateTime;

    public function Delete() {
        $sql = "DELETE FROM `error_log` WHERE (`Id`=:id)";
        $params = array(
            ':id' => $this->Id
        );
        $stem = DbContext::Query($sql, $params);
        return $stem->rowCount();
    }

    public function Insert() {
        $sql = "INSERT INTO `error_log` (`Content`, `Filename`, `Line`, `Message`) VALUES
                (:content, :filename , :line , :message)";
        $params = array(
            ':content' => $this->Content,
            ':filename' => $this->Filename,
            ':line' => $this->Line,
            ':message' => $this->Message
        );
        $this->Id = DbContext::Insert($sql, $params);
        return $this->Id;
    }

    public function Update() {
        $sql = "UPDATE `error_log` SET 
                `Filename`= :filename,
                `Content` = :content,
                `Line` = :line,
                `Message` = :message
                WHERE (`Id`= :id)";
        $params = array(
            ':content' => $this->Content,
            ':filename' => $this->Filename,
            ':line' => $this->Line,
            ':message' => $this->Message,
            ':id' => $this->Id
        );
        $stem = DbContext::Query($sql, $params);
        return $stem->rowCount();
    }

    public static function GetTotal() {
        $sql = "SELECT Count(*) as `Count` FROM `error_log`";
        $stem = DbContext::Query($sql);
        $result = $stem->fetch(2);
        return $result['Count'];
    }

    public static function GetList($page = 1, $count_per_page = 25) {
        $total = error_log::GetTotal();
        $total_int = intval($total);

        $paging = new \Bang\Lib\Pagination($total_int, $page, $count_per_page);
        $sql = "SELECT * FROM `error_log` 
                ORDER BY `DateTime` DESC
                LIMIT {$paging->GetSkipCount()}, {$paging->GetCountPerPage()}";

        $stem = DbContext::Query($sql);
        $results = $stem->fetchAll(2);
        return $results;
    }

}
