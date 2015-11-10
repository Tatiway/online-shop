<?php
require_once "modules_class.php";

class SearchContent extends Modules{

    protected function getContent(){
        $q = $this->data["q"];//запрос
        $this->title = "Поиск: $q";
        $this->meta_desc = "Поиск: $q.";
        $this->meta_key = preg_replace("/\s+/i", ", ",mb_strtolower($q));

        $this->setLinkSort();
        $this->template->set("q",$q);
        $this->template->set("table_products_title","Поиск");
        $this->template->set("products",$this->product->searches($q,$this->data["sort"], $this->data["up"]));

        return "search";

    }

}