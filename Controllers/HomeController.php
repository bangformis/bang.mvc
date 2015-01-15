<?php

require_once Url::Model("Operator");

/**
 * 主頁面Controller
 * @author Bang
 */
class HomeController extends ControllerBase {

    public function Index() {
        ResponseBag::Add("index1", "測試資料ㄇ!");
        ViewBag::SetNormalSite("Home", "測試各種各種.");

        return $this->View();
    }

    public function Cassandra() {
        ViewBag::SetNormalSite("Cassandra Test Page", "Cassandra 資料測試.");

        if ($_POST) {
            $cql = $_POST['cql_content'];
            ResponseBag::Add("CQL", $cql);
            $cql = trim($cql);
            if (String::EndsWith($cql, ";")) {
                $result = CassandraDb::Query($cql);
                ResponseBag::Add("CqlResult", $result);
            }
        }
        return $this->View();
    }

    public function JsonTest() {
        return $this->Json(Request::GetPost(new Operator("", "", "", 9)));
    }

}
