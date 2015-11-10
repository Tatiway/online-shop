<?php
/**
 * Created by PhpStorm.
 * User: Tatiana
 * Date: 01.03.2015
 * Time: 18:17
 */

require_once "modules_class.php";

class ProductContent extends Modules {


    protected function getContent(){



        $product_info = $this->product->getProd($this->data["id"], $this->categories->getTableName());

        if(!$product_info) return $this->notFound();//усли данные не корректные то отправляем на страницу NotFound
        $this->title =  $product_info["title"];
        $this->meta_desc = "Описание товара. Покупка товара Товар ".  $product_info["title"];
        $this->meta_key = mb_strtolower("описание товара, один товар, товар, купить  ".  $product_info["title"]);

        //хлебные крошки
        $this->template->set("link_categories", $this->url->categories($product_info["catedories_id"]));
        //меняем в шаблоне "product" на данные из массива данных  $product_info
        $this->template->set("product", $product_info);
        //вывод сопутствующих товаров
        $this->template->set("products", $this->product->getOthers($product_info, $this->config->count_others));
        return "product";

    }



}