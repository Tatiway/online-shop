<?php
/**
 * Created by PhpStorm.
 * User: Tatiana
 * Date: 01.03.2015
 * Time: 16:32
 */
require_once "modules_class.php";

class CategoriesContent extends Modules{



    protected function getContent(){


        $cat_info = $this->categories->get($this->data["id"]);
        if(!$cat_info) return $this->notFound();//усли данные не корректные то отправляем на страницу NotFound
        $this->title = $cat_info["title"];
        $this->meta_desc = "Интернет-магазин. Товары категории ". $cat_info["title"];
        $this->meta_key = mb_strtolower("категории товаров, категории,  ". $cat_info["title"]);

        $this->template->set("table_products_title", $cat_info["title"]);


        $this->setLinkSort();
        $sort = $this->data["sort"];//принимаем пораметр sort из гет запроса(нажимая по ссылкам сортировки)
        $up = $this->data["up"];//принимаем пораметр up из гет запроса
        //$this->template->set("products", $this->product->getAllOnCategoriesID( $cat_info["id"], $sort , $up ));
        $this->template->set("products", $this->product->getAllOnCategoriesID( $cat_info["id"], $sort , $up ));
        return "index";

    }


}