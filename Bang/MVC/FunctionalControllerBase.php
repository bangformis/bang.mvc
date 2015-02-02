<?php

/**
 * AYA Safe 各项功能 Controller Base
 * @author Bang
 */
class FunctionalControllerBase extends ControllerBase {

    /**
     * @var int 公司ID
     */
    protected $company_id;

    public function __construct() {
        $company = company::GetFromCache();
        if ((!isset($_GET['key']) || (!isset($company[$_GET['key']])))) {
            Response::HttpNotFound('Not found!');
        } else {
            $key = $_GET['key'];
            $com = $company[$key];
            $this->company_id = $com->id;
        }
    }


}
