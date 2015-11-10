<?php
/**
 * Created by PhpStorm.
 * User: Tatiana
 * Date: 03.03.2015
 * Time: 19:20
 */

require_once"modules_class.php";

class OrderContent extends Modules {

    protected $title = "Оформление заказа";
    protected $meta_desc = "Оформление заказа на покупку товара";
    protected $meta_key = "заказ, оформление заказа, заказать, оформить";

    protected function getContent(){

        $this->template->set( "message", $this->message());
        $this->template->set( "name", $_SESSION["name"]);
        $this->template->set( "phone", $_SESSION["phone"]);
        $this->template->set( "email", $_SESSION["email"]);
        $this->template->set( "city", $_SESSION["city"]);
        $this->template->set( "street", $_SESSION["street"]);
        $this->template->set( "notice ", $_SESSION["notice"]);

        return "order";

    }

}