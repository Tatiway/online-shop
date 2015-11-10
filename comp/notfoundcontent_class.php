<?php
/**
 * Created by PhpStorm.
 * User: Tatiana
 * Date: 28.02.2015
 * Time: 16:29
 */
require_once "modules_class.php";

class NotFoundContent extends Modules {

    protected $title= "Страница не найдена - 404";
    protected $meta_desc = "Такого запроса не существует";
    protected $meta_key = "Страница не найдена, такой страницы не существует";




    protected function getContent(){
        header("HTTP/0.1 404 Not Found");//необходимо для оптимизации под поисковую систему
        return "notfound";
    }






}