<?php
/**
 * Created by PhpStorm.
 * User: Tatiana
 * Date: 27.02.2015
 * Time: 0:52
 */

require_once "global_class.php";

class Order extends GlobalClass{

    public function __construct(){
        parent::__construct("orders");
    }

    protected function checkData($data){
        if(!$this->check->ids($data["product_ids"])) return "NON_PRODUCT";
        if(!$this->check->amount($data["price"])) return "UNKNOWN_ERROR";
        if(!$this->check->name($data["name"])) return "ERROR_NAME";
        if(!$this->check->phone($data["phone"])) return "ERROR_PHONE";
        if(!$this->check->email($data["email"])) return "ERROR_EMAIL";
        if(!$this->check->oneOrZero($data["delivery"])) return "ERROR_DELIVERY";
        if($data["delivery"] == 1)$empty = true;
        else $empty = false;
        if(!$this->check->text($data["city"],$empty)) return "ERROR_CITY";
        if(!$this->check->text($data["street"],$empty)) return "ERROR_STREET";
        if(!$this->check->text($data["notice"],true)) return "ERROR_NOTICE";
        if(!$this->check->ts($data["data_order"])) return "UNKNOWN_ERROR";
        if(!$this->check->ts($data["data_send"])) return "UNKNOWN_ERROR";
        if(!$this->check->ts($data["data_pay"])) return "UNKNOWN_ERROR";
        return true;

    }

}