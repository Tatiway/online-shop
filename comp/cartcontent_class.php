<?php
/**
 * Created by PhpStorm.
 * User: Tatiana
 * Date: 02.03.2015
 * Time: 21:44
 */

require_once"modules_class.php";

class CartContent  extends  Modules{

    protected $title = "Корзина";
    protected $meta_desc = "Содержимое корзины";
    protected $meta_key = "корзина, содержимое корзины, корзина товаров, товар";

    protected function getContent(){

        $cart = array();
        $summa = 0;

        if($_SESSION["cart"]){
            $ids = explode("," , $_SESSION["cart"]);//получаю массив id , Array ( [0] => 6 [1] => 6 [2] => 6 [3] => 3)
            //print_r($ids) ;
            $products = $this->product->getAllOnIDs($ids); //получаю массив всех данных о товарах с указанными id , Array ( [0] => Array ( [id] => 3 [catedories_id] => 2 [title] => Планшет Asus Transformer
            //print_r($products) ;
            $result = array();
            for($i = 0; $i<count($products); $i++){
                $result[$products[$i]["id"]]= $products[$i];
            }
            //print_r($result) ;
            $ids_unique = array_unique($ids);//убираем повторяющиеся id Array ( [0] => 6 [3] => 7 [5] => 8 [6] => 9 [7] => 11 [8] => 4 [15] => 5 [23] => 3 )
            //print_r( $ids_unique) ;
            $i = 0;
            $summa = 0;
            foreach ($ids_unique as $v){// цикл массив , получаем значения из массива
                $cart[$i]["id"] = $result[$v]["id"];
                $cart[$i]["title"] = $result[$v]["title"];// первая итерация, новый массив $cart в 0 эл. записываем $cart[0]["title"] = $result[6]["title"]; title 6 элементы
                $cart[$i]["imgSmall"] = $result[$v]["imgSmall"];
                $cart[$i]["price"] = $result[$v]["price"];
                $cart[$i]["sale"] = $result[$v]["sale"];
                $cart[$i]["count"] = $this->getCountInArray($v, $ids);
                $cart[$i]["summa"] = $cart[$i]["count"]* $cart[$i]["price"];
                $cart[$i]["link_delete"] = $result[$v]["link_delete"];
                $summa +=$cart[$i]["summa"];
                $i++;
            }
            $value = $this->discount->getValueOnCode($_SESSION["discount"]);//хотим узнать размер скидки по известному ABC
            //echo $value;
            if($value){
                $summa *= (1 - $value);//определяем скидку
                $this->template->set("discount", $_SESSION["discount"]);

            }
        }
        $this->template->set("summa",$summa);
        $this->template->set("cart",$cart);
        $this->template->set("action",$this->url->action());
        $this->template->set("link_order",$this->url->order());

        return "cart";

    }
    //определяем количество вхождений элемента в массиве $v-это один эеземпляр эл, массив элементов
    // узнаем сколько раз $v появлялось в массиве
    // private function getCountInArray($v, $ids){
    //     $count = 0;
    //     for($i = 0; $i < count($ids); $i++){
    //         if($ids[$i] == $v) $count++;
    //     }
    //     return $count;


    // }



}