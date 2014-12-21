<?php

require_once Url::Content('Models/User.php');

/**
 * 主頁面Controller
 * @author Bang
 */
class HomeController extends ControllerBase {

    public function Index() {
        ResponseBag::Add("index1", "測試資料ㄇ!");
        
        
        ViewBag::SetNormalSite("Home", "測試各種各種.");
        return $this->View("Index");
    }

    public function Index2() {
        ResponseBag::Add("index2", "測試資料ㄇ2!");
        return $this->View("Index2");
    }

    public function JsonTest() {
        return $this->Json(Request::GetPost(new User()));
    }

}
