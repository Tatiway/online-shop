<?php
/**
 * Created by PhpStorm.
 * User: Tatiana
 * Date: 27.02.2015
 * Time: 13:18
 */
require_once "config_class.php";
require_once "url_class.php";
require_once "format_class.php";
require_once "template_class.php";
require_once "categories_class.php";//классы для работы с данными из тадлиц категория
require_once "product_class.php";//классы для работы с данными из тадлиц продукт
require_once "discount_class.php";//классы для работы с данными из тадлиц
require_once "message_class.php";
require_once "order_class.php";




 abstract class AbstractModules {

     protected $config;
     protected $data;//массив с пост параметрами
     protected $url;
     protected $format;
     protected $categories;
     protected $product;
     protected $template;
     protected $discount;
     protected $message;
     protected $order;


     public function __construct(){
         session_start();
         $this->config = new Config();
         $this->url = new URL();
         $this->format = new Format();
         $this->data = $this->format->xss($_REQUEST);
         $this->template = new Template($this->getDirTmpl());
         $this->categories = new Categories();
         $this->product = new Product();
         $this->discount = new Discount();
         $this->message = new Message();
         $this->order = new Order();


     }

     abstract protected function getContent();
     abstract protected function getDirTmpl();


     protected function notFound(){
         $this->redirect($this->url->notfound());
     }

     protected function message(){
         if(!$_SESSION["message"]) return "";
         $text = $this->message->get($_SESSION["message"]);
         unset($_SESSION["message"]);
         return $text;
     }
     //метод redirect позволяет перенаправить запрос если он не корректный
     protected function redirect($link) {
         header("Location: $link");
         exit;
     }

     protected function getCountInArray($v, $array) {
        $count = 0;
        for ($i = 0; $i < count($array); $i++) {
            if ($array[$i] == $v) $count++;
        }
        return $count;
    }


}