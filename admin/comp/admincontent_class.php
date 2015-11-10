<?php
/**
 * Created by PhpStorm.
 * User: Tatiana
 * Date: 01.04.2015
 * Time: 14:53
 */

require_once "adminmodules_class.php";

class AdminContent extends AdminModules {


    protected $title = "Аккаунт администратора";
    protected $meta_desc = "Аккаунт администратора Интернет-магазина";
    protected $meta_key = "администратор";


    protected function getContent(){

        return "index";

    }

}