<?php
/**
 * Created by PhpStorm.
 * User: Tatiana
 * Date: 27.02.2015
 * Time: 0:50
 */
require_once "global_class.php";

class Discount extends GlobalClass {

    public function __construct(){
        parent::__construct("discounts");
    }


    public function getValueOnCode($code){
        return $this->getField("code",$code,"value");

    }


}