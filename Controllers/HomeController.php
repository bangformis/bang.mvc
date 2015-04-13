<?php

require_once Path::Model("bang_model");

/**
 * 主頁面Controller
 * @author Bang
 */
class HomeController extends ControllerBase {

    public function Index() {
        
        //設定將資料需傳至 View的所有值 對應key可在view取得
        ResponseBag::Add("index1", "測試資料ㄇ!");
        
        //設定該頁面 標題 和敘述 範例
        ViewBag::SetNormalSite("Home", "測試各種各種.");
        
        //設定 Session值
        Session::Set('name', 'value');
        
        //取得Session值
        Session::Get('name');
        
        //設定 Appstore 值 （快取資料）
        Appstore::Set('name', 'value');
        
        //取得 appstore 值 （快取資料）
        Appstore::Get('name');
        
        return $this->View(); //將傳至 Views/Home/Index.php 檔案執行
    }
    
    public function RedirectTest(){
        return $this->RedirectToAction('Index');
    }
    
    public function RedirectTest2(){
        return $this->RedirectToUrl('http://facebook.com');
    }

}
