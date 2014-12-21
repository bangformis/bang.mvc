<?php

/**
 * 主頁面Controller
 * @author Bang
 */
class HomeController extends ControllerBase {

    public function Index() {
        ResponseBag::Add("index1", "測試資料ㄇ!");
        return $this->View("Index");
    }

    public function Index2() {
        ResponseBag::Add("index2", "測試資料ㄇ2!");
        return $this->View("Index2");
    }

}
