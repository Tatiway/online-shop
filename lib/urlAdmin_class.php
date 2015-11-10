<?php
/**
 * Created by PhpStorm.
 * User: Tatiana
 * Date: 01.04.2015
 * Time: 13:58
 */
require_once "url_class.php";

class URLAdmin extends Url {



    public function auth(){
        return $this->returnURL("?view=auth");
    }

    public function actions(){
        return $this->returnURL("functions.php");
    }

    public function products(){
        return $this->returnURL("?view=products");
    }
    public function orders(){
        return $this->returnURL("?view=orders");
    }
    public function sections(){
        return $this->returnURL("?view=sections");
    }
    public function discounts(){
        return $this->returnURL("?view=discounts");
    }
    public function statistics(){
        return $this->returnURL("?view=statistics");
    }
    public function logout(){
        return $this->returnURL("functions.php?func=logout");
    }

    protected function returnURL($url, $index = false) {
        if (!$index) $index = $this->config->address_admin;
        return parent::returnURL($url, $index);
    }



}