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

    public function GetCountryAndCityFromIp(){
        $ip_address = $_GET['ip_address'];
        $sql = "SELECT
                geo_lite_city_location.country,
                geo_lite_city_location.city
                FROM
                geo_lite_city_blocks
                INNER JOIN geo_lite_city_location ON geo_lite_city_blocks.location_id = geo_lite_city_location.id
                WHERE INET_ATON(:ip_address) BETWEEN start_ip_num AND end_ip_num";
        $param = array(
            ":ip_address" => $ip_address
        );
        
        $sql_result = DbContext::Query($sql, $param);
        $result_value = $sql_result->fetchObject();
        
        $result = new TaskResult();
        $result->IsSuccess = TRUE;
        $result->Message = "Hello World";
        $result->Value = $result_value;
        
        return $this->Json($result);
    }
    
    public function JsonTest() {
        return $this->Json(Request::GetPost(new Operator("", "", "", 9)));
    }

}
