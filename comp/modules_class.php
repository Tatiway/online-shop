<?php
/**
 * Created by PhpStorm.
 * User: Tatiana
 * Date: 27.02.2015
 * Time: 13:18
 */
require_once "lib/abstractmodules_class.php";


 abstract class Modules extends AbstractModules {


     public function __construct(){
         parent::__construct();

         $this->setInfoCart();
         $this->template->set("content", $this->getContent());
         $this->template->set("action",$this->url->action());
         $this->template->set("title", $this->title);
         $this->template->set("meta_desc", $this->meta_desc);
         $this->template->set("meta_key", $this->meta_key);
         $this->template->set("index", $this->url->index());
         $this->template->set("link_delivery", $this->url->delivery());
         $this->template->set("link_contacts", $this->url->contacts());
         $this->template->set("link_search", $this->url->search());
         $this->template->set("link_cart", $this->url->cart());
         $this->template->set("items" , $this->categories->getAllData());
         $this->template->display("main");


     }
     //метод преобразует строку из id через запятую в массив
     //и устанавливает количество товаров в корзине set("cart_count",count($ids) )
     // и опередеет сумму заказа
     private function setInfoCart(){
         if ($_SESSION["cart"]) {
         $ids = explode(",", $_SESSION["cart"]);
         $summa = $this->product->getPriceOnIDs($ids);
         $this->template->set("cart_count", count($ids));
         $this->template->set("cart_summa", $summa);
         //print_r($ids);
         }else{
             $this->template->set("cart_count", 0);
             $this->template->set("cart_summa", 0);
         }

     }

     //метод лдя реализации сортировки

     protected function setLinkSort(){
         $this->template->set("link_price_up", $this->url->sortPriceUp() );
         $this->template->set("link_price_down", $this->url->sortPriceDown() );
         $this->template->set("link_title_up", $this->url->sortTitleUp() );
         $this->template->set("link_title_down", $this->url->sortTitleDown() );
     }

     protected function getDirTmpl(){
        return $this->config->dir_tmpl;

     }


}