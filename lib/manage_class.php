<?php
/**
 * Created by PhpStorm.
 * User: Tatiana
 * Date: 02.03.2015
 * Time: 16:59
 */

require_once "config_class.php";
require_once "format_class.php";
require_once "product_class.php";
require_once "discount_class.php";
require_once "order_class.php";
require_once "systemmessage_class.php";
require_once "mail_class.php";

class Manage {

    protected $config;
    protected $format;
    protected $data;
    protected $product;
    protected $discount;
    protected $order;
    protected $sm;
    protected $mail;

    public function __construct(){
        session_start();
        $this->config = new Config();
        $this->format = new Format();
        $this->data = $this->format->xss($_REQUEST);//для запросов в базу данных
        $this->product = new Product();
        $this->discount = new Discount();
        $this->order = new Order();
        $this->sm = new SystemMessage();
        $this->mail = new Mail();
        $this->saveData();

    }
//сохраняем дпнные из формы в сессию
    private function saveData(){
        foreach($this->data as $key => $value) $_SESSION[$key]=$value;
    }
    //сохраняем в сесии значения id продукта
    public function addCart($id = false){
        if(!$id) $id = $this->data["id"];
        if(!$this->product->existsID($id)) return false;
        if($_SESSION["cart"])$_SESSION["cart"] .=",$id"; // если существует значение в сессии значит очередное значение добавляется через запятую
        else $_SESSION["cart"] = $id;// если не существует значит, записывается;
    }
    // удаление товара из корзины товара
    public function deleteCart(){
        $id = $this->data["id"];//получаем id из get запроса
        $ids = explode(",", $_SESSION["cart"]);// получаем массив данных id из сессии
        $_SESSION["cart"]= "";// опусташаем данные в сессии;
        for($i = 0; $i< count($ids); $i++){
            if($ids[$i] != $id ) $this->addCart($ids[$i]);//и если $ids[$i] не равен $id из запроса, мы его добавляем в сессию опять

        }
    }

    public function updateCart(){
       // print_r($this->data);
       $_SESSION["cart"]="";
        //print_r($this->data);//Array ( [count_5] => 10 [x] => 73 [y] => 28 [discount] => [func] => cart )
        foreach($this->data as $k=> $v){//Array ( [count_7] => 1 [count_8] => 2 [x] => 75 [y] => 33 [discount] => [func] => cart )
            if(strpos($k, "count_") !== false ){// если count есть, то
                $id = substr($k, strlen("count_"));// вырезаем из count_7 , 7-ку
                for($i = 0; $i < $v; $i++) $this->addCart($id);
            }

        }
        $_SESSION["discount"] = $this->data["discount"];
    }

    public function addOrder(){
        //создаем массив
        $temp_data = array();
        //информация о продукте заказа
        $temp_data["delivery"]=$this->data["delivery"];
        $temp_data["product_ids"]=$_SESSION["cart"];
        $temp_data["price"]=$this->getPrice();
        //информация о клиенте
        $temp_data["name"]=$this->data["name"];
        $temp_data["phone"]=$this->data["phone"];
        $temp_data["email"]=$this->data["email"];
        $temp_data["city"]=$this->data["city"];
        $temp_data["street"]=$this->data["street"];
        $temp_data["notice"]=$this->data["notice"];
        $temp_data["data_order"]=$this->format->ts();
        $temp_data["data_send"]=0;
        $temp_data["data_pay"]=0;
        //print_r($temp_data);
        //print_r($this->data);
        if($this->order->add($temp_data)){
            $send_data = array();
            $send_data["products"]=$this->getProducts();
            $send_data["name"]=$temp_data["name"];
            $send_data["phone"]=$temp_data["phone"];
            $send_data["email"]=$temp_data["email"];
            $send_data["price"]=$temp_data["price"];
            $send_data["notice"]=$temp_data["notice"];
            $to = $temp_data["email"];
            $this->mail->send($temp_data["email"],$send_data, "ORDER");

            //return true;
           $_SESSION["cart"]="";
            return $this->sm->pageMessage("ADD_ORDER");

        }
        return false;

    }

    private function getProducts(){
        $ids = explode(",", $_SESSION["cart"]);
        $products = $this->product->getAllOnIDs($ids);
        $result = array();
        for($i = 0; $i<count($products); $i++){
            $result[$products[$i]["id"]] = $products[$i]["title"];
        }
        $products = array();
        for($i = 0; $i < count($ids); $i++){
            $products[$ids[$i]][0]++;
            $products[$ids[$i]][1] = $result[$ids[$i]];
        }
//        print_r($products);
//        exit;
        $str = "";
        foreach($products as $value ){
            $str .= $value[1]." x ".$value[0]."шт; <br>";

        }
        return $str;

    }

    private function getPrice(){
        $ids = explode(",",$_SESSION["cart"]);
        $summa= $this->product->getPriceOnIDs($ids);
        $value = $this->discount->getValueOnCode($_SESSION["discount"]);
        if($value) $summa *=(1-$value);
        return $summa;

    }

}