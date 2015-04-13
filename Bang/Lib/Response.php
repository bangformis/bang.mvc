<?php

/*
 * 主要在於協助取得回傳Resposne
 * 以物件方式處理
 */

/**
 * Response 擴充功能
 * @author Bang
 */
class Response {

    /**
     * 回傳找不到網頁
     * @param string $msg 檢視訊息
     */
    public static function HttpNotFound($msg = NULL) {
        http_response_code(404);
        header("HTTP/1.0 404 Not Found");
        if (String::IsNotNullOrSpace($msg)) {
            echo $msg;
        }
        die();
    }

    /**
     * 重新導向網址
     * @param string $url 導向的網址
     */
    public static function RedirectUrl($url) {
        header("Location: {$url}");
        die();
    }

}
