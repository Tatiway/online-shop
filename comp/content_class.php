<?php
/**
 * Created by PhpStorm.
 * User: Tatiana
 * Date: 27.02.2015
 * Time: 14:14
 */

require_once "modules_class.php";

class Content extends Modules  {

    protected $title = "Интернет-магазин";
    protected $meta_desc = "Интернет-магазин";
    protected $meta_key = "Интернет-магазин по продаже компьтерной техники";


    protected function getContent(){
        $this->setLinkSort();
        $sort = $this->data["sort"];//принимаем пораметр sort из гет запроса(нажимая по ссылкам сортировки)
        $up = $this->data["up"];//принимаем пораметр up из гет запроса
        $this->template->set("table_products_title", "Новинки");
        $this->template->set("products",$this->product->getAllDataSort($sort , $up , $this->config->count_on_page) );
        return "index";

    }

}