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

    public function Cassandra(){
        ViewBag::SetNormalSite("Cassandra Test Page", "Cassandra 資料測試.");
        
        $result = CassandraDb::Query("select * from playlists limit 100;");
        ResponseBag::Add("Model", $result);
        return $this->View();
    }
    
    public function Index2() {
        ResponseBag::Add("index2", "測試資料ㄇ2!");
        return $this->View("Index2");
    }

    public function JsonTest() {
        return $this->Json(Request::GetPost(new Operator("", "", "", 9)));
    }

}
